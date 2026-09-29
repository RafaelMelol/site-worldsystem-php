<?php
// Tela de entrada do painel.

require_once __DIR__ . '/inc/sessao.php';
require_once __DIR__ . '/inc/layout-admin.php';

sessao_iniciar();

if (admin_logado()) {
    header('Location: ' . url('admin/'));
    exit;
}

$erro = null;

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
    // No máximo 5 tentativas por minuto, para dificultar tentativa de adivinhação.
    if (!dentro_do_limite('admin:' . ip_do_visitante(), 5)) {
        $erro = 'Muitas tentativas. Aguarde um minuto e tente novamente.';
    } elseif (admin_login((string) ($_POST['usuario'] ?? ''), (string) ($_POST['senha'] ?? ''))) {
        header('Location: ' . url('admin/'));
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos.';
    }
}

admin_topo('Entrar', false);
?>

<div class="mx-auto w-full max-w-md px-6 py-10">
  <div class="text-center">
    <img src="<?= arquivo('assets/img/logo.png') ?>" alt="World System" width="1569" height="281" class="logo-mark mx-auto h-10 w-auto">
    <h1 class="mt-8 text-2xl font-bold tracking-tight text-foreground">Painel de vagas</h1>
    <p class="mt-2 text-sm text-foreground/60">Entre para cadastrar e editar as vagas do site.</p>
  </div>

  <div class="mt-8 rounded-xl border border-border-subtle bg-surface p-7">
    <?= $erro ? admin_aviso('erro', $erro) : '' ?>

    <form method="post" class="flex flex-col gap-5">
      <div class="flex flex-col gap-1.5">
        <label for="usuario" class="text-sm font-medium text-foreground">Usuário</label>
        <input id="usuario" name="usuario" required autocomplete="username" autofocus class="campo">
      </div>

      <div class="flex flex-col gap-1.5">
        <label for="senha" class="text-sm font-medium text-foreground">Senha</label>
        <input id="senha" name="senha" type="password" required autocomplete="current-password" class="campo">
      </div>

      <button type="submit" class="<?= classes_botao('primario', 'lg', 'w-full') ?>">Entrar</button>
    </form>
  </div>

  <p class="mt-6 text-center text-sm">
    <a href="<?= url() ?>" class="text-foreground/60 transition-colors hover:text-foreground">← Voltar para o site</a>
  </p>
</div>

<?php admin_rodape(); ?>
