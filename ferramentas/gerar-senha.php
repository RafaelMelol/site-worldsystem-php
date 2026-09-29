<?php
// Gera a senha cifrada (hash) para o painel.
//
// Rode na pasta do projeto:  php ferramentas/gerar-senha.php
// Depois cole o resultado em public_html/inc/config-admin.php.
//
// A senha digitada não é gravada em lugar nenhum: só o hash aparece na tela.

if (PHP_SAPI !== 'cli') {
    exit('Este arquivo só roda pela linha de comando.');
}

echo "Digite a senha do painel: ";

// Esconde o que está sendo digitado, quando o sistema permite.
$escondeu = false;
if (DIRECTORY_SEPARATOR !== '\\' && function_exists('shell_exec')) {
    shell_exec('stty -echo 2>/dev/null');
    $escondeu = true;
}

$senha = trim((string) fgets(STDIN));

if ($escondeu) {
    shell_exec('stty echo 2>/dev/null');
    echo PHP_EOL;
}

if (strlen($senha) < 8) {
    exit("\nA senha precisa ter pelo menos 8 caracteres.\n");
}

echo PHP_EOL . "Cole isto no config-admin.php:" . PHP_EOL . PHP_EOL;
echo "    'senha_hash' => '" . password_hash($senha, PASSWORD_DEFAULT) . "'," . PHP_EOL . PHP_EOL;
