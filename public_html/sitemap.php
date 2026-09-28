<?php
// Lista de páginas que os buscadores devem indexar (sitemap.xml).
// As páginas de solução entram sozinhas, a partir do conteúdo.

require_once __DIR__ . '/inc/config.php';

header('Content-Type: application/xml; charset=utf-8');

$paginas = ['/', '/empresa.php', '/solucoes.php', '/recursos.php', '/integracoes.php', '/suporte.php', '/faq.php', '/oportunidades.php', '/contato.php'];

foreach (SOLUCOES as $solucao) {
    $paginas[] = '/solucao.php?s=' . $solucao['slug'];
}

$hoje = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

foreach ($paginas as $pagina) {
    $inicial = $pagina === '/';
    echo "  <url>\n";
    echo '    <loc>' . e(SITE['url'] . $pagina) . "</loc>\n";
    echo "    <lastmod>$hoje</lastmod>\n";
    echo '    <changefreq>' . ($inicial ? 'weekly' : 'monthly') . "</changefreq>\n";
    echo '    <priority>' . ($inicial ? '1.0' : '0.7') . "</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>';
