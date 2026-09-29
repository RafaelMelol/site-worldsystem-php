<?php
// Cadastro e edição de uma vaga.
// Sem ?id= na URL, cadastra uma nova; com ?id=, edita a existente.

require_once __DIR__ . '/inc/sessao.php';
require_once __DIR__ . '/inc/layout-admin.php';
require_once __DIR__ . '/../inc/vagas.php';

exigir_login();

$id = (int) ($_GET['id'] ?? 0);
$vaga = $id ? vaga_por_id($id) : null;

if ($id && !$vaga) {
    http_response_code(404);
    admin_topo('Vaga não encontrada');
    echo '<div class="mx-auto w-full max-w-3xl px-6 text-center">';
    echo '<h1 class="text-2xl font-bold text-foreground">Vaga não encontrada</h1>';
    echo '<a href="' . url('admin/') . '" class="' . classes_botao('primario', 'md', 'mt-6') . '">Voltar para a lista</a>';
    echo '</div>';
    admin_rodape();
    exit;
}

// Valores mostrados no formulário: os da vaga, ou vazios para uma nova.
$dados = [
    'titulo' => $vaga['titulo'] ?? '',
    'descricao' => $vaga['descricao'] ?? '',
    'requisitos' => $vaga['requisitos'] ?? '',
    'beneficios' => $vaga['beneficios'] ?? '',
    'ativa' => $vaga['ativa'] ?? 1,
];
$erros = [];

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    exigir_token();

    $dados = [
        'titulo' => texto('titulo'),
        'descricao' => texto('descricao'),
        'requisitos' => texto('requisitos'),
        'beneficios' => texto('beneficios'),
        'ativa' => isset($_POST['ativa']) ? 1 : 0,
    ];

    $erros = vaga_validar($dados);

    if (!$erros) {
        try {
            if ($vaga) {
                vaga_atualizar($id, $dados);
                header('Location: ' . url('admin/?ok=atualizada'));
            } else {
                vaga_criar($dados);
                header('Location: ' . url('admin/?ok=criada'));
            }
            exit;
        } catch (Throwable $falha) {
            error_log('[vagas] ' . $falha->getMessage());
            $erroBanco = 'Não foi possível salvar a vaga. Tente novamente em instantes.';
        }
    }
}

admin_topo($vaga ? 'Editar vaga' : 'Nova vaga');
?>

<div class="mx-auto w-full max-w-3xl px-6">
  <a href="<?= url('admin/') ?>" class="text-sm font-medium text-foreground/60 transition-colors hover:text-foreground">← Voltar para a lista</a>

  <h1 class="mt-4 text-2xl font-bold tracking-tight text-foreground">
    <?= $vaga ? 'Editar vaga' : 'Nova vaga' ?>
  </h1>

  <div class="mt-8 rounded-xl border border-border-subtle bg-surface p-7">
    <?php if (isset($erroBanco)): ?>
      <?= admin_aviso('erro', $erroBanco) ?>
    <?php elseif ($erros): ?>
      <?= admin_aviso('erro', 'Confira os campos destacados.') ?>
    <?php endif; ?>

    <form method="post" class="flex flex-col gap-6">
      <input type="hidden" name="token" value="<?= e(token()) ?>">

      <div class="flex flex-col gap-1.5">
        <label for="titulo" class="text-sm font-medium text-foreground">Nome da vaga</label>
        <input id="titulo" name="titulo" required value="<?= e($dados['titulo']) ?>"
          placeholder="Ex: Analista de Suporte Técnico" class="campo"
          <?= isset($erros['titulo']) ? 'aria-invalid="true"' : '' ?>>
        <?php if (isset($erros['titulo'])): ?>
          <p class="text-xs font-medium text-red-600"><?= e($erros['titulo']) ?></p>
        <?php endif; ?>
      </div>

      <div class="flex flex-col gap-1.5">
        <label for="descricao" class="text-sm font-medium text-foreground">Descrição da vaga</label>
        <textarea id="descricao" name="descricao" rows="5" required class="campo resize-y"
          placeholder="O que a pessoa vai fazer no dia a dia."
          <?= isset($erros['descricao']) ? 'aria-invalid="true"' : '' ?>><?= e($dados['descricao']) ?></textarea>
        <?php if (isset($erros['descricao'])): ?>
          <p class="text-xs font-medium text-red-600"><?= e($erros['descricao']) ?></p>
        <?php endif; ?>
      </div>

      <div class="flex flex-col gap-1.5">
        <label for="requisitos" class="text-sm font-medium text-foreground">Requisitos</label>
        <textarea id="requisitos" name="requisitos" rows="6" required class="campo resize-y"
          placeholder="Um por linha:&#10;Ensino médio completo&#10;Conhecimento em informática"
          <?= isset($erros['requisitos']) ? 'aria-invalid="true"' : '' ?>><?= e($dados['requisitos']) ?></textarea>
        <p class="text-xs text-foreground/60">Escreva um requisito por linha. No site eles viram uma lista.</p>
        <?php if (isset($erros['requisitos'])): ?>
          <p class="text-xs font-medium text-red-600"><?= e($erros['requisitos']) ?></p>
        <?php endif; ?>
      </div>

      <div class="flex flex-col gap-1.5">
        <label for="beneficios" class="text-sm font-medium text-foreground">Benefícios</label>
        <textarea id="beneficios" name="beneficios" rows="6" required class="campo resize-y"
          placeholder="Um por linha:&#10;Vale-transporte&#10;Plano de saúde"
          <?= isset($erros['beneficios']) ? 'aria-invalid="true"' : '' ?>><?= e($dados['beneficios']) ?></textarea>
        <p class="text-xs text-foreground/60">Um benefício por linha.</p>
        <?php if (isset($erros['beneficios'])): ?>
          <p class="text-xs font-medium text-red-600"><?= e($erros['beneficios']) ?></p>
        <?php endif; ?>
      </div>

      <label class="flex items-start gap-3 rounded-lg border border-border-subtle bg-surface-muted p-4">
        <input type="checkbox" name="ativa" value="1" <?= $dados['ativa'] ? 'checked' : '' ?>
          class="mt-0.5 size-4 shrink-0 accent-brand-600">
        <span class="text-sm text-foreground/80">
          <strong class="font-medium text-foreground">Publicar no site</strong><br>
          Desmarque para deixar como rascunho, visível só aqui no painel.
        </span>
      </label>

      <div class="flex flex-col gap-3 sm:flex-row">
        <button type="submit" class="<?= classes_botao('primario', 'lg') ?>">
          <?= $vaga ? 'Salvar alterações' : 'Cadastrar vaga' ?>
        </button>
        <a href="<?= url('admin/') ?>" class="<?= classes_botao('contorno', 'lg') ?>">Cancelar</a>
      </div>
    </form>
  </div>
</div>

<?php admin_rodape(); ?>
