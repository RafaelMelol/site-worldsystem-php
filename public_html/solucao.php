<?php
// Página de uma solução: /solucao.php?s=varejo, ?s=atacado, e assim por diante.
// Um arquivo só atende todas, lendo os dados de inc/conteudo/solucoes.php.

require_once __DIR__ . '/inc/config.php';

$solucao = solucao_por_slug((string) ($_GET['s'] ?? ''));

// Endereço de solução que não existe mostra a página de erro 404.
if (!$solucao) {
    http_response_code(404);
    $titulo = 'Página não encontrada';
    $descricao = 'A solução procurada não existe.';
    require __DIR__ . '/inc/layout-topo.php';
    echo '<section class="py-28"><div class="mx-auto w-full max-w-7xl px-6 text-center lg:px-8">';
    echo '<h1 class="text-4xl font-bold tracking-tight text-foreground">Solução não encontrada</h1>';
    echo '<p class="mt-4 text-foreground/70">O endereço acessado não corresponde a nenhuma solução.</p>';
    echo '<a href="' . url('solucoes.php') . '" class="' . classes_botao('primario', 'md', 'mt-8') . '">Ver todas as soluções</a>';
    echo '</div></section>';
    require __DIR__ . '/inc/layout-rodape.php';
    exit;
}

$titulo = $solucao['nome'];
$descricao = $solucao['descricao'];

$dados_estruturados = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $solucao['nome'],
    'description' => $solucao['descricao'],
    'category' => $solucao['categoria'],
    'provider' => ['@type' => 'Organization', 'name' => SITE['nome'], 'url' => SITE['url']],
];

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="border-b border-border-subtle bg-surface-muted py-16 lg:py-20">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <a href="<?= url('solucoes.php') ?>" class="text-sm font-medium text-foreground/60 transition-colors hover:text-foreground">← Todas as soluções</a>

    <?= revelar_abre(80) ?>
      <div class="mt-6">
        <?= selo($solucao['categoria']) ?>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-foreground sm:text-4xl"><?= e($solucao['nome']) ?></h1>
        <p class="mt-2 text-lg text-foreground/70"><?= e($solucao['chamada']) ?></p>
      </div>

      <p class="mt-8 max-w-3xl text-base leading-relaxed text-foreground/70"><?= e($solucao['descricao']) ?></p>

      <?php if (!empty($solucao['segmentos'])): ?>
        <div class="mt-8">
          <p class="text-xs font-semibold uppercase tracking-wide text-foreground/40">Segmentos atendidos</p>
          <ul class="mt-3 flex flex-wrap gap-2">
            <?php foreach ($solucao['segmentos'] as $segmento): ?>
              <li class="rounded border border-border-subtle bg-surface px-3.5 py-1.5 text-sm font-medium text-foreground/70"><?= e($segmento) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <div class="mt-9 flex flex-col gap-3 sm:flex-row">
        <a href="<?= url('contato.php') ?>" class="<?= classes_botao('primario', 'lg', 'group/link') ?>">
          Fale com a World System
          <?= icone('seta-direita', 'size-4 transition-transform duration-200 group-hover/link:translate-x-1') ?>
        </a>
        <a href="<?= url('recursos.php') ?>" class="<?= classes_botao('contorno', 'lg') ?>">Ver todos os recursos</a>
      </div>
    <?= revelar_fecha() ?>
  </div>
</section>

<section class="py-20 lg:py-24">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= revelar_abre() ?>
      <h2 class="text-2xl font-semibold text-foreground">Recursos incluídos</h2>
    <?= revelar_fecha() ?>

    <div class="mt-8 grid grid-cols-1 gap-6 md:grid-cols-2">
      <?php foreach ($solucao['grupos'] as $indice => $grupo): ?>
        <?= revelar_abre($indice * 70) ?>
          <div class="rounded-xl border border-border-subtle bg-surface p-6 transition-colors duration-300 ease-out hover:border-brand-200">
            <h3 class="font-semibold text-foreground"><?= e($grupo['titulo']) ?></h3>
            <ul class="mt-4 flex flex-col gap-2.5">
              <?php foreach ($grupo['itens'] as $item): ?>
                <li class="flex items-start gap-2.5 text-sm text-foreground/70">
                  <span aria-hidden="true" class="mt-[0.4rem] size-1.5 shrink-0 rounded-full bg-accent-500"></span>
                  <?= e($item) ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?= revelar_fecha() ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?= banner_cta('Quer conhecer o ' . $solucao['nome'] . ' de perto?', 'Fale com a nossa equipe e veja como essa solução se encaixa na sua operação.') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
