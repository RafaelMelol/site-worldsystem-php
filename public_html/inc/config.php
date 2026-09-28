<?php
// Configurações gerais e funções usadas em todas as páginas.

const SITE = [
    'nome' => 'World System - Soluções em TI',
    'nome_curto' => 'World System',
    'url' => 'https://www.wsionline.com.br',
    'descricao' => 'Soluções em TI para gestão e automação de pequenas indústrias, atacados e varejos. Desde 1993 desenvolvendo sistemas de retaguarda, PDV e emissão fiscal para empresas de Minas Gerais e do Brasil.',
];

// Para onde vão os e-mails dos formulários e de qual endereço eles saem.
const EMAIL_DESTINO = 'contato@wsionline.com.br';
const EMAIL_REMETENTE = 'site@wsionline.com.br';

// Currículo: tipos aceitos e tamanho máximo.
const CURRICULO_TIPOS = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
const CURRICULO_MAX_BYTES = 4 * 1024 * 1024;

require_once __DIR__ . '/conteudo/contato.php';
require_once __DIR__ . '/conteudo/navegacao.php';
require_once __DIR__ . '/conteudo/empresa.php';
require_once __DIR__ . '/conteudo/solucoes.php';
require_once __DIR__ . '/conteudo/recursos.php';
require_once __DIR__ . '/conteudo/integracoes.php';
require_once __DIR__ . '/conteudo/faq.php';

/** Escapa texto para não quebrar o HTML nem permitir injeção. */
function e(?string $texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

/** Caminho de uma página, sempre a partir da raiz do site. */
function url(string $caminho = ''): string
{
    return '/' . ltrim($caminho, '/');
}

/**
 * Caminho de um arquivo de CSS, JS ou imagem com a data da última alteração
 * no fim (ex: /assets/js/site.js?v=1790000000).
 *
 * Sem isso, o navegador continua usando a versão guardada em cache depois de
 * uma atualização — e uma mistura de CSS novo com JS antigo quebra a página.
 */
function arquivo(string $caminho): string
{
    $completo = __DIR__ . '/../' . ltrim($caminho, '/');
    $versao = is_file($completo) ? filemtime($completo) : time();

    return url($caminho) . '?v=' . $versao;
}

/** Marca o item do menu correspondente à página aberta. */
function pagina_atual(): string
{
    return basename((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
}

/** Anos completos desde a fundação, usado no contador da home. */
function anos_de_mercado(): int
{
    return (int) date('Y') - EMPRESA['ano_fundacao'];
}
