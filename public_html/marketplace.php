<?php
// Página de retorno da autorização dos marketplaces (Shopee e Mercado Livre).
//
// A plataforma redireciona para cá com os dados na URL:
//   Shopee:        /marketplace.php?code=xxxxx&shop_id=xxxx
//   Mercado Livre: /marketplace.php?code=TG-xxxxx  (só o code)
// Aqui só exibimos esses valores com um botão de copiar. Nada é salvo.

require_once __DIR__ . '/inc/config.php';

/** Lê um parâmetro da URL. Se vier repetido, usa o primeiro; vazio vira "". */
function parametro(string $nome): string
{
    $valor = $_GET[$nome] ?? '';
    if (is_array($valor)) {
        $valor = $valor[0] ?? '';
    }

    return trim((string) $valor);
}

$code = parametro('code');
$shop_id = parametro('shop_id');
$conta_principal = parametro('main_account_id');

// Com shop_id (ou main_account_id) é Shopee; só com o code é Mercado Livre.
$eh_shopee = $shop_id !== '' || $conta_principal !== '';
$marketplace = $eh_shopee ? 'Shopee' : 'Mercado Livre';

$campos = array_filter([
    'Code' => $code,
    'Shop ID' => $shop_id,
    'Main Account ID' => $conta_principal,
], fn ($valor) => $valor !== '');

$titulo = 'Autorização de marketplace';
$descricao = 'Página interna de autorização de marketplace.';
$sem_indexacao = true;

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="py-20 lg:py-28">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?php if ($code !== ''): ?>
      <p class="text-xs font-semibold uppercase tracking-wide text-brand-fg"><?= e($marketplace) ?></p>
      <h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground sm:text-5xl">
        Copie aqui seus códigos <?= $eh_shopee ? 'da Shopee' : 'do Mercado Livre' ?>
      </h1>

      <div class="mt-10 flex flex-col gap-4">
        <?php foreach ($campos as $rotulo => $valor): ?>
          <div class="flex flex-col gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200 sm:flex-row sm:items-center sm:justify-between">
            <div class="min-w-0">
              <p class="text-xs font-semibold uppercase tracking-wide text-foreground/60"><?= e($rotulo) ?></p>
              <p class="mt-2 break-all font-mono text-lg text-foreground"><?= e($valor) ?></p>
            </div>
            <button type="button" class="copiar <?= classes_botao('contorno', 'sm', 'shrink-0') ?>" data-valor="<?= e($valor) ?>" aria-label="Copiar <?= e($rotulo) ?>">
              <span class="icone-copiar"><?= icone('copiar', 'size-4') ?></span>
              <span class="icone-copiado hidden"><?= icone('check', 'size-4') ?></span>
              <span class="texto" aria-live="polite">Copiar</span>
            </button>
          </div>
        <?php endforeach; ?>
      </div>

      <p class="mt-6 text-sm leading-relaxed text-foreground/60">
        O código expira em 10 minutos e é de uso único. Se expirar, gere uma nova autorização na
        plataforma <?= $eh_shopee ? 'da Shopee' : 'do Mercado Livre' ?>.
      </p>
    <?php else: ?>
      <p class="text-xs font-semibold uppercase tracking-wide text-brand-fg">Marketplace</p>
      <h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground sm:text-5xl">Autorização de marketplace</h1>

      <div class="mt-10 rounded-xl border border-border-subtle bg-surface p-7">
        <p class="font-semibold text-foreground">Nenhum código encontrado</p>
        <p class="mt-2 text-sm leading-relaxed text-foreground/70">
          Esta página deve ser aberta pelo link gerado na plataforma da Shopee ou do Mercado Livre,
          que já traz os dados no endereço.
        </p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
