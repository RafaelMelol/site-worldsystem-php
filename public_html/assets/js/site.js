// Comportamentos do site: tema, menus, abas, acordeão, animações e formulários.
(function () {
  'use strict';

  var movimentoReduzido = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Tema claro e escuro ---------------------------------------------------- */

  function temaAtual() {
    try {
      var salvo = localStorage.getItem('theme');
      if (salvo === 'light' || salvo === 'dark') return salvo;
    } catch (e) {}
    return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
  }

  function mostrarIconeDoTema() {
    var escuro = temaAtual() === 'dark';
    document.querySelectorAll('[data-tema]').forEach(function (botao) {
      botao.querySelector('[data-icone-sol]').hidden = !escuro;
      botao.querySelector('[data-icone-lua]').hidden = escuro;
      botao.setAttribute('aria-label', escuro ? 'Ativar modo claro' : 'Ativar modo escuro');
    });
  }

  document.querySelectorAll('[data-tema]').forEach(function (botao) {
    botao.addEventListener('click', function () {
      var novo = temaAtual() === 'dark' ? 'light' : 'dark';
      document.documentElement.setAttribute('data-theme', novo);
      try {
        localStorage.setItem('theme', novo);
      } catch (e) {}
      mostrarIconeDoTema();
    });
  });

  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', mostrarIconeDoTema);
  mostrarIconeDoTema();

  /* Cabeçalho: ganha fundo ao sair do topo --------------------------------- */

  var cabecalho = document.getElementById('cabecalho');
  var comFundo = 'border-border-subtle bg-surface/85 shadow-soft backdrop-blur-md'.split(' ');
  var semFundo = 'border-clear bg-transparent'.split(' ');

  function ajustarCabecalho() {
    if (!cabecalho) return;
    var rolou = window.scrollY > 8;
    comFundo.forEach(function (classe) {
      cabecalho.classList.toggle(classe, rolou);
    });
    semFundo.forEach(function (classe) {
      cabecalho.classList.toggle(classe, !rolou);
    });
  }

  /* Barra de progresso da leitura ------------------------------------------ */

  var barra = document.getElementById('barra-progresso');

  function ajustarBarra() {
    if (!barra) return;
    var total = document.documentElement.scrollHeight - window.innerHeight;
    var progresso = total > 0 ? window.scrollY / total : 0;
    barra.style.transform = 'scaleX(' + progresso + ')';
  }

  /* Hero: some ao rolar e o painel faz paralaxe ---------------------------- */

  var saida = document.querySelector('.saida-scroll');
  var paralaxe = document.querySelector('.paralaxe');

  function ajustarHero() {
    if (movimentoReduzido) return;

    if (saida) {
      var altura = saida.offsetHeight || 1;
      var andamento = Math.min(Math.max(window.scrollY / altura, 0), 1);
      saida.style.transform = 'translateY(' + -40 * andamento + 'px) scale(' + (1 - 0.03 * andamento) + ')';
      saida.style.opacity = String(1 - 0.65 * andamento);
    }

    if (paralaxe) {
      var caixa = paralaxe.getBoundingClientRect();
      var alcance = Number(paralaxe.dataset.alcance || 22);
      var centro = (window.innerHeight - caixa.top - caixa.height / 2) / window.innerHeight;
      paralaxe.style.transform = 'translateY(' + -centro * alcance + 'px)';
    }
  }

  var aguardando = false;
  window.addEventListener(
    'scroll',
    function () {
      if (aguardando) return;
      aguardando = true;
      requestAnimationFrame(function () {
        ajustarCabecalho();
        ajustarBarra();
        ajustarHero();
        aguardando = false;
      });
    },
    { passive: true }
  );

  ajustarCabecalho();
  ajustarBarra();
  ajustarHero();

  /* Menu no celular -------------------------------------------------------- */

  var botaoMenu = document.getElementById('botao-menu');
  var menuMobile = document.getElementById('menu-mobile');

  if (botaoMenu && menuMobile) {
    botaoMenu.addEventListener('click', function () {
      var aberto = !menuMobile.hidden;
      menuMobile.hidden = aberto;
      botaoMenu.setAttribute('aria-expanded', String(!aberto));
      botaoMenu.setAttribute('aria-label', aberto ? 'Abrir menu' : 'Fechar menu');
      botaoMenu.querySelector('[data-icone-menu]').hidden = !aberto;
      botaoMenu.querySelector('[data-icone-fechar]').hidden = aberto;
      document.body.style.overflow = aberto ? '' : 'hidden';
    });
  }

  document.querySelectorAll('[data-submenu-mobile]').forEach(function (botao) {
    botao.addEventListener('click', function () {
      var painel = document.querySelector('[data-painel-mobile="' + botao.dataset.submenuMobile + '"]');
      if (!painel) return;
      var aberto = !painel.hidden;
      painel.hidden = aberto;
      botao.setAttribute('aria-expanded', String(!aberto));
      botao.querySelector('svg').classList.toggle('rotate-180', !aberto);
    });
  });

  /* Submenus do menu no computador ----------------------------------------- */

  function fecharSubmenus() {
    document.querySelectorAll('[data-painel-submenu]').forEach(function (painel) {
      painel.hidden = true;
    });
    document.querySelectorAll('[data-submenu]').forEach(function (botao) {
      botao.setAttribute('aria-expanded', 'false');
      botao.querySelector('svg').classList.remove('rotate-180');
    });
  }

  document.querySelectorAll('[data-submenu]').forEach(function (botao) {
    botao.addEventListener('click', function (evento) {
      evento.stopPropagation();
      var painel = document.querySelector('[data-painel-submenu="' + botao.dataset.submenu + '"]');
      if (!painel) return;
      var aberto = !painel.hidden;
      fecharSubmenus();
      if (!aberto) {
        painel.hidden = false;
        botao.setAttribute('aria-expanded', 'true');
        botao.querySelector('svg').classList.add('rotate-180');
      }
    });
  });

  document.addEventListener('click', function (evento) {
    if (cabecalho && !cabecalho.contains(evento.target)) fecharSubmenus();
  });

  document.addEventListener('keydown', function (evento) {
    if (evento.key !== 'Escape') return;
    fecharSubmenus();
    if (menuMobile && !menuMobile.hidden && botaoMenu) botaoMenu.click();
  });

  /* Abas de recursos ------------------------------------------------------- */

  document.querySelectorAll('.abas').forEach(function (bloco) {
    var abas = bloco.querySelectorAll('.aba');
    var paineis = bloco.querySelectorAll('.painel');

    abas.forEach(function (aba) {
      aba.addEventListener('click', function () {
        abas.forEach(function (outra) {
          var ativa = outra === aba;
          outra.setAttribute('aria-selected', String(ativa));
          outra.classList.toggle('bg-brand-600', ativa);
          outra.classList.toggle('text-white', ativa);
          outra.classList.toggle('shadow-soft', ativa);
          outra.classList.toggle('text-foreground/60', !ativa);
          outra.classList.toggle('hover:bg-surface', !ativa);
          outra.classList.toggle('hover:text-foreground', !ativa);
        });

        paineis.forEach(function (painel) {
          var mostrar = painel.dataset.painel === aba.dataset.aba;
          painel.hidden = false;
          painel.classList.toggle('hidden', !mostrar);
          if (mostrar && !movimentoReduzido) {
            painel.classList.remove('animate-fade-in');
            void painel.offsetWidth;
            painel.classList.add('animate-fade-in');
          }
        });
      });
    });
  });

  /* Acordeão do FAQ -------------------------------------------------------- */

  document.querySelectorAll('.acordeao').forEach(function (botao) {
    botao.addEventListener('click', function () {
      var painel = document.getElementById(botao.getAttribute('aria-controls'));
      if (!painel) return;
      var aberto = !painel.hidden;
      painel.hidden = aberto;
      botao.setAttribute('aria-expanded', String(!aberto));
      botao.querySelector('svg').classList.toggle('rotate-180', !aberto);
    });
  });

  /* Conteúdo que surge ao entrar na tela ----------------------------------- */

  var blocos = document.querySelectorAll('.revelar');

  if (movimentoReduzido || !('IntersectionObserver' in window)) {
    blocos.forEach(function (bloco) {
      bloco.classList.add('visivel');
    });
  } else {
    var observador = new IntersectionObserver(
      function (entradas) {
        entradas.forEach(function (entrada) {
          if (!entrada.isIntersecting) return;
          var atraso = Number(entrada.target.dataset.atraso || 0);
          setTimeout(function () {
            entrada.target.classList.add('visivel');
          }, atraso);
          observador.unobserve(entrada.target);
        });
      },
      { rootMargin: '0px 0px -80px 0px', threshold: 0.15 }
    );

    blocos.forEach(function (bloco) {
      observador.observe(bloco);
    });
  }

  /* Contadores ------------------------------------------------------------- */

  function contar(elemento) {
    var valor = Number(elemento.dataset.valor || 0);
    var sufixo = elemento.dataset.sufixo || '';
    var duracao = Number(elemento.dataset.duracao || 1400);

    if (movimentoReduzido) {
      elemento.textContent = valor + sufixo;
      return;
    }

    var inicio = performance.now();

    function passo(agora) {
      var andamento = Math.min((agora - inicio) / duracao, 1);
      // Desacelera no fim, como no site anterior.
      var suave = 1 - Math.pow(1 - andamento, 3);
      elemento.textContent = Math.round(valor * suave) + sufixo;
      if (andamento < 1) requestAnimationFrame(passo);
    }

    requestAnimationFrame(passo);
  }

  var contadores = document.querySelectorAll('.contador');

  if (!('IntersectionObserver' in window)) {
    contadores.forEach(contar);
  } else {
    // A margem negativa vale só para baixo; nas laterais ela deixaria de
    // detectar o número que fica colado na borda esquerda no celular.
    var olhoContador = new IntersectionObserver(
      function (entradas) {
        entradas.forEach(function (entrada) {
          if (!entrada.isIntersecting) return;
          contar(entrada.target);
          olhoContador.unobserve(entrada.target);
        });
      },
      { rootMargin: '0px 0px -100px 0px' }
    );

    contadores.forEach(function (contador) {
      olhoContador.observe(contador);
    });
  }

  /* Botão que rola para a próxima seção ------------------------------------ */

  var botaoRolar = document.getElementById('rolar-secao');
  if (botaoRolar) {
    botaoRolar.addEventListener('click', function () {
      var secao = botaoRolar.closest('section');
      if (secao && secao.nextElementSibling) {
        secao.nextElementSibling.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  }

  /* Cursor redondo no computador ------------------------------------------- */

  var cursor = document.getElementById('cursor');
  var consultaCursor = window.matchMedia('(hover: hover) and (pointer: fine) and (min-width: 768px)');

  if (cursor) {
    var alvo = { x: 0, y: 0 };
    var atual = { x: 0, y: 0 };
    var mexeu = false;
    var quadro = 0;

    function seguir() {
      atual.x += (alvo.x - atual.x) * 0.6;
      atual.y += (alvo.y - atual.y) * 0.6;
      cursor.style.transform = 'translate(' + atual.x + 'px, ' + atual.y + 'px) translate(-50%, -50%)';
      quadro = requestAnimationFrame(seguir);
    }

    function aoMover(evento) {
      alvo.x = evento.clientX;
      alvo.y = evento.clientY;
      if (!mexeu) {
        mexeu = true;
        atual.x = alvo.x;
        atual.y = alvo.y;
        cursor.classList.add('is-visible');
      }
    }

    function ligarCursor() {
      document.documentElement.classList.add('custom-cursor-active');
      quadro = requestAnimationFrame(seguir);
      window.addEventListener('mousemove', aoMover);
    }

    function desligarCursor() {
      document.documentElement.classList.remove('custom-cursor-active');
      cancelAnimationFrame(quadro);
      mexeu = false;
      cursor.classList.remove('is-visible');
      window.removeEventListener('mousemove', aoMover);
    }

    if (consultaCursor.matches) ligarCursor();
    consultaCursor.addEventListener('change', function (evento) {
      evento.matches ? ligarCursor() : desligarCursor();
    });
  }

  /* Botão do WhatsApp ------------------------------------------------------ */

  var botaoWhatsapp = document.getElementById('botao-whatsapp');
  if (botaoWhatsapp) {
    botaoWhatsapp.addEventListener('click', function () {
      var numeros = (botaoWhatsapp.dataset.telefone || '').replace(/\D/g, '');
      var saudacao = new Date().getHours() < 12 ? 'Olá, bom dia!' : 'Olá, boa tarde!';
      window.open('https://wa.me/' + numeros + '?text=' + encodeURIComponent(saudacao), '_blank', 'noopener,noreferrer');
    });
  }

  /* Botões de copiar (página de marketplace) ------------------------------- */

  document.querySelectorAll('.copiar').forEach(function (botao) {
    botao.addEventListener('click', function () {
      var valor = botao.dataset.valor || '';

      function confirmar() {
        botao.querySelector('.icone-copiar').classList.add('hidden');
        botao.querySelector('.icone-copiado').classList.remove('hidden');
        botao.querySelector('.texto').textContent = 'Copiado';
        setTimeout(function () {
          botao.querySelector('.icone-copiar').classList.remove('hidden');
          botao.querySelector('.icone-copiado').classList.add('hidden');
          botao.querySelector('.texto').textContent = 'Copiar';
        }, 2000);
      }

      if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(valor).then(confirmar, copiarPeloCampo);
      } else {
        copiarPeloCampo();
      }

      // Alguns navegadores bloqueiam a forma moderna (por exemplo, sem HTTPS).
      function copiarPeloCampo() {
        var campo = document.createElement('textarea');
        campo.value = valor;
        campo.style.position = 'fixed';
        campo.style.opacity = '0';
        document.body.appendChild(campo);
        campo.select();
        try {
          document.execCommand('copy');
        } catch (e) {}
        campo.remove();
        confirmar();
      }
    });
  });

  /* Formulários ------------------------------------------------------------ */

  var ICONE_OK = '<svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>';
  var ICONE_ERRO = '<svg class="size-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>';
  var ICONE_ENVIANDO = '<svg class="size-4 shrink-0 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>';

  function mostrarSituacao(formulario, tipo, mensagem) {
    var caixa = formulario.querySelector('.situacao');
    if (!caixa) return;

    var estilos = {
      enviando: ['bg-surface-muted', 'text-foreground/70'],
      sucesso: ['bg-accent-50', 'font-medium', 'text-accent-700'],
      erro: ['bg-red-50', 'font-medium', 'text-red-700'],
    };

    caixa.className = 'situacao flex items-center gap-2 rounded-lg px-4 py-3 text-sm ' + estilos[tipo].join(' ');
    caixa.setAttribute('role', tipo === 'erro' ? 'alert' : 'status');
    caixa.innerHTML = (tipo === 'enviando' ? ICONE_ENVIANDO : tipo === 'sucesso' ? ICONE_OK : ICONE_ERRO) + '<span>' + mensagem + '</span>';
  }

  function limparErros(formulario) {
    formulario.querySelectorAll('.erro').forEach(function (aviso) {
      aviso.textContent = '';
      aviso.classList.add('hidden');
    });
    formulario.querySelectorAll('[aria-invalid]').forEach(function (campo) {
      campo.removeAttribute('aria-invalid');
    });
  }

  function mostrarErros(formulario, erros) {
    Object.keys(erros || {}).forEach(function (campo) {
      var aviso = formulario.querySelector('[data-erro="' + campo + '"]');
      if (aviso) {
        aviso.textContent = erros[campo];
        aviso.classList.remove('hidden');
      }
      var entrada = formulario.querySelector('[name="' + campo + '"]');
      if (entrada) entrada.setAttribute('aria-invalid', 'true');
    });
  }

  function enviarFormulario(formulario, destino, mensagemSucesso, mensagemErro) {
    formulario.addEventListener('submit', function (evento) {
      evento.preventDefault();
      limparErros(formulario);

      var dados = new FormData(formulario);
      var arquivo = dados.get('curriculo');
      if (arquivo && arquivo.size > 4 * 1024 * 1024) {
        mostrarSituacao(formulario, 'erro', 'O arquivo deve ter no máximo 4 MB.');
        return;
      }

      var botao = formulario.querySelector('button[type="submit"]');
      if (botao) botao.disabled = true;
      mostrarSituacao(formulario, 'enviando', 'Enviando...');

      fetch(destino, { method: 'POST', body: dados })
        .then(function (resposta) {
          return resposta.json().then(function (dados) {
            return { ok: resposta.ok, dados: dados };
          });
        })
        .then(function (resultado) {
          if (!resultado.ok) {
            mostrarErros(formulario, resultado.dados.erros);
            mostrarSituacao(formulario, 'erro', resultado.dados.mensagem || mensagemErro);
            return;
          }
          formulario.reset();
          var nomeArquivo = document.getElementById('nome-arquivo');
          if (nomeArquivo) nomeArquivo.textContent = 'Clique para selecionar o arquivo';
          mostrarSituacao(formulario, 'sucesso', mensagemSucesso);
        })
        .catch(function () {
          mostrarSituacao(formulario, 'erro', mensagemErro);
        })
        .finally(function () {
          if (botao) botao.disabled = false;
        });
    });
  }

  var formContato = document.getElementById('form-contato');
  if (formContato) {
    enviarFormulario(
      formContato,
      '/envio/contato.php',
      'Mensagem enviada com sucesso. Retornaremos em breve.',
      'Não foi possível enviar sua mensagem. Tente novamente.'
    );
  }

  var formCurriculo = document.getElementById('form-curriculo');
  if (formCurriculo) {
    enviarFormulario(
      formCurriculo,
      '/envio/curriculo.php',
      'Currículo recebido com sucesso. Obrigado pelo interesse!',
      'Não foi possível enviar seu currículo. Tente novamente.'
    );

    var campoArquivo = document.getElementById('curriculo-arquivo');
    var nomeArquivo = document.getElementById('nome-arquivo');
    if (campoArquivo && nomeArquivo) {
      campoArquivo.addEventListener('change', function () {
        nomeArquivo.textContent = campoArquivo.files && campoArquivo.files[0]
          ? campoArquivo.files[0].name
          : 'Clique para selecionar o arquivo';
      });
    }
  }
})();
