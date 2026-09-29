<?php
// Conexão com o banco de dados (MySQL/MariaDB).

/**
 * Devolve a conexão, criando-a na primeira chamada.
 *
 * Os dados de acesso ficam em inc/config-banco.php, que não vai para o Git.
 * Use inc/config-banco.example.php como modelo.
 */
function banco(): PDO
{
    static $conexao = null;

    if ($conexao instanceof PDO) {
        return $conexao;
    }

    $caminho = __DIR__ . '/config-banco.php';
    if (!is_file($caminho)) {
        throw new RuntimeException('Configuração do banco não encontrada. Crie o arquivo inc/config-banco.php a partir do config-banco.example.php.');
    }

    $config = require $caminho;

    $dsn = sprintf(
        'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
        $config['host'],
        $config['porta'] ?? 3306,
        $config['banco']
    );

    $conexao = new PDO($dsn, $config['usuario'], $config['senha'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Consultas de verdade, não emuladas: evita surpresas com tipos.
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $conexao;
}
