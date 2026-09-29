<?php
// Encerra a sessão do painel.

require_once __DIR__ . '/inc/sessao.php';

sessao_iniciar();
admin_sair();

header('Location: ' . url('admin/login.php'));
exit;
