<?php
// Página Soluções: lista completa das soluções.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Soluções';
$descricao = 'Conheça as soluções da World System: SCA 5.0 Pro para varejo e atacado, emissão de NFe/NFCe e documentos fiscais de transporte CTe, CTe OS e MDFe.';

require __DIR__ . '/inc/layout-topo.php';

echo cabecalho_pagina(
    'Soluções',
    'Sistemas completos para gestão e automação comercial',
    'Quatro frentes de solução, integradas entre si, para acompanhar a operação do estoque à conformidade fiscal.'
);
?>

<section class="py-20 lg:py-24">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= lista_solucoes() ?>
  </div>
</section>

<?= banner_cta('Ainda não sabe qual solução é ideal para você?', 'Conte para a gente sobre o seu negócio e a equipe da World System indica o melhor caminho.') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
