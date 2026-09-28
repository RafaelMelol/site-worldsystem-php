<?php
// Botão que alterna entre tema claro e escuro. Aparece duas vezes no
// cabeçalho (desktop e mobile), por isso fica em arquivo separado.
?>
<button type="button" data-tema aria-label="Alternar tema"
  class="inline-flex size-10 shrink-0 items-center justify-center rounded-full border border-border-subtle text-foreground/70 transition-colors hover:border-brand-400 hover:text-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 focus-visible:ring-offset-background">
  <span data-icone-sol hidden><?= icone('sol', 'size-[18px]') ?></span>
  <span data-icone-lua><?= icone('lua', 'size-[18px]') ?></span>
</button>
