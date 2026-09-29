<?php
// Sessão, login e proteção contra envio de formulários de fora do painel.

require_once __DIR__ . '/../../inc/config.php';
require_once __DIR__ . '/../../inc/validacao.php';

/** Inicia a sessão com as opções de segurança. */
function sessao_iniciar(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Strict',
        // Só exige HTTPS quando a página já está em HTTPS, para funcionar
        // também no servidor local de testes.
        'secure' => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}

/** Dados de acesso do painel (usuário e senha cifrada). */
function admin_config(): array
{
    $caminho = __DIR__ . '/../../inc/config-admin.php';
    if (!is_file($caminho)) {
        throw new RuntimeException('Configuração do painel não encontrada. Crie o arquivo inc/config-admin.php a partir do config-admin.example.php.');
    }

    return require $caminho;
}

/** Confere usuário e senha. */
function admin_login(string $usuario, string $senha): bool
{
    $config = admin_config();

    $usuarioCorreto = hash_equals($config['usuario'], $usuario);
    $senhaCorreta = password_verify($senha, $config['senha_hash']);

    if (!$usuarioCorreto || !$senhaCorreta) {
        return false;
    }

    // Troca o identificador da sessão no login, contra roubo de sessão.
    session_regenerate_id(true);
    $_SESSION['admin'] = $usuario;
    $_SESSION['entrou_em'] = time();

    return true;
}

/** Encerra a sessão. */
function admin_sair(): void
{
    $_SESSION = [];
    session_destroy();
}

/** Diz se há alguém logado. */
function admin_logado(): bool
{
    return !empty($_SESSION['admin']);
}

/** Manda para o login quem não está logado. */
function exigir_login(): void
{
    sessao_iniciar();
    if (!admin_logado()) {
        header('Location: ' . url('admin/login.php'));
        exit;
    }
}

/** Token que acompanha os formulários do painel. */
function token(): string
{
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['token'];
}

/** Recusa envios que não vieram de um formulário do painel. */
function exigir_token(): void
{
    $enviado = (string) ($_POST['token'] ?? '');
    if (!hash_equals($_SESSION['token'] ?? '', $enviado)) {
        http_response_code(400);
        exit('Sessão expirada. Volte ao painel e tente de novo.');
    }
}
