<?php
// Página Suporte: horários de atendimento, telefones diretos e atalho para o FAQ.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Suporte';
$descricao = 'Horário de atendimento e perguntas frequentes sobre os sistemas da World System.';

$horarios = [
    ['titulo' => HORARIOS['semana_titulo'], 'horario' => HORARIOS['semana_horario'], 'nota' => HORARIOS['semana_nota']],
    ['titulo' => HORARIOS['sabado_titulo'], 'horario' => HORARIOS['sabado_horario'], 'nota' => HORARIOS['sabado_nota']],
];

$telefones = [
    ['titulo' => 'Telefone / WhatsApp', 'numero' => CONTATO['telefone'], 'exibicao' => CONTATO['telefone_exibicao']],
    ['titulo' => HORARIOS['sabado_titulo'], 'numero' => CONTATO['plantao'], 'exibicao' => CONTATO['plantao_exibicao']],
];

require __DIR__ . '/inc/layout-topo.php';

echo cabecalho_pagina(
    'Suporte',
    'Um time preparado para garantir a continuidade da sua operação',
    'Atendimento, horário de plantão e respostas para as dúvidas técnicas mais comuns.'
);
?>

<section id="horario" class="scroll-mt-24 py-20 lg:py-24">
  <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-12 px-6 lg:grid-cols-2 lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Horário de atendimento', 'Quando sua empresa precisa, você pode contar com a gente') ?>
      <div class="mt-8 flex flex-col gap-4">
        <?php foreach ($horarios as $item): ?>
          <div class="rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
            <h3 class="text-xl font-bold tracking-tight text-foreground"><?= e($item['titulo']) ?></h3>
            <p class="mt-2 text-2xl font-bold tabular-nums tracking-tight text-brand-fg"><?= e($item['horario']) ?></p>
            <p class="mt-2 text-sm leading-relaxed text-foreground/70"><?= e($item['nota']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?= revelar_fecha() ?>

    <?= revelar_abre(100) ?>
      <?= titulo_secao('Fale agora', 'Canais diretos de atendimento') ?>
      <div class="mt-8 flex flex-col gap-4">
        <?php foreach ($telefones as $canal): ?>
          <a href="tel:<?= e($canal['numero']) ?>" class="block rounded-xl border border-border-subtle bg-surface p-5 transition-colors duration-300 ease-out hover:border-brand-200">
            <p class="text-sm font-semibold text-foreground"><?= e($canal['titulo']) ?></p>
            <p class="text-sm text-foreground/60"><?= e($canal['exibicao']) ?></p>
          </a>
        <?php endforeach; ?>
      </div>
    <?= revelar_fecha() ?>
  </div>
</section>

<section class="border-t border-border-subtle py-20 lg:py-24">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= revelar_abre() ?>
      <div class="flex flex-col items-start gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200 sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h3 class="text-xl font-bold tracking-tight text-foreground">Perguntas frequentes</h3>
          <p class="mt-2 text-sm leading-relaxed text-foreground/70">
            Dúvidas técnicas sobre EFD-Contribuições, NF-e, NFC-e, SINTEGRA e procedimentos operacionais.
          </p>
        </div>
        <a href="<?= url('faq.php') ?>" class="<?= classes_botao('primario', 'md', 'shrink-0 group/link') ?>">
          Ver FAQ completo
          <?= icone('seta-direita', 'size-4 transition-transform duration-200 group-hover/link:translate-x-1') ?>
        </a>
      </div>
    <?= revelar_fecha() ?>
  </div>
</section>

<?= banner_cta('Não encontrou o que precisava?', 'Fale diretamente com o time de suporte da World System.', 'Fale com o suporte') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
