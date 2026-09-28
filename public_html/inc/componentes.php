<?php
// Peças visuais reutilizadas pelas páginas: ícones, botões, cartões,
// cabeçalhos de seção, abas de recursos e a faixa de contato.

/** Ícones. Os traçados vêm do conjunto Lucide, o mesmo usado antes. */
function icone(string $nome, string $classe = 'size-4'): string
{
    $tracos = [
        'seta-direita' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'seta-baixo' => '<path d="m6 9 6 6 6-6"/>',
        'menu' => '<path d="M4 5h16"/><path d="M4 12h16"/><path d="M4 19h16"/>',
        'fechar' => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'sol' => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/>',
        'lua' => '<path d="M20.985 12.486a9 9 0 1 1-9.473-9.472c.405-.022.617.46.402.803a6 6 0 0 0 8.268 8.268c.344-.215.825-.004.803.401"/>',
        'mapa' => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
        'telefone' => '<path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/>',
        'email' => '<path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/>',
        'relogio' => '<circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>',
        'balao' => '<path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/>',
        'upload' => '<path d="M12 13v8"/><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="m8 17 4-4 4 4"/>',
        'confirmado' => '<path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/>',
        'alerta' => '<circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/>',
        'carregando' => '<path d="M21 12a9 9 0 1 1-6.219-8.56"/>',
        'alta' => '<path d="M16 7h6v6"/><path d="m22 7-8.5 8.5-5-5L2 17"/>',
        'documento' => '<path d="M10.5 22H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.706.706l3.588 3.588A2.4 2.4 0 0 1 20 8v6"/><path d="M14 2v5a1 1 0 0 0 1 1h5"/><path d="m14 20 2 2 4-4"/>',
        'caixa' => '<path d="M12 22V12"/><path d="M20.27 18.27 22 20"/><path d="M21 10.498V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.729l7 4a2 2 0 0 0 2 .001l.98-.559"/><path d="M3.29 7 12 12l8.71-5"/><path d="m7.5 4.27 8.997 5.148"/><circle cx="18.5" cy="16.5" r="2.5"/>',
        'grafico' => '<path d="M3 3v16a2 2 0 0 0 2 2h16"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/>',
        'copiar' => '<rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>',
        'check' => '<path d="M20 6 9 17l-5-5"/>',
    ];

    $conteudo = $tracos[$nome] ?? '';

    return '<svg class="' . e($classe) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $conteudo . '</svg>';
}

/** Ícones das redes sociais (desenhos próprios, como no site anterior). */
function icone_rede(string $rede, string $classe = 'size-4'): string
{
    $desenhos = [
        'facebook' => '<path d="M14.5 8.5H16.5V5.5H14.5C12.5 5.5 11 7 11 9V11H9V14H11V19H14V14H16L16.5 11H14V9C14 8.7 14.2 8.5 14.5 8.5Z" fill="currentColor"/>',
        'instagram' => '<rect x="4" y="4" width="16" height="16" rx="4.5" stroke="currentColor" stroke-width="1.75"/><circle cx="12" cy="12" r="3.5" stroke="currentColor" stroke-width="1.75"/><circle cx="16.6" cy="7.4" r="0.9" fill="currentColor"/>',
        'linkedin' => '<rect x="3.5" y="3.5" width="17" height="17" rx="2.5" stroke="currentColor" stroke-width="1.5"/><path d="M7.8 10V16.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/><circle cx="7.8" cy="7.4" r="1.05" fill="currentColor"/><path d="M11.3 16.5V13C11.3 11.6 12.1 10.7 13.3 10.7C14.5 10.7 15.1 11.5 15.1 13V16.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.3 10.9V16.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/>',
    ];

    return '<svg class="' . e($classe) . '" viewBox="0 0 24 24" fill="none" aria-hidden="true">' . ($desenhos[$rede] ?? '') . '</svg>';
}

/**
 * Classes de um botão. Também serve para dar aparência de botão a links.
 * Variantes: primario, contorno, inverso, inverso-leve.
 */
function classes_botao(string $variante = 'primario', string $tamanho = 'md', string $extra = ''): string
{
    $base = 'inline-flex items-center justify-center gap-2 rounded-full font-medium transition-[color,background-color,border-color,box-shadow,transform] duration-200 hover:-translate-y-px active:translate-y-0 active:scale-[0.97] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:opacity-50 disabled:pointer-events-none disabled:hover:translate-y-0 disabled:active:scale-100';

    // Preenchimento branco que corre da esquerda para a direita no hover.
    $varredura = 'btn-sweep bg-no-repeat bg-left bg-[length:0%_100%] bg-[image:linear-gradient(white,white)] hover:bg-[length:100%_100%] focus-visible:bg-[length:100%_100%]';

    $variantes = [
        'primario' => "bg-brand-600 text-white shadow-soft hover:text-brand-600 focus-visible:text-brand-600 $varredura",
        'contorno' => 'border border-border-subtle bg-transparent text-foreground hover:bg-surface-muted',
        'inverso' => 'bg-white text-brand-900 shadow-soft hover:bg-brand-50',
        'inverso-leve' => 'bg-white/10 text-white hover:bg-white/20',
    ];

    $tamanhos = [
        'sm' => 'h-9 px-4 text-sm',
        'md' => 'h-11 px-6 text-sm',
        'lg' => 'h-13 px-8 text-base',
    ];

    return trim("$base {$variantes[$variante]} {$tamanhos[$tamanho]} $extra");
}

/** Abre um bloco que surge com fade ao entrar na tela (ver site.js). */
function revelar_abre(int $atraso = 0, string $classe = ''): string
{
    return '<div class="revelar ' . e($classe) . '" data-atraso="' . $atraso . '">';
}

function revelar_fecha(): string
{
    return '</div>';
}

/** Selo de categoria em caixa-alta (ex: VAREJO). */
function selo(string $texto): string
{
    return '<span class="inline-flex items-center rounded bg-brand-50 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wide text-brand-700">' . e($texto) . '</span>';
}

/** Etiquetas discretas lado a lado (ex: segmentos atendidos). */
function etiquetas(array $itens, string $classe = ''): string
{
    $html = '<ul class="flex flex-wrap gap-2 ' . e($classe) . '">';
    foreach ($itens as $item) {
        $html .= '<li class="rounded bg-surface-muted px-2.5 py-1 text-xs font-medium text-foreground/60">' . e($item) . '</li>';
    }

    return $html . '</ul>';
}

/** Topo de uma seção: rótulo pequeno, título e descrição opcional. */
function titulo_secao(string $rotulo, string $titulo, ?string $descricao = null, bool $centro = false): string
{
    $html = '<div class="max-w-2xl' . ($centro ? ' mx-auto text-center' : '') . '">';
    $html .= '<p class="mb-4 text-sm font-semibold uppercase tracking-wide text-brand-fg">' . e($rotulo) . '</p>';
    $html .= '<h2 class="text-4xl font-bold tracking-tight text-foreground sm:text-5xl lg:text-[3.25rem] lg:leading-[1.1]">' . e($titulo) . '</h2>';
    if ($descricao) {
        $html .= '<p class="mt-5 text-base leading-relaxed text-foreground/70 sm:text-lg">' . e($descricao) . '</p>';
    }

    return $html . '</div>';
}

/** Faixa de abertura das páginas internas. */
function cabecalho_pagina(string $rotulo, string $titulo, string $descricao, ?array $voltar = null): string
{
    $html = '<section class="border-b border-border-subtle bg-surface-muted py-20 lg:py-24">';
    $html .= '<div class="mx-auto w-full max-w-7xl px-6 lg:px-8 max-w-2xl text-center">';
    if ($voltar) {
        $html .= '<a href="' . e($voltar['link']) . '" class="text-sm font-medium text-foreground/60 transition-colors hover:text-foreground">← ' . e($voltar['titulo']) . '</a>';
    }
    $html .= revelar_abre();
    $html .= '<p class="text-xs font-semibold uppercase tracking-wide text-brand-fg' . ($voltar ? ' mt-4' : '') . '">' . e($rotulo) . '</p>';
    $html .= '<h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground sm:text-5xl">' . e($titulo) . '</h1>';
    $html .= '<p class="mt-6 text-lg leading-relaxed text-foreground/70">' . e($descricao) . '</p>';
    $html .= revelar_fecha();

    return $html . '</div></section>';
}

/** Faixa escura de contato que fecha quase todas as páginas. */
function banner_cta(string $titulo, string $descricao, string $rotulo_primario = 'Fale com a World System'): string
{
    $html = '<section class="relative overflow-hidden">';
    $html .= '<div class="revelar relative bg-gradient-to-br from-brand-950 via-brand-700 to-accent-700" data-atraso="0">';
    $html .= '<div aria-hidden="true" class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_50%_80%_at_15%_50%,var(--brand-500),transparent)] opacity-40"></div>';
    $html .= '<div class="mx-auto w-full max-w-7xl px-6 lg:px-8 relative flex flex-col gap-8 py-14 lg:flex-row lg:items-center lg:justify-between lg:gap-10 lg:py-16">';
    $html .= '<div class="max-w-xl">';
    $html .= '<h2 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">' . e($titulo) . '</h2>';
    $html .= '<p class="mt-3 text-base leading-relaxed text-white/70">' . e($descricao) . '</p>';
    $html .= '</div>';
    $html .= '<div class="flex flex-col gap-3 sm:flex-row lg:shrink-0">';
    $html .= '<a href="' . url('contato.php') . '" class="' . classes_botao('inverso', 'lg', 'group/link') . '">' . e($rotulo_primario) . icone('seta-direita', 'size-4 transition-transform duration-200 group-hover/link:translate-x-1') . '</a>';
    $html .= '<a href="' . url('solucoes.php') . '" class="' . classes_botao('inverso-leve', 'lg') . '">Conheça nossas soluções</a>';
    $html .= '</div></div></div></section>';

    return $html;
}

/** Lista de soluções em cartões, com o número marca-d'água ao fundo. */
function lista_solucoes(string $classe = ''): string
{
    $html = '<div class="flex flex-col gap-6 ' . e($classe) . '">';

    foreach (SOLUCOES as $indice => $solucao) {
        $numero = str_pad((string) ($indice + 1), 2, '0', STR_PAD_LEFT);
        $html .= revelar_abre($indice * 60);
        $html .= '<div class="group relative overflow-hidden rounded-xl border border-border-subtle bg-surface p-8 transition-colors duration-300 ease-out hover:border-brand-200 lg:p-10">';
        $html .= '<span aria-hidden="true" style="opacity: var(--watermark-opacity)" class="pointer-events-none absolute -right-2 -top-8 select-none text-[7rem] font-bold leading-none tracking-tighter text-foreground lg:-top-10 lg:text-[9rem]">' . $numero . '</span>';
        $html .= '<div class="relative grid grid-cols-1 gap-8 lg:grid-cols-[1fr_auto] lg:items-center"><div>';
        $html .= selo($solucao['categoria']);
        $html .= '<h3 class="mt-3 text-2xl font-bold tracking-tight text-foreground">' . e($solucao['nome']) . '</h3>';
        $html .= '<p class="mt-2 max-w-2xl text-sm leading-relaxed text-foreground/70">' . e($solucao['descricao']) . '</p>';
        if (!empty($solucao['segmentos'])) {
            $html .= etiquetas($solucao['segmentos'], 'mt-4');
        }
        $html .= '</div>';
        $html .= '<a href="' . url('solucao.php?s=' . $solucao['slug']) . '" class="' . classes_botao('primario', 'md', 'group/link shrink-0') . '">Ver detalhes' . icone('seta-direita', 'size-4 transition-transform duration-200 group-hover/link:translate-x-1') . '</a>';
        $html .= '</div></div>';
        $html .= revelar_fecha();
    }

    return $html . '</div>';
}

/** Abas de recursos. A troca de aba é feita no navegador (site.js). */
function abas_recursos(array $grupos): string
{
    $total_itens = array_sum(array_map(fn ($grupo) => count($grupo['itens']), $grupos));

    $html = '<div>';
    $html .= '<div class="mb-6 flex flex-wrap items-center gap-x-3 gap-y-2 text-sm text-foreground/60">';
    $html .= '<span><strong class="font-semibold text-foreground">' . count($grupos) . '</strong> categorias</span>';
    $html .= '<span class="size-1 rounded-full bg-border-subtle" aria-hidden="true"></span>';
    $html .= '<span><strong class="font-semibold text-foreground">' . $total_itens . '</strong> recursos inclusos</span>';
    $html .= '</div>';

    $html .= '<div class="abas relative overflow-hidden rounded-tr-3xl border border-border-subtle bg-surface/70 backdrop-blur-xl">';
    $html .= '<div aria-hidden="true" class="pointer-events-none absolute -top-20 right-0 size-64 rounded-full bg-accent-500/10 blur-3xl"></div>';
    $html .= '<div aria-hidden="true" class="pointer-events-none absolute -bottom-24 left-0 size-64 rounded-full bg-brand-500/10 blur-3xl"></div>';

    $html .= '<div role="tablist" aria-label="Categorias de recursos" class="relative flex flex-wrap gap-2 border-b border-border-subtle p-3">';
    foreach ($grupos as $indice => $grupo) {
        $ativa = $indice === 0;
        $classes = $ativa
            ? 'bg-brand-600 text-white shadow-soft'
            : 'text-foreground/60 hover:bg-surface hover:text-foreground';
        $html .= '<button type="button" role="tab" data-aba="' . $indice . '" aria-selected="' . ($ativa ? 'true' : 'false') . '" class="aba relative rounded-lg px-4 py-2.5 text-sm font-medium transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 focus-visible:ring-offset-background ' . $classes . '">' . e($grupo['titulo']) . '</button>';
    }
    $html .= '</div>';

    foreach ($grupos as $indice => $grupo) {
        $html .= '<div class="painel relative p-6 lg:p-9' . ($indice === 0 ? '' : ' hidden') . '" data-painel="' . $indice . '">';
        $html .= '<h3 class="text-xl font-semibold tracking-tight text-foreground">' . e($grupo['titulo']) . '</h3>';
        $html .= '<p class="mt-2 max-w-2xl text-sm leading-relaxed text-foreground/70">' . e($grupo['descricao']) . '</p>';
        $html .= '<ul class="mt-7 grid grid-cols-1 gap-3 sm:grid-cols-2">';
        foreach ($grupo['itens'] as $item) {
            $html .= '<li class="flex items-start gap-3 rounded-lg border border-border-subtle bg-surface p-4 transition-colors duration-200 hover:border-brand-200">';
            $html .= '<span aria-hidden="true" class="mt-[0.4rem] size-1.5 shrink-0 rounded-full bg-accent-500"></span>';
            $html .= '<span class="text-sm leading-snug text-foreground/80">' . e($item) . '</span></li>';
        }
        $html .= '</ul></div>';
    }

    return $html . '</div></div>';
}

/** Grade de integrações. Sem o parâmetro, mostra só as 6 primeiras. */
function grade_integracoes(bool $completo = false): string
{
    $itens = $completo ? INTEGRACOES : array_slice(INTEGRACOES, 0, 6);

    $html = '<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">';
    foreach ($itens as $indice => $integracao) {
        $html .= revelar_abre($indice * 50);
        $html .= '<div class="h-full rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">';
        $html .= '<span class="inline-flex items-center rounded bg-surface-muted px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wide text-foreground/50">' . e($integracao['categoria']) . '</span>';
        $html .= '<p class="mt-2.5 text-lg font-bold tracking-tight text-foreground">' . e($integracao['nome']) . '</p>';
        $html .= '<p class="mt-1.5 text-sm leading-relaxed text-foreground/70">' . e($integracao['descricao']) . '</p>';
        $html .= '</div>';
        $html .= revelar_fecha();
    }

    return $html . '</div>';
}

/** Botões das redes sociais. */
function redes_sociais(string $classe = ''): string
{
    $redes = [
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'linkedin' => 'LinkedIn',
    ];

    $html = '<div class="flex items-center gap-3 ' . e($classe) . '">';
    foreach ($redes as $chave => $rotulo) {
        $link = CONTATO['redes'][$chave] ?? '';
        if (!$link) {
            continue;
        }
        $html .= '<a href="' . e($link) . '" target="_blank" rel="noopener noreferrer" aria-label="' . e($rotulo) . '" class="flex size-10 items-center justify-center rounded-full border border-border-subtle text-foreground/70 transition-colors hover:border-brand-fg hover:text-brand-fg">' . icone_rede($chave) . '</a>';
    }

    return $html . '</div>';
}
