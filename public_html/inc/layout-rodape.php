<?php
// Fim de todas as páginas: fecha o <main>, monta o rodapé e carrega o script.
?>
</main>

<footer class="border-t border-border-subtle bg-surface-muted">
  <div class="mx-auto w-full max-w-7xl px-6 py-16 lg:px-8">
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-[1.4fr_1fr_1fr_1.4fr]">
      <div>
        <span class="inline-flex items-center">
          <img src="<?= url('assets/img/logo.png') ?>" alt="World System" width="1569" height="281" class="logo-mark h-10 w-auto sm:h-11">
        </span>
        <p class="mt-4 max-w-xs text-sm leading-relaxed text-foreground/70">
          Soluções em TI para gestão e automação de pequenas indústrias, atacados e varejos desde 1993.
        </p>
        <?= redes_sociais('mt-5') ?>
      </div>

      <div>
        <h3 class="text-sm font-semibold text-foreground">Institucional</h3>
        <ul class="mt-4 flex flex-col gap-3">
          <?php foreach (RODAPE_INSTITUCIONAL as $link): ?>
            <li><a href="<?= e(url($link['link'])) ?>" class="text-sm text-foreground/70 transition-colors hover:text-foreground"><?= e($link['titulo']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <h3 class="text-sm font-semibold text-foreground">Soluções</h3>
        <ul class="mt-4 flex flex-col gap-3">
          <?php foreach (RODAPE_SOLUCOES as $link): ?>
            <li><a href="<?= e(url($link['link'])) ?>" class="text-sm text-foreground/70 transition-colors hover:text-foreground"><?= e($link['titulo']) ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <h3 class="text-sm font-semibold text-foreground">Contato</h3>
        <ul class="mt-4 flex flex-col gap-3 text-sm text-foreground/70">
          <li class="flex items-start gap-2.5">
            <?= icone('mapa', 'mt-0.5 size-4 shrink-0 text-brand-fg') ?>
            <span>
              <?= e(CONTATO['endereco']['rua']) ?> – <?= e(CONTATO['endereco']['bairro']) ?><br>
              <?= e(CONTATO['endereco']['cep']) ?> – <?= e(CONTATO['endereco']['cidade']) ?>/<?= e(CONTATO['endereco']['estado']) ?>
            </span>
          </li>
          <li class="flex items-center gap-2.5">
            <?= icone('telefone', 'size-4 shrink-0 text-brand-fg') ?>
            <a href="tel:<?= e(CONTATO['telefone']) ?>" class="hover:text-foreground"><?= e(CONTATO['telefone_exibicao']) ?></a>
          </li>
          <li class="flex items-center gap-2.5">
            <?= icone('email', 'size-4 shrink-0 text-brand-fg') ?>
            <a href="mailto:<?= e(CONTATO['email']) ?>" class="hover:text-foreground"><?= e(CONTATO['email']) ?></a>
          </li>
        </ul>
      </div>
    </div>

    <p class="mt-12 border-t border-border-subtle pt-6 text-xs text-foreground/60">
      © <?= date('Y') ?> World System – Soluções em TI. Todos os direitos reservados.
    </p>
  </div>
</footer>

<script src="<?= url('assets/js/site.js') ?>" defer></script>
</body>
</html>
