<?php
// Página Oportunidades: vagas publicadas no painel e o formulário de currículo.

require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/vagas.php';

$titulo = 'Oportunidades';
$descricao = 'Veja as vagas abertas na World System e envie seu currículo para participar dos nossos processos seletivos.';

// Se o banco estiver fora do ar, a página continua funcionando: mostra o
// formulário de currículo, sem a lista de vagas.
try {
    $vagas = vagas_publicadas();
} catch (Throwable $erro) {
    error_log('[vagas] ' . $erro->getMessage());
    $vagas = [];
}

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="py-20 lg:py-28">
  <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-16 px-6 lg:grid-cols-[1fr_1.3fr] lg:items-start lg:px-8">
    <div class="flex flex-col gap-10">
    <?= revelar_abre() ?>
      <p class="text-xs font-semibold uppercase tracking-wide text-brand-fg">Trabalhe com a gente</p>
      <h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground">Oportunidades</h1>
      <p class="mt-4 text-lg leading-relaxed text-foreground/70">
        Nos envie seu currículo. Será um prazer trabalhar com você.
      </p>
      <div class="mt-8 rounded-xl border border-border-subtle bg-surface-muted p-7">
        <p class="text-sm leading-relaxed text-foreground/70">
          <?php if ($vagas): ?>
            Confira as vagas abertas abaixo. Mesmo que nenhuma combine com o seu perfil, envie seu
            currículo: ele fica disponível para futuras oportunidades na World System.
          <?php else: ?>
            No momento não há vagas específicas divulgadas nesta página. Mesmo assim, currículos são
            bem-vindos e ficam disponíveis para futuras oportunidades na World System.
          <?php endif; ?>
        </p>
      </div>
    <?= revelar_fecha() ?>

    <?php if ($vagas): ?>
      <div>
        <?= revelar_abre(60) ?>
          <h2 class="text-xs font-semibold uppercase tracking-wide text-foreground/40">
            <?= count($vagas) === 1 ? 'Vaga aberta' : count($vagas) . ' vagas abertas' ?>
          </h2>
        <?= revelar_fecha() ?>

        <div class="mt-4 flex flex-col gap-4">
          <?php foreach ($vagas as $indice => $vaga): ?>
            <?= revelar_abre(80 + $indice * 60) ?>
              <article class="rounded-xl border border-border-subtle bg-surface p-5 transition-colors duration-300 ease-out hover:border-brand-200">
                <h3 class="text-lg font-bold tracking-tight text-foreground"><?= e($vaga['titulo']) ?></h3>
                <p class="mt-2 text-sm leading-relaxed text-foreground/70"><?= nl2br(e($vaga['descricao'])) ?></p>

                <div class="mt-5 flex flex-col gap-4">
                  <div>
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-foreground/40">Requisitos</p>
                    <ul class="mt-2 flex flex-col gap-1.5">
                      <?php foreach (linhas_em_lista($vaga['requisitos']) as $item): ?>
                        <li class="flex items-start gap-2 text-sm text-foreground/70">
                          <span aria-hidden="true" class="mt-[0.45rem] size-1 shrink-0 rounded-full bg-brand-500"></span>
                          <?= e($item) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>

                  <div>
                    <p class="text-[11px] font-semibold uppercase tracking-wide text-foreground/40">Benefícios</p>
                    <ul class="mt-2 flex flex-col gap-1.5">
                      <?php foreach (linhas_em_lista($vaga['beneficios']) as $item): ?>
                        <li class="flex items-start gap-2 text-sm text-foreground/70">
                          <span aria-hidden="true" class="mt-[0.45rem] size-1 shrink-0 rounded-full bg-accent-500"></span>
                          <?= e($item) ?>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </article>
            <?= revelar_fecha() ?>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    </div>

    <?= revelar_abre(100) ?>
      <div class="rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
        <h2 class="text-xl font-semibold text-foreground">Envie seu currículo</h2>
        <p class="mt-1.5 text-sm text-foreground/60">Respondemos assim que houver uma oportunidade compatível.</p>

        <form id="form-curriculo" class="mt-6 flex flex-col gap-5" novalidate enctype="multipart/form-data">
          <div class="hidden" aria-hidden="true">
            <label for="curriculo-website">Não preencha este campo</label>
            <input id="curriculo-website" name="website" type="text" tabindex="-1" autocomplete="off">
          </div>

          <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div class="flex flex-col gap-1.5">
              <label for="curriculo-nome" class="text-sm font-medium text-foreground">Nome<span class="text-brand-fg"> *</span></label>
              <input id="curriculo-nome" name="nome" required autocomplete="name" class="campo">
              <p class="erro hidden text-xs font-medium text-red-600" data-erro="nome"></p>
            </div>
            <div class="flex flex-col gap-1.5">
              <label for="curriculo-email" class="text-sm font-medium text-foreground">E-mail<span class="text-brand-fg"> *</span></label>
              <input id="curriculo-email" name="email" type="email" required autocomplete="email" class="campo">
              <p class="erro hidden text-xs font-medium text-red-600" data-erro="email"></p>
            </div>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="curriculo-telefone" class="text-sm font-medium text-foreground">Telefone<span class="text-brand-fg"> *</span></label>
            <input id="curriculo-telefone" name="telefone" type="tel" required autocomplete="tel" class="campo">
            <p class="erro hidden text-xs font-medium text-red-600" data-erro="telefone"></p>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="curriculo-arquivo" class="text-sm font-medium text-foreground">Currículo (PDF ou DOC)<span class="text-brand-fg"> *</span></label>
            <label for="curriculo-arquivo" class="flex cursor-pointer items-center justify-center gap-2.5 rounded-lg border border-dashed border-border-subtle bg-surface-muted px-4 py-6 text-sm text-foreground/60 transition-colors hover:border-brand-400">
              <?= icone('upload', 'size-4') ?>
              <span id="nome-arquivo">Clique para selecionar o arquivo</span>
            </label>
            <input id="curriculo-arquivo" name="curriculo" type="file" required class="sr-only"
              accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
            <p class="text-xs text-foreground/60">Tamanho máximo de 4 MB.</p>
            <p class="erro hidden text-xs font-medium text-red-600" data-erro="curriculo"></p>
          </div>

          <div class="flex flex-col gap-1.5">
            <label for="curriculo-observacoes" class="text-sm font-medium text-foreground">Observações</label>
            <textarea id="curriculo-observacoes" name="observacoes" rows="4" class="campo min-h-32 resize-y"
              placeholder="Se quiser, diga para qual vaga está se candidatando."></textarea>
          </div>

          <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
            <button type="submit" class="<?= classes_botao('primario', 'lg') ?>">Enviar currículo</button>
            <div class="situacao hidden items-center gap-2 rounded-lg px-4 py-3 text-sm"></div>
          </div>
        </form>
      </div>
    <?= revelar_fecha() ?>
  </div>
</section>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
