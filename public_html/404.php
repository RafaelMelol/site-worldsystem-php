<?php
// Página mostrada quando o endereço não existe.

require_once __DIR__ . '/inc/config.php';

http_response_code(404);

$titulo = 'Página não encontrada';
$descricao = 'O endereço acessado não existe no site da World System.';
$sem_indexacao = true;

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="py-28 lg:py-36">
  <div class="mx-auto w-full max-w-7xl px-6 text-center lg:px-8">
    <p class="text-xs font-semibold uppercase tracking-wide text-brand-fg">Erro 404</p>
    <h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground sm:text-5xl">Página não encontrada</h1>
    <p class="mt-6 text-lg leading-relaxed text-foreground/70">
      O endereço acessado não existe ou foi movido.
    </p>
    <a href="<?= url() ?>" class="<?= classes_botao('primario', 'lg', 'mt-9') ?>">Voltar para a página inicial</a>
  </div>
</section>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
