<?php
// Início de todas as páginas: <head>, cabeçalho fixo e abertura do <main>.
// Antes de incluir este arquivo, defina:
//   $titulo   - título da aba (sem o nome do site)
//   $descricao - descrição para buscadores
//   $dados_estruturados (opcional) - array que vira JSON-LD

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/componentes.php';

$titulo = $titulo ?? null;
$descricao = $descricao ?? SITE['descricao'];
$titulo_completo = $titulo ? $titulo . ' | ' . SITE['nome_curto'] : SITE['nome_curto'] . ' – Soluções em TI para Gestão e Automação';
$atual = pagina_atual();
?>
<!doctype html>
<html lang="pt-BR" class="h-full antialiased">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulo_completo) ?></title>
<meta name="description" content="<?= e($descricao) ?>">
<meta property="og:type" content="website">
<meta property="og:locale" content="pt_BR">
<meta property="og:site_name" content="<?= e(SITE['nome']) ?>">
<meta property="og:title" content="<?= e($titulo_completo) ?>">
<meta property="og:description" content="<?= e($descricao) ?>">
<?php if (!empty($sem_indexacao)): ?>
<meta name="robots" content="noindex, nofollow">
<meta name="referrer" content="no-referrer">
<?php endif; ?>
<link rel="icon" href="<?= url('assets/img/icone.png') ?>" type="image/png">
<link rel="apple-touch-icon" href="<?= url('assets/img/icone.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= url('assets/css/site.css') ?>">
<script>
  // Aplica o tema salvo antes de a página aparecer, para não piscar no tema errado.
  try {
    var tema = localStorage.getItem('theme');
    if (tema === 'light' || tema === 'dark') document.documentElement.setAttribute('data-theme', tema);
  } catch (e) {}
</script>
<?php if (!empty($dados_estruturados)): ?>
<script type="application/ld+json"><?= json_encode($dados_estruturados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
<?php endif; ?>
</head>
<body class="flex min-h-full flex-col">

<div id="barra-progresso" aria-hidden="true" class="fixed inset-x-0 top-0 z-[60] h-[3px] origin-left scale-x-0 bg-gradient-to-r from-brand-400 via-brand-500 to-accent-400"></div>
<div id="cursor" aria-hidden="true" class="custom-cursor"></div>

<a href="#conteudo" class="skip-link">Pular para o conteúdo</a>

<header id="cabecalho" class="fixed inset-x-0 top-0 z-50 border-b border-clear bg-transparent transition-[background-color,border-color,box-shadow,backdrop-filter] duration-300">
  <div class="mx-auto flex h-18 max-w-7xl items-center justify-between px-6 py-3 lg:px-8">
    <a href="<?= url() ?>" aria-label="World System - Página inicial" class="shrink-0 transition-transform duration-200 hover:scale-[1.03] active:scale-[0.98]">
      <span class="inline-flex items-center">
        <img src="<?= url('assets/img/logo.png') ?>" alt="World System" width="1569" height="281" class="logo-mark h-10 w-auto sm:h-11">
      </span>
    </a>

    <nav aria-label="Navegação principal" class="hidden xl:block">
      <ul class="flex items-center gap-1">
        <?php foreach (MENU as $item): ?>
          <li class="relative">
            <?php if (!empty($item['filhos'])): ?>
              <button type="button" aria-expanded="false" data-submenu="<?= e($item['titulo']) ?>"
                class="flex items-center gap-1 rounded-lg px-4 py-2 text-sm font-medium text-foreground/80 transition-colors hover:bg-surface-muted hover:text-foreground">
                <?= e($item['titulo']) ?>
                <?= icone('seta-baixo', 'size-3.5 transition-transform duration-200') ?>
              </button>
              <div data-painel-submenu="<?= e($item['titulo']) ?>" hidden
                class="absolute left-0 top-full z-10 mt-2 w-64 origin-top overflow-hidden rounded-lg border border-border-subtle bg-surface py-2 shadow-elevated">
                <?php foreach ($item['filhos'] as $filho): ?>
                  <a href="<?= e(url($filho['link'])) ?>" class="block px-4 py-2.5 text-sm text-foreground/80 transition-colors hover:bg-surface-muted hover:text-foreground"><?= e($filho['titulo']) ?></a>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <a href="<?= e(url($item['link'])) ?>" class="block rounded-lg px-4 py-2 text-sm font-medium text-foreground/80 transition-colors hover:bg-surface-muted hover:text-foreground"><?= e($item['titulo']) ?></a>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <div class="hidden items-center gap-3 xl:flex">
      <?php require __DIR__ . '/botao-tema.php'; ?>
      <a href="<?= url('contato.php') ?>" class="<?= classes_botao('primario', 'sm') ?>">Fale com a World System</a>
    </div>

    <div class="flex items-center gap-2 xl:hidden">
      <?php require __DIR__ . '/botao-tema.php'; ?>
      <button type="button" id="botao-menu" aria-expanded="false" aria-controls="menu-mobile" aria-label="Abrir menu"
        class="inline-flex items-center justify-center rounded-lg p-2 text-foreground">
        <span data-icone-menu><?= icone('menu', 'size-6') ?></span>
        <span data-icone-fechar hidden><?= icone('fechar', 'size-6') ?></span>
      </button>
    </div>
  </div>

  <div id="menu-mobile" hidden class="overflow-hidden border-t border-border-subtle bg-surface xl:hidden">
    <div class="max-h-[calc(100dvh-4.5rem)] overflow-y-auto px-6 pb-8 pt-4">
      <ul class="flex flex-col gap-1">
        <?php foreach (MENU as $item): ?>
          <li>
            <?php if (!empty($item['filhos'])): ?>
              <div>
                <button type="button" aria-expanded="false" data-submenu-mobile="<?= e($item['titulo']) ?>"
                  class="flex w-full items-center justify-between rounded-lg px-3 py-3 text-base font-medium text-foreground">
                  <?= e($item['titulo']) ?>
                  <?= icone('seta-baixo', 'size-4 transition-transform') ?>
                </button>
                <div data-painel-mobile="<?= e($item['titulo']) ?>" hidden>
                  <ul class="ml-3 flex flex-col gap-1 border-l border-border-subtle pl-3">
                    <?php foreach ($item['filhos'] as $filho): ?>
                      <li><a href="<?= e(url($filho['link'])) ?>" class="block rounded-lg px-3 py-2.5 text-sm text-foreground/70"><?= e($filho['titulo']) ?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            <?php else: ?>
              <a href="<?= e(url($item['link'])) ?>" class="block rounded-lg px-3 py-3 text-base font-medium text-foreground"><?= e($item['titulo']) ?></a>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <a href="<?= url('contato.php') ?>" class="<?= classes_botao('primario', 'md', 'mt-4 w-full') ?>">Fale com a World System</a>
    </div>
  </div>
</header>

<main id="conteudo" class="flex-1 pt-18">
