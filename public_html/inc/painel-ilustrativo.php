<?php
// Painel de gestão desenhado em HTML que aparece ao lado do texto do hero.
// É apenas ilustrativo: os números e status são fixos.
?>
<div aria-hidden="true" class="relative mx-auto w-full max-w-md select-none">
  <div class="rounded-2xl border border-border-subtle bg-surface p-5 shadow-elevated">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2">
        <span class="size-2.5 rounded-full bg-red-400"></span>
        <span class="size-2.5 rounded-full bg-amber-400"></span>
        <span class="size-2.5 rounded-full bg-accent-400"></span>
      </div>
      <span class="text-xs font-medium text-foreground/40">Painel de gestão</span>
    </div>

    <div class="mt-5 grid grid-cols-2 gap-3">
      <div class="rounded-xl bg-surface-muted p-4">
        <div class="flex items-center justify-between">
          <span class="text-xs font-medium text-foreground/50">Faturamento</span>
          <?= icone('alta', 'size-3.5 text-accent-500') ?>
        </div>
        <div class="mt-2 flex h-12 items-end gap-1">
          <?php foreach ([40, 65, 45, 80, 60, 95] as $altura): ?>
            <span class="flex-1 rounded-sm bg-brand-500/70" style="height: <?= $altura ?>%"></span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="flex flex-col gap-3">
        <div class="flex items-center gap-2.5 rounded-xl bg-surface-muted p-3">
          <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-brand-600 text-white"><?= icone('documento', 'size-4') ?></span>
          <div>
            <p class="text-[11px] font-medium text-foreground/50">NFe emitida</p>
            <p class="text-xs font-semibold text-foreground">Autorizada</p>
          </div>
        </div>
        <div class="flex items-center gap-2.5 rounded-xl bg-surface-muted p-3">
          <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-accent-500 text-white"><?= icone('caixa', 'size-4') ?></span>
          <div>
            <p class="text-[11px] font-medium text-foreground/50">Estoque</p>
            <p class="text-xs font-semibold text-foreground">Sincronizado</p>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-3 flex items-center justify-between rounded-xl bg-surface-muted p-3">
      <div class="flex items-center gap-2.5">
        <span class="flex size-8 shrink-0 items-center justify-center rounded-lg bg-brand-50 text-brand-600"><?= icone('grafico', 'size-4') ?></span>
        <p class="text-xs font-medium text-foreground/70">Análise ABC de produtos</p>
      </div>
      <span class="rounded-full bg-accent-50 px-2.5 py-1 text-[11px] font-semibold text-accent-700">Tempo real</span>
    </div>
  </div>

  <div class="flutua absolute -bottom-11 -left-8 hidden w-40 rounded-xl border border-border-subtle bg-surface p-3 shadow-card sm:block">
    <p class="text-[11px] font-medium text-foreground/50">Filiais monitoradas</p>
    <p class="mt-1 text-lg font-bold text-brand-fg">Multiempresa</p>
  </div>
</div>
