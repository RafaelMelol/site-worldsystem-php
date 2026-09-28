<?php
// Recebe o formulário da página de Contato e envia o e-mail de aviso.
// Passo a passo: limita os envios por IP → valida os campos → ignora robôs
// (campo-armadilha) → envia o e-mail para a empresa.

require_once __DIR__ . '/../inc/config.php';
require_once __DIR__ . '/../inc/validacao.php';
require_once __DIR__ . '/../inc/email.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    responder(['ok' => false, 'mensagem' => 'Requisição inválida.'], 405);
}

if (!dentro_do_limite('contato:' . ip_do_visitante(), 5)) {
    responder(['ok' => false, 'mensagem' => 'Muitas tentativas. Aguarde um minuto e tente novamente.'], 429);
}

$erros = [];
validar_campos_comuns($erros);

if (tamanho(texto('assunto')) < 2) {
    $erros['assunto'] = 'Informe o assunto.';
}
if (tamanho(texto('mensagem')) < 10) {
    $erros['mensagem'] = 'Sua mensagem deve ter pelo menos 10 caracteres.';
}

if ($erros) {
    responder(['ok' => false, 'mensagem' => 'Verifique os campos preenchidos.', 'erros' => $erros], 400);
}

// Campo-armadilha preenchido = robô. Responde sucesso, mas não envia nada.
if (texto('website') !== '') {
    responder(['ok' => true]);
}

$corpo = "Nome: " . texto('nome') . "\n"
    . "E-mail: " . texto('email') . "\n"
    . "Telefone: " . texto('telefone') . "\n"
    . "Assunto: " . texto('assunto') . "\n\n"
    . "Mensagem:\n" . texto('mensagem');

$enviado = enviar_email(
    '[Contato] ' . texto('assunto') . ' — ' . texto('nome'),
    $corpo,
    texto('email')
);

if (!$enviado) {
    responder([
        'ok' => false,
        'mensagem' => 'Não foi possível enviar sua mensagem agora. Tente novamente em alguns minutos ou fale conosco pelo telefone ' . CONTATO['telefone_exibicao'] . '.',
    ], 502);
}

responder(['ok' => true]);
