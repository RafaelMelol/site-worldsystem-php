<?php
// Página de Contato: canais de atendimento e mapa à esquerda, formulário à direita.

require_once __DIR__ . '/inc/config.php';

$titulo = 'Contato';
$descricao = 'Fale com a World System – Soluções em TI. Rua Santa Catarina, 273, Lagoa da Prata/MG. Telefone (37) 3261-3366, e-mail contato@wsionline.com.br.';

// Mapa do Google montado a partir do endereço (não precisa de chave de API).
$endereco_completo = CONTATO['endereco']['rua'] . ', ' . CONTATO['endereco']['bairro'] . ', '
    . CONTATO['endereco']['cidade'] . '/' . CONTATO['endereco']['estado'] . ', ' . CONTATO['endereco']['cep'];
$mapa = 'https://www.google.com/maps?q=' . rawurlencode($endereco_completo) . '&output=embed';

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="py-20 lg:py-28">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= revelar_abre() ?>
      <div class="max-w-2xl">
        <p class="text-xs font-semibold uppercase tracking-wide text-brand-fg">Contato</p>
        <h1 class="mt-4 text-4xl font-bold tracking-tight text-foreground sm:text-5xl">Vamos conversar sobre o seu negócio</h1>
        <p class="mt-6 text-lg leading-relaxed text-foreground/70">
          Preencha o formulário ou utilize um dos canais abaixo. Nossa equipe responde o quanto antes.
        </p>
      </div>
    <?= revelar_fecha() ?>

    <div class="mt-14 grid grid-cols-1 gap-10 lg:grid-cols-[1fr_1.3fr]">
      <?= revelar_abre(0, 'flex flex-col gap-5') ?>
        <div class="flex flex-col items-start gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out sm:flex-row sm:items-center sm:justify-between">
          <div class="flex items-start gap-4">
            <?= icone('balao', 'mt-0.5 size-5 shrink-0 text-brand-fg') ?>
            <div>
              <h3 class="text-xl font-bold tracking-tight text-foreground">WhatsApp</h3>
              <p class="mt-1 text-sm leading-relaxed text-foreground/70">
                Fale agora com a nossa equipe pelo <?= e(CONTATO['telefone_exibicao']) ?>.
              </p>
            </div>
          </div>
          <button type="button" id="botao-whatsapp" data-telefone="<?= e(CONTATO['telefone']) ?>" class="<?= classes_botao('primario', 'sm', 'w-full shrink-0 sm:w-auto') ?>">
            Conversar no WhatsApp
          </button>
        </div>

        <div class="flex items-start gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
          <?= icone('mapa', 'mt-0.5 size-5 shrink-0 text-brand-fg') ?>
          <div>
            <h3 class="text-xl font-bold tracking-tight text-foreground">Endereço</h3>
            <div class="mt-1 text-sm leading-relaxed text-foreground/70">
              <?= e(CONTATO['endereco']['rua']) ?> – <?= e(CONTATO['endereco']['bairro']) ?><br>
              <?= e(CONTATO['endereco']['cep']) ?> – <?= e(CONTATO['endereco']['cidade']) ?>/<?= e(CONTATO['endereco']['estado']) ?>
            </div>
          </div>
        </div>

        <div class="flex items-start gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
          <?= icone('telefone', 'mt-0.5 size-5 shrink-0 text-brand-fg') ?>
          <div>
            <h3 class="text-xl font-bold tracking-tight text-foreground">Telefone</h3>
            <div class="mt-1 text-sm leading-relaxed text-foreground/70">
              <a href="tel:<?= e(CONTATO['telefone']) ?>" class="hover:text-foreground"><?= e(CONTATO['telefone_exibicao']) ?></a>
            </div>
          </div>
        </div>

        <div class="flex items-start gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
          <?= icone('email', 'mt-0.5 size-5 shrink-0 text-brand-fg') ?>
          <div>
            <h3 class="text-xl font-bold tracking-tight text-foreground">E-mail</h3>
            <div class="mt-1 text-sm leading-relaxed text-foreground/70">
              <a href="mailto:<?= e(CONTATO['email']) ?>" class="hover:text-foreground"><?= e(CONTATO['email']) ?></a>
            </div>
          </div>
        </div>

        <div class="flex items-start gap-4 rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200">
          <?= icone('relogio', 'mt-0.5 size-5 shrink-0 text-brand-fg') ?>
          <div>
            <h3 class="text-xl font-bold tracking-tight text-foreground">Horário de atendimento</h3>
            <div class="mt-1 text-sm leading-relaxed text-foreground/70">
              <?= e(HORARIOS['semana_titulo']) ?>: <?= e(HORARIOS['semana_horario']) ?>
              <a href="<?= url('suporte.php#horario') ?>" class="mt-1 block font-medium text-brand-fg hover:text-brand-fg-hover">Ver horário completo</a>
            </div>
          </div>
        </div>

        <?= redes_sociais('pt-2') ?>

        <div class="overflow-hidden rounded-xl border border-border-subtle">
          <iframe title="Mapa – World System, Lagoa da Prata/MG" src="<?= e($mapa) ?>" width="100%" height="220" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="grayscale-[20%]"></iframe>
        </div>
      <?= revelar_fecha() ?>

      <?= revelar_abre(100) ?>
        <div class="rounded-xl border border-border-subtle bg-surface p-7 transition-colors duration-300 ease-out hover:border-brand-200 lg:p-8">
          <h2 class="text-xl font-semibold text-foreground">Envie uma mensagem</h2>
          <p class="mt-1.5 text-sm text-foreground/60">Respondemos em até um dia útil.</p>

          <form id="form-contato" class="mt-6 flex flex-col gap-5" novalidate>
            <div class="hidden" aria-hidden="true">
              <label for="contato-website">Não preencha este campo</label>
              <input id="contato-website" name="website" type="text" tabindex="-1" autocomplete="off">
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
              <div class="flex flex-col gap-1.5">
                <label for="contato-nome" class="text-sm font-medium text-foreground">Nome<span class="text-brand-fg"> *</span></label>
                <input id="contato-nome" name="nome" required autocomplete="name" class="campo">
                <p class="erro hidden text-xs font-medium text-red-600" data-erro="nome"></p>
              </div>
              <div class="flex flex-col gap-1.5">
                <label for="contato-email" class="text-sm font-medium text-foreground">E-mail<span class="text-brand-fg"> *</span></label>
                <input id="contato-email" name="email" type="email" required autocomplete="email" class="campo">
                <p class="erro hidden text-xs font-medium text-red-600" data-erro="email"></p>
              </div>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
              <div class="flex flex-col gap-1.5">
                <label for="contato-telefone" class="text-sm font-medium text-foreground">Telefone<span class="text-brand-fg"> *</span></label>
                <input id="contato-telefone" name="telefone" type="tel" required autocomplete="tel" class="campo">
                <p class="erro hidden text-xs font-medium text-red-600" data-erro="telefone"></p>
              </div>
              <div class="flex flex-col gap-1.5">
                <label for="contato-assunto" class="text-sm font-medium text-foreground">Assunto<span class="text-brand-fg"> *</span></label>
                <input id="contato-assunto" name="assunto" required class="campo">
                <p class="erro hidden text-xs font-medium text-red-600" data-erro="assunto"></p>
              </div>
            </div>

            <div class="flex flex-col gap-1.5">
              <label for="contato-mensagem" class="text-sm font-medium text-foreground">Mensagem<span class="text-brand-fg"> *</span></label>
              <textarea id="contato-mensagem" name="mensagem" rows="5" required class="campo min-h-32 resize-y"></textarea>
              <p class="erro hidden text-xs font-medium text-red-600" data-erro="mensagem"></p>
            </div>

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
              <button type="submit" class="<?= classes_botao('primario', 'lg') ?>">Enviar mensagem</button>
              <div class="situacao hidden items-center gap-2 rounded-lg px-4 py-3 text-sm"></div>
            </div>
          </form>
        </div>
      <?= revelar_fecha() ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
