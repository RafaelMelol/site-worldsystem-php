<?php
// Lista das vagas cadastradas, com as ações de publicar, editar e excluir.

require_once __DIR__ . '/inc/sessao.php';
require_once __DIR__ . '/inc/layout-admin.php';
require_once __DIR__ . '/../inc/vagas.php';

exigir_login();

$aviso = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    exigir_token();

    $id = (int) ($_POST['id'] ?? 0);
    $acao = (string) ($_POST['acao'] ?? '');

    try {
        if ($acao === 'publicar' && $id) {
            vaga_alternar_publicacao($id);
            $aviso = ['sucesso', 'Situação da vaga atualizada.'];
        } elseif ($acao === 'excluir' && $id) {
            vaga_excluir($id);
            $aviso = ['sucesso', 'Vaga excluída.'];
        }
    } catch (Throwable $falha) {
        error_log('[vagas] ' . $falha->getMessage());
        $aviso = ['erro', 'Não foi possível concluir a ação. Tente novamente em instantes.'];
    }
}

// Mensagem vinda da tela de cadastro/edição.
if (isset($_GET['ok'])) {
    $mensagens = [
        'criada' => 'Vaga cadastrada.',
        'atualizada' => 'Vaga atualizada.',
    ];
    $chave = (string) $_GET['ok'];
    if (isset($mensagens[$chave])) {
        $aviso = ['sucesso', $mensagens[$chave]];
    }
}

try {
    $vagas = vagas_todas();
} catch (Throwable $falha) {
    error_log('[vagas] ' . $falha->getMessage());
    $vagas = [];
    $aviso = ['erro', 'Não foi possível ler as vagas. Confira a configuração do banco em inc/config-banco.php.'];
}

admin_topo('Vagas');
?>

<div class="mx-auto w-full max-w-5xl px-6">
  <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
      <h1 class="text-2xl font-bold tracking-tight text-foreground">Vagas</h1>
      <p class="mt-1 text-sm text-foreground/60">
        <?= count($vagas) ?> cadastrada(s) ·
        <?= count(array_filter($vagas, fn ($v) => $v['ativa'])) ?> publicada(s) no site
      </p>
    </div>
    <a href="<?= url('admin/vaga.php') ?>" class="<?= classes_botao('primario', 'md') ?>">Nova vaga</a>
  </div>

  <div class="mt-8">
    <?= $aviso ? admin_aviso($aviso[0], $aviso[1]) : '' ?>

    <?php if (!$vagas): ?>
      <div class="rounded-xl border border-dashed border-border-subtle p-10 text-center">
        <p class="font-medium text-foreground">Nenhuma vaga cadastrada</p>
        <p class="mt-2 text-sm text-foreground/60">
          Enquanto não houver vagas publicadas, a página Oportunidades mostra o aviso padrão e o
          formulário de currículo.
        </p>
        <a href="<?= url('admin/vaga.php') ?>" class="<?= classes_botao('primario', 'md', 'mt-6') ?>">Cadastrar a primeira vaga</a>
      </div>
    <?php else: ?>
      <div class="flex flex-col gap-4">
        <?php foreach ($vagas as $vaga): ?>
          <div class="flex flex-col gap-4 rounded-xl border border-border-subtle bg-surface p-6 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
              <div class="flex flex-wrap items-center gap-2">
                <h2 class="text-lg font-semibold text-foreground"><?= e($vaga['titulo']) ?></h2>
                <?php if ($vaga['ativa']): ?>
                  <span class="rounded bg-accent-50 px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wide text-accent-700">No site</span>
                <?php else: ?>
                  <span class="rounded bg-surface-muted px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wide text-foreground/50">Rascunho</span>
                <?php endif; ?>
              </div>
              <p class="mt-1.5 line-clamp-2 text-sm text-foreground/60"><?= e($vaga['descricao']) ?></p>
              <p class="mt-2 text-xs text-foreground/40">
                <?= count(linhas_em_lista($vaga['requisitos'])) ?> requisito(s) ·
                <?= count(linhas_em_lista($vaga['beneficios'])) ?> benefício(s) ·
                criada em <?= date('d/m/Y', strtotime($vaga['criada_em'])) ?>
              </p>
            </div>

            <div class="flex shrink-0 flex-wrap items-center gap-2">
              <a href="<?= url('admin/vaga.php?id=' . $vaga['id']) ?>" class="<?= classes_botao('contorno', 'sm') ?>">Editar</a>

              <form method="post" class="contents">
                <input type="hidden" name="token" value="<?= e(token()) ?>">
                <input type="hidden" name="id" value="<?= (int) $vaga['id'] ?>">
                <input type="hidden" name="acao" value="publicar">
                <button type="submit" class="<?= classes_botao('contorno', 'sm') ?>">
                  <?= $vaga['ativa'] ? 'Tirar do site' : 'Publicar' ?>
                </button>
              </form>

              <form method="post" class="contents" onsubmit="return confirm('Excluir a vaga &quot;<?= e($vaga['titulo']) ?>&quot;? Esta ação não pode ser desfeita.')">
                <input type="hidden" name="token" value="<?= e(token()) ?>">
                <input type="hidden" name="id" value="<?= (int) $vaga['id'] ?>">
                <input type="hidden" name="acao" value="excluir">
                <button type="submit" class="<?= classes_botao('contorno', 'sm', 'text-red-600 hover:bg-red-50') ?>">Excluir</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php admin_rodape(); ?>
