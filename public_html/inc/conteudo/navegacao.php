<?php
// Links do menu do topo e das colunas do rodapé.

const MENU = [
    ['titulo' => 'Empresa', 'link' => '/empresa.php'],
    [
        'titulo' => 'Soluções',
        'link' => '/solucoes.php',
        'filhos' => [
            ['titulo' => 'SCA 5.0 Pro – Varejo', 'link' => '/solucao.php?s=varejo'],
            ['titulo' => 'SCA 5.0 Pro – Atacado', 'link' => '/solucao.php?s=atacado'],
            ['titulo' => 'Emissor NFe e NFCe', 'link' => '/solucao.php?s=nfe-nfce'],
            ['titulo' => 'Emissor CTe, CTe OS e MDFe', 'link' => '/solucao.php?s=cte-mdfe'],
        ],
    ],
    ['titulo' => 'Recursos', 'link' => '/recursos.php'],
    ['titulo' => 'Integrações', 'link' => '/integracoes.php'],
    [
        'titulo' => 'Suporte',
        'link' => '/suporte.php',
        'filhos' => [
            ['titulo' => 'Horário de atendimento', 'link' => '/suporte.php#horario'],
            ['titulo' => 'FAQ', 'link' => '/faq.php'],
        ],
    ],
    ['titulo' => 'Oportunidades', 'link' => '/oportunidades.php'],
];

const RODAPE_INSTITUCIONAL = [
    ['titulo' => 'Home', 'link' => '/'],
    ['titulo' => 'Empresa', 'link' => '/empresa.php'],
    ['titulo' => 'Oportunidades', 'link' => '/oportunidades.php'],
    ['titulo' => 'Contato', 'link' => '/contato.php'],
];

const RODAPE_SOLUCOES = [
    ['titulo' => 'SCA 5.0 Pro – Varejo', 'link' => '/solucao.php?s=varejo'],
    ['titulo' => 'SCA 5.0 Pro – Atacado', 'link' => '/solucao.php?s=atacado'],
    ['titulo' => 'Emissor NFe e NFCe', 'link' => '/solucao.php?s=nfe-nfce'],
    ['titulo' => 'Emissor CTe, CTe OS e MDFe', 'link' => '/solucao.php?s=cte-mdfe'],
];
