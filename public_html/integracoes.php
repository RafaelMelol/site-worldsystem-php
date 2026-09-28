<?php
// Página Integrações: todas as integrações disponíveis.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Integrações';
$descricao = 'Integrações da World System com SEF/MG, PedidoOk, Mercado Livre, Shopee e equipamentos de operação como balanças, leitores e impressoras de etiquetas.';

require __DIR__ . '/inc/layout-topo.php';

echo cabecalho_pagina(
    'Integrações',
    'Conectado aos órgãos fiscais e à sua operação',
    'Tecnologia integrada à SEF/MG, aos canais de venda e aos equipamentos que sua empresa já utiliza.'
);
?>

<section class="py-20 lg:py-24">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= grade_integracoes(true) ?>
  </div>
</section>

<?= banner_cta('Precisa integrar um equipamento ou canal de venda específico?', 'Fale com a nossa equipe e entenda como a integração funciona na prática.') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
