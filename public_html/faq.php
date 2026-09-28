<?php
// Página FAQ: perguntas frequentes agrupadas por categoria, em acordeão.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Perguntas frequentes';
$descricao = 'Perguntas frequentes sobre EFD-Contribuições, NF-e, NFC-e, SINTEGRA e procedimentos operacionais dos sistemas World System.';

require __DIR__ . '/inc/layout-topo.php';

echo cabecalho_pagina(
    'FAQ',
    'Perguntas frequentes',
    'Respostas para as dúvidas mais comuns de clientes sobre escrituração fiscal, emissão de notas e operação do dia a dia.',
    ['titulo' => 'Suporte', 'link' => '/suporte.php']
);
?>

<section class="py-20 lg:py-24">
  <div class="mx-auto flex w-full max-w-3xl flex-col gap-14 px-6 lg:px-8">
    <?php foreach (FAQ as $indice => $categoria): ?>
      <?= revelar_abre($indice * 60) ?>
        <h2 class="text-xl font-semibold text-foreground"><?= e($categoria['titulo']) ?></h2>
        <p class="mt-1.5 text-sm text-foreground/60"><?= e($categoria['descricao']) ?></p>

        <div class="mt-5 divide-y divide-border-subtle rounded-2xl border border-border-subtle bg-surface">
          <?php foreach ($categoria['itens'] as $numero => $item): ?>
            <?php $id = 'faq-' . $indice . '-' . $numero; ?>
            <div>
              <h3>
                <button type="button" class="acordeao flex w-full items-center justify-between gap-4 px-5 py-4 text-left text-sm font-medium text-foreground transition-colors hover:bg-surface-muted focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-inset focus-visible:ring-brand-500 sm:text-base"
                  aria-expanded="false" aria-controls="<?= $id ?>">
                  <span><?= e($item['pergunta']) ?></span>
                  <?= icone('seta-baixo', 'size-4 shrink-0 text-foreground/50 transition-transform duration-300') ?>
                </button>
              </h3>
              <div id="<?= $id ?>" hidden class="px-5 pb-4 text-sm leading-relaxed text-foreground/70">
                <?= e($item['resposta']) ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?= revelar_fecha() ?>
    <?php endforeach; ?>
  </div>
</section>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
