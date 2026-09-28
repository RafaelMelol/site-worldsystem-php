<?php
// Página Empresa: apresentação, localização, princípios e diferenciais.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Empresa';
$descricao = 'Conheça a história da World System: pioneira em soluções de TI desde 1993, com sede em Lagoa da Prata/MG, atendendo pequenas indústrias, atacados e varejos.';

require __DIR__ . '/inc/layout-topo.php';

echo cabecalho_pagina(
    'Empresa',
    'Pioneira em soluções de TI desde ' . EMPRESA['ano_fundacao'],
    EMPRESA['apresentacao']
);
?>

<section class="py-20 lg:py-24">
  <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-16 px-6 lg:grid-cols-2 lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Nossa localização', 'Sede em ' . EMPRESA['sede']) ?>
      <div class="mt-6 flex flex-col gap-6">
        <div class="rounded-xl border border-border-subtle bg-surface p-5 transition-colors duration-300 ease-out hover:border-brand-200">
          <p class="mb-2 text-sm font-semibold text-foreground">Onde estamos</p>
          <div class="text-sm leading-relaxed text-foreground/70">
            <?= e(CONTATO['endereco']['rua']) ?> – <?= e(CONTATO['endereco']['bairro']) ?><br>
            <?= e(CONTATO['endereco']['cep']) ?> – <?= e(CONTATO['endereco']['cidade']) ?>/<?= e(CONTATO['endereco']['estado']) ?><br>
            <?= e(EMPRESA['distancia_bh']) ?>
          </div>
        </div>
        <div>
          <p class="text-xs font-semibold uppercase tracking-wide text-foreground/40">Segmentos atendidos</p>
          <?= etiquetas(SEGMENTOS_ATENDIDOS, 'mt-3') ?>
        </div>
      </div>
    <?= revelar_fecha() ?>

    <?= revelar_abre(100) ?>
      <?= titulo_secao('Nossos princípios', 'O que orienta o nosso trabalho') ?>
      <div class="mt-6 flex flex-col gap-4">
        <?php foreach ([
            'Missão' => EMPRESA['missao'],
            'Compromisso' => EMPRESA['compromisso'],
            'Reconhecimento' => EMPRESA['reconhecimento'],
        ] as $caixa => $texto): ?>
          <div class="rounded-xl border border-border-subtle bg-surface p-5 transition-colors duration-300 ease-out hover:border-brand-200">
            <p class="mb-2 text-sm font-semibold text-foreground"><?= e($caixa) ?></p>
            <div class="text-sm leading-relaxed text-foreground/70"><?= e($texto) ?></div>
          </div>
        <?php endforeach; ?>
      </div>
    <?= revelar_fecha() ?>
  </div>
</section>

<section class="border-t border-border-subtle bg-surface-muted py-20 lg:py-24">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Por que a World System', 'Experiência, estrutura e atendimento personalizado', null, true) ?>
    <?= revelar_fecha() ?>

    <div class="mt-12 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach (EMPRESA_PILARES as $indice => $pilar): ?>
        <?= revelar_abre($indice * 60) ?>
          <div class="h-full rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
            <h3 class="text-xl font-bold tracking-tight text-foreground"><?= e($pilar['titulo']) ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-foreground/70"><?= e($pilar['descricao']) ?></p>
          </div>
        <?= revelar_fecha() ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= banner_cta('Quer conhecer de perto o trabalho da World System?', 'Nossa equipe está pronta para entender o seu negócio e apresentar a solução mais adequada.') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
