<?php
// Validação dos formulários, limite de envios por IP e resposta em JSON.

/** Devolve a resposta em JSON e encerra a execução. */
function responder(array $dados, int $codigo = 200): void
{
    http_response_code($codigo);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

/** IP de quem enviou. Atrás de proxy, ele vem em X-Forwarded-For. */
function ip_do_visitante(): string
{
    $encaminhado = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
    if ($encaminhado) {
        return trim(explode(',', $encaminhado)[0]);
    }

    return $_SERVER['REMOTE_ADDR'] ?? 'desconhecido';
}

/**
 * Deixa passar no máximo $limite envios por minuto para a mesma chave.
 * A contagem fica num arquivo temporário do servidor.
 */
function dentro_do_limite(string $chave, int $limite): bool
{
    $arquivo = sys_get_temp_dir() . '/ws-' . md5($chave) . '.txt';
    $agora = time();
    $registro = ['contagem' => 0, 'expira' => $agora + 60];

    if (is_readable($arquivo)) {
        $salvo = json_decode((string) file_get_contents($arquivo), true);
        if (is_array($salvo) && ($salvo['expira'] ?? 0) > $agora) {
            $registro = $salvo;
        }
    }

    if ($registro['contagem'] >= $limite) {
        return false;
    }

    $registro['contagem']++;
    file_put_contents($arquivo, json_encode($registro));

    return true;
}

/** Texto limpo: sem espaços nas pontas e sem quebras de linha escondidas. */
function texto(string $campo): string
{
    return trim((string) ($_POST[$campo] ?? ''));
}

/** Conta os caracteres do texto, mesmo sem a extensão mbstring instalada. */
function tamanho(string $valor): int
{
    return function_exists('mb_strlen') ? mb_strlen($valor) : strlen($valor);
}

/**
 * Descobre o tipo do arquivo pelo conteúdo. Sem a extensão fileinfo,
 * cai para a extensão do nome, que é menos confiável mas serve.
 */
function tipo_do_arquivo(string $caminho, string $nome): string
{
    if (class_exists('finfo')) {
        $tipo = (new finfo(FILEINFO_MIME_TYPE))->file($caminho);
        if ($tipo) {
            return $tipo;
        }
    }

    $extensoes = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    ];
    $extensao = strtolower((string) pathinfo($nome, PATHINFO_EXTENSION));

    return $extensoes[$extensao] ?? 'application/octet-stream';
}

/** Confere os campos comuns aos dois formulários. */
function validar_campos_comuns(array &$erros): void
{
    if (tamanho(texto('nome')) < 2) {
        $erros['nome'] = 'Informe seu nome completo.';
    }
    if (!filter_var(texto('email'), FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'Informe um e-mail válido.';
    }
    if (tamanho(texto('telefone')) < 8) {
        $erros['telefone'] = 'Informe um telefone válido.';
    }
}

/** Confere o arquivo do currículo enviado. Devolve o erro, ou null. */
function validar_curriculo(?array $arquivo): ?string
{
    if (!$arquivo || ($arquivo['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
        return 'Anexe seu currículo em PDF ou DOC.';
    }

    if ($arquivo['error'] === UPLOAD_ERR_INI_SIZE || $arquivo['error'] === UPLOAD_ERR_FORM_SIZE) {
        return 'O arquivo deve ter no máximo 4 MB.';
    }

    if ($arquivo['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($arquivo['tmp_name'])) {
        return 'Não foi possível ler o arquivo enviado. Tente novamente.';
    }

    if ($arquivo['size'] > CURRICULO_MAX_BYTES) {
        return 'O arquivo deve ter no máximo 4 MB.';
    }

    // O tipo é conferido pelo conteúdo do arquivo, não pelo que o navegador informa.
    $tipo = tipo_do_arquivo($arquivo['tmp_name'], (string) $arquivo['name']);
    if (!in_array($tipo, CURRICULO_TIPOS, true)) {
        return 'Formato inválido. Envie um arquivo PDF ou DOC/DOCX.';
    }

    return null;
}

/** Nome de arquivo seguro para usar no anexo do e-mail. */
function nome_de_arquivo_seguro(string $nome): string
{
    $nome = preg_replace('/[^A-Za-z0-9._-]/', '_', $nome) ?? 'curriculo';

    return substr($nome, 0, 80);
}
