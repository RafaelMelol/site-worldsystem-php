<?php
// Envio dos e-mails dos formulários, usando a função mail() do PHP.
// Na hospedagem, o e-mail sai pelo servidor do próprio domínio.

/**
 * Envia um e-mail de texto, com anexo opcional.
 *
 * $anexo, quando informado: ['nome' => 'curriculo.pdf', 'tipo' => 'application/pdf', 'caminho' => '/tmp/php123']
 * Devolve true quando o servidor aceita a mensagem para envio.
 */
function enviar_email(
    string $assunto,
    string $texto,
    ?string $responder_para = null,
    ?string $destino = null,
    ?array $anexo = null
): bool {
    $destino = $destino ?: EMAIL_DESTINO;

    // O assunto precisa ser codificado para acentos não virarem lixo.
    $assunto_codificado = '=?UTF-8?B?' . base64_encode($assunto) . '?=';

    $cabecalhos = [
        'From: World System <' . EMAIL_REMETENTE . '>',
        'MIME-Version: 1.0',
    ];

    if ($responder_para) {
        $cabecalhos[] = 'Reply-To: ' . $responder_para;
    }

    if ($anexo && is_readable($anexo['caminho'])) {
        $separador = '=_' . bin2hex(random_bytes(16));
        $cabecalhos[] = 'Content-Type: multipart/mixed; boundary="' . $separador . '"';

        $conteudo = chunk_split(base64_encode((string) file_get_contents($anexo['caminho'])));

        $corpo = "--$separador\r\n"
            . "Content-Type: text/plain; charset=UTF-8\r\n"
            . "Content-Transfer-Encoding: 8bit\r\n\r\n"
            . $texto . "\r\n\r\n"
            . "--$separador\r\n"
            . 'Content-Type: ' . $anexo['tipo'] . '; name="' . $anexo['nome'] . "\"\r\n"
            . "Content-Transfer-Encoding: base64\r\n"
            . 'Content-Disposition: attachment; filename="' . $anexo['nome'] . "\"\r\n\r\n"
            . $conteudo . "\r\n"
            . "--$separador--";
    } else {
        $cabecalhos[] = 'Content-Type: text/plain; charset=UTF-8';
        $corpo = $texto;
    }

    return mail($destino, $assunto_codificado, $corpo, implode("\r\n", $cabecalhos));
}
