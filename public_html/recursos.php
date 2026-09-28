<?php
// Página Recursos: texto à esquerda e todas as categorias, em abas, à direita.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Recursos';
$descricao = 'Conheça os recursos das soluções World System: plataforma web, relatórios, segurança, emissão fiscal, operação comercial e integrações com equipamentos.';

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="py-20 lg:py-28">
  <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-12 px-6 lg:grid-cols-[1fr_1.3fr] lg:items-start lg:px-8">
    <?= revelar_abre() ?>
      <p class="text-xs font-semibold uppercase tracking-wide text-brand-fg">Recursos</p>
      <h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground sm:text-5xl">
        Um conjunto completo de soluções à disposição da sua empresa
      </h1>
      <p class="mt-6 text-lg leading-relaxed text-foreground/70">
        Os recursos abaixo estão presentes, no todo ou em parte, nas soluções SCA 5.0 Pro,
        NFe/NFCe e CTe/MDFe — organizados por categoria para facilitar a consulta.
      </p>
    <?= revelar_fecha() ?>
    <?= revelar_abre(80) ?>
      <?= abas_recursos(RECURSOS) ?>
    <?= revelar_fecha() ?>
  </div>
</section>

<?= banner_cta('Quer ver esses recursos em ação?', 'Agende uma conversa com a World System e conheça a solução ideal para o seu negócio.') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
