<?php
// Moldura das telas do painel: cabeçalho simples e rodapé.
// Usa o mesmo CSS do site, para manter a aparência.

require_once __DIR__ . '/../../inc/config.php';
require_once __DIR__ . '/../../inc/componentes.php';

/** Abre a página do painel. $titulo aparece na aba do navegador. */
function admin_topo(string $titulo, bool $comMenu = true): void
{
    ?><!doctype html>
<html lang="pt-BR" class="h-full antialiased">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulo) ?> | Painel World System</title>
<meta name="robots" content="noindex, nofollow">
<link rel="icon" href="<?= arquivo('assets/img/icone.png') ?>" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= arquivo('assets/css/site.css') ?>">
<script>
  try {
    var tema = localStorage.getItem('theme');
    if (tema === 'light' || tema === 'dark') document.documentElement.setAttribute('data-theme', tema);
  } catch (e) {}
</script>
</head>
<body class="flex min-h-full flex-col">

<?php if ($comMenu): ?>
<header class="border-b border-border-subtle bg-surface">
  <div class="mx-auto flex h-18 max-w-5xl items-center justify-between gap-4 px-6">
    <a href="<?= url('admin/') ?>" class="flex items-center gap-3">
      <img src="<?= arquivo('assets/img/logo.png') ?>" alt="World System" width="1569" height="281" class="logo-mark h-8 w-auto">
      <span class="hidden text-sm font-semibold text-foreground/70 sm:block">Painel de vagas</span>
    </a>
    <div class="flex items-center gap-3">
      <a href="<?= url('oportunidades.php') ?>" target="_blank" rel="noopener" class="text-sm font-medium text-foreground/70 transition-colors hover:text-foreground">Ver site</a>
      <a href="<?= url('admin/sair.php') ?>" class="<?= classes_botao('contorno', 'sm') ?>">Sair</a>
    </div>
  </div>
</header>
<?php endif; ?>

<main class="flex-1 py-10">
<?php
}

/** Fecha a página do painel. */
function admin_rodape(): void
{
    ?>
</main>

<footer class="border-t border-border-subtle py-6">
  <p class="mx-auto max-w-5xl px-6 text-xs text-foreground/50">
    Painel de vagas · World System – Soluções em TI
  </p>
</footer>
</body>
</html>
<?php
}

/** Faixa de aviso (verde para sucesso, vermelha para erro). */
function admin_aviso(string $tipo, string $mensagem): string
{
    $estilos = [
        'sucesso' => 'bg-accent-50 text-accent-700',
        'erro' => 'bg-red-50 text-red-700',
    ];

    return '<div class="mb-6 flex items-center gap-2 rounded-lg px-4 py-3 text-sm font-medium ' . $estilos[$tipo] . '">'
        . icone($tipo === 'sucesso' ? 'confirmado' : 'alerta', 'size-4 shrink-0')
        . '<span>' . e($mensagem) . '</span></div>';
}
