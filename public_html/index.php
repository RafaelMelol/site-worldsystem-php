<?php
// Página inicial: hero, soluções, sobre a empresa, recursos, integrações e
// faixa de contato.

require_once __DIR__ . '/inc/config.php';

$titulo = null;
$descricao = SITE['descricao'];

// Dados que os buscadores leem para entender quem é a empresa.
$dados_estruturados = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => SITE['nome'],
    'url' => SITE['url'],
    'description' => SITE['descricao'],
    'telephone' => CONTATO['telefone'],
    'email' => CONTATO['email'],
    'foundingDate' => (string) EMPRESA['ano_fundacao'],
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => CONTATO['endereco']['rua'],
        'addressLocality' => CONTATO['endereco']['cidade'],
        'addressRegion' => CONTATO['endereco']['estado'],
        'postalCode' => CONTATO['endereco']['cep'],
        'addressCountry' => 'BR',
    ],
    'sameAs' => array_values(CONTATO['redes']),
];

require __DIR__ . '/inc/layout-topo.php';
?>

<section class="relative isolate -mt-18 flex min-h-dvh flex-col overflow-hidden border-b border-border-subtle bg-surface">
  <div aria-hidden="true" class="hero-grid pointer-events-none -z-30"></div>
  <div aria-hidden="true" class="hero-ambient hero-ambient-blue pointer-events-none -z-20"></div>
  <div aria-hidden="true" class="hero-ambient hero-ambient-green pointer-events-none -z-20"></div>

  <div class="saida-scroll flex flex-1 flex-col">
    <div class="mx-auto grid w-full max-w-7xl flex-1 grid-cols-1 content-center items-center gap-12 px-6 pt-28 pb-16 lg:grid-cols-2 lg:px-8 lg:py-20">
      <div>
        <?= revelar_abre() ?>
          <span class="inline-flex items-center rounded-full border border-border-subtle bg-surface-muted px-4 py-1.5 text-xs font-semibold uppercase tracking-wide text-brand-fg">
            Desde <?= EMPRESA['ano_fundacao'] ?>
          </span>
        <?= revelar_fecha() ?>
        <?= revelar_abre(80) ?>
          <h1 class="mt-6 text-4xl font-bold tracking-tight text-foreground sm:text-5xl lg:text-[3.25rem] lg:leading-[1.1]">
            Tecnologia que organiza, automatiza e impulsiona a gestão do seu negócio
          </h1>
        <?= revelar_fecha() ?>
        <?= revelar_abre(160) ?>
          <p class="mt-6 max-w-xl text-lg leading-relaxed text-foreground/70">
            A World System oferece soluções completas em gestão e emissão fiscal para pequenas
            indústrias, atacados e varejos, unindo tecnologia, experiência de mercado e atendimento
            personalizado para tornar a gestão mais eficiente, segura e inteligente.
          </p>
        <?= revelar_fecha() ?>
        <?= revelar_abre(240) ?>
          <div class="mt-9 flex flex-col gap-3 sm:flex-row">
            <a href="<?= url('solucoes.php') ?>" class="<?= classes_botao('primario', 'lg', 'group/link') ?>">
              Conheça nossas soluções
              <?= icone('seta-direita', 'size-4 transition-transform duration-200 group-hover/link:translate-x-1') ?>
            </a>
            <a href="<?= url('contato.php') ?>" class="<?= classes_botao('contorno', 'lg') ?>">Fale com a World System</a>
          </div>
        <?= revelar_fecha() ?>
      </div>

      <div class="paralaxe animate-fade-in" data-alcance="22">
        <?php require __DIR__ . '/inc/painel-ilustrativo.php'; ?>
      </div>
    </div>
  </div>

  <div class="hidden justify-center pb-8 sm:flex">
    <button type="button" id="rolar-secao" aria-label="Rolar para conhecer as soluções"
      class="group inline-flex size-11 items-center justify-center rounded-full border border-border-subtle bg-surface text-foreground/60 shadow-soft transition-colors hover:border-brand-fg hover:text-brand-fg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 focus-visible:ring-offset-background">
      <?= icone('seta-baixo', 'size-5 animate-bounce transition-transform group-hover:translate-y-0.5') ?>
    </button>
  </div>
</section>

<section class="py-20 lg:py-28">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Soluções', 'Soluções inteligentes para cada etapa da sua operação', 'Da retaguarda ao ponto de venda, da emissão fiscal ao transporte — tecnologia integrada para conectar e simplificar toda a sua operação comercial.') ?>
    <?= revelar_fecha() ?>
    <?= lista_solucoes('mt-12') ?>
  </div>
</section>

<section class="bg-surface-muted py-20 lg:py-28">
  <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-12 px-6 lg:grid-cols-[1fr_1.2fr] lg:items-center lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Sobre a World System', 'Mais de três décadas de experiência transformando tecnologia em soluções para o seu negócio', EMPRESA['apresentacao']) ?>

      <div class="mt-8 flex items-center gap-8">
        <div>
          <span class="contador text-4xl font-bold tabular-nums text-brand-fg" data-valor="<?= anos_de_mercado() ?>" data-sufixo="+" data-duracao="3500">0+</span>
          <p class="mt-1 text-xs font-medium uppercase tracking-wide text-foreground/50">Anos de mercado</p>
        </div>
        <div class="h-10 w-px bg-border-subtle" aria-hidden="true"></div>
        <div>
          <span class="contador text-4xl font-bold tabular-nums text-brand-fg" data-valor="<?= count(SEGMENTOS_ATENDIDOS) ?>" data-duracao="1400">0</span>
          <p class="mt-1 text-xs font-medium uppercase tracking-wide text-foreground/50">Segmentos atendidos</p>
        </div>
      </div>

      <a href="<?= url('empresa.php') ?>" class="group/link mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-fg transition-colors hover:text-brand-fg-hover">
        Conheça a nossa história
        <?= icone('seta-direita', 'size-3.5 transition-transform duration-200 group-hover/link:translate-x-1') ?>
      </a>
    <?= revelar_fecha() ?>

    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
      <?php foreach (EMPRESA_PILARES as $indice => $pilar): ?>
        <?= revelar_abre($indice * 60) ?>
          <div class="rounded-xl border border-border-subtle bg-surface p-5 transition-colors duration-300 ease-out hover:border-brand-200">
            <h3 class="text-sm font-semibold text-foreground"><?= e($pilar['titulo']) ?></h3>
            <p class="mt-2 text-sm leading-relaxed text-foreground/70"><?= e($pilar['descricao']) ?></p>
          </div>
        <?= revelar_fecha() ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-20 lg:py-28">
  <div class="mx-auto grid w-full max-w-7xl grid-cols-1 gap-12 px-6 lg:grid-cols-[1fr_1.3fr] lg:items-start lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Recursos', 'Gestão completa, do estoque à conformidade fiscal', 'Tecnologia, segurança, inteligência de dados e integração operacional reunidas em uma única plataforma.') ?>
      <a href="<?= url('recursos.php') ?>" class="group mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-brand-fg transition-colors hover:text-brand-fg-hover">
        Ver todos os recursos
        <?= icone('seta-direita', 'size-3.5 transition-transform duration-200 group-hover:translate-x-1') ?>
      </a>
    <?= revelar_fecha() ?>
    <?= revelar_abre(80) ?>
      <?= abas_recursos(array_slice(RECURSOS, 0, 4)) ?>
    <?= revelar_fecha() ?>
  </div>
</section>

<section class="border-t border-border-subtle py-20 lg:py-28">
  <div class="mx-auto w-full max-w-7xl px-6 lg:px-8">
    <?= revelar_abre() ?>
      <?= titulo_secao('Integrações', 'Conectado às ferramentas que sua empresa já utiliza', 'Integrações com órgãos fiscais, marketplaces e equipamentos usados no dia a dia comercial.') ?>
    <?= revelar_fecha() ?>
    <div class="mt-12"><?= grade_integracoes() ?></div>
  </div>
</section>

<?= banner_cta('Pronto para modernizar a gestão da sua empresa?', 'Fale com a equipe da World System e descubra qual solução se encaixa na sua operação.') ?>

<?php require __DIR__ . '/inc/layout-rodape.php'; ?>
