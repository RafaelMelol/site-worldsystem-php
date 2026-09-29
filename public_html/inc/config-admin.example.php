<?php
// Copie este arquivo para config-admin.php e preencha com o seu acesso.
// O config-admin.php fica fora do Git, porque guarda a senha cifrada.
//
// Para gerar a senha cifrada, rode na pasta do projeto:
//   php ferramentas/gerar-senha.php
// e cole abaixo o resultado.

return [
    'usuario' => 'admin',
    'senha_hash' => 'cole_aqui_o_hash_gerado',
];
