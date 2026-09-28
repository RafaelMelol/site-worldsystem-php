<?php
// Recebe o currículo da página Oportunidades, envia para a empresa com o
// arquivo em anexo e manda um aviso de recebimento para o candidato.

require_once __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../inc/validacao.php';
require_once __DIR__ . '/../inc/email.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    responder(['ok' => false, 'mensagem' => 'Requisição inválida.'], 405);
}

if (!dentro_do_limite('curriculo:' . ip_do_visitante(), 3)) {
    responder(['ok' => false, 'mensagem' => 'Muitas tentativas. Aguarde um minuto e tente novamente.'], 429);
}

$erros = [];
validar_campos_comuns($erros);

if ($erros) {
    responder(['ok' => false, 'mensagem' => 'Verifique os campos preenchidos.', 'erros' => $erros], 400);
}

if (texto('website') !== '') {
    responder(['ok' => true]);
}

$erro_arquivo = validar_curriculo($_FILES['curriculo'] ?? null);
if ($erro_arquivo) {
    responder(['ok' => false, 'mensagem' => $erro_arquivo, 'erros' => ['curriculo' => $erro_arquivo]], 400);
}

$arquivo = $_FILES['curriculo'];
$nome_arquivo = nome_de_arquivo_seguro((string) $arquivo['name']);
$tamanho_kb = (int) round($arquivo['size'] / 1024);

$corpo = "Nome: " . texto('nome') . "\n"
    . "E-mail: " . texto('email') . "\n"
    . "Telefone: " . texto('telefone') . "\n"
    . "Observações: " . (texto('observacoes') ?: '-') . "\n\n"
    . "Currículo em anexo: $nome_arquivo ($tamanho_kb KB)";

$enviado = enviar_email(
    '[Oportunidades] Novo currículo recebido — ' . texto('nome'),
    $corpo,
    texto('email'),
    null,
    [
        'nome' => $nome_arquivo,
        'tipo' => tipo_do_arquivo($arquivo['tmp_name'], (string) $arquivo['name']),
        'caminho' => $arquivo['tmp_name'],
    ]
);

if (!$enviado) {
    responder([
        'ok' => false,
        'mensagem' => 'Não foi possível enviar seu currículo agora. Tente novamente em alguns minutos ou fale conosco pelo telefone ' . CONTATO['telefone_exibicao'] . '.',
    ], 502);
}

// Aviso de recebimento para o candidato. Se falhar, não atrapalha o envio.
enviar_email(
    'Recebemos seu currículo — World System',
    "Olá, " . texto('nome') . "!\n\n"
        . "Recebemos seu currículo e ele já está com a nossa equipe. Se o seu perfil for compatível com alguma oportunidade, entraremos em contato.\n\n"
        . "Obrigado pelo interesse em fazer parte da World System.\n\n"
        . "World System – Soluções em TI\n"
        . CONTATO['telefone_exibicao'],
    EMAIL_DESTINO,
    texto('email')
);

responder(['ok' => true]);
