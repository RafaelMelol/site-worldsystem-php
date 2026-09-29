<?php
// Copie este arquivo para config-banco.php e preencha com os dados do banco.
// O config-banco.php fica fora do Git, porque tem senha.
//
// Na HostGator, os dados aparecem no painel em "Bancos de Dados MySQL",
// depois de criar o banco e o usuário e ligar um ao outro.

return [
    'host' => 'localhost',
    'porta' => 3306,
    'banco' => 'nome_do_banco',
    'usuario' => 'nome_do_usuario',
    'senha' => 'senha_do_usuario',
];
