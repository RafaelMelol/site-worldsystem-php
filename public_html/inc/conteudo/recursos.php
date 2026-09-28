<?php
// Recursos dos sistemas, agrupados por categoria. Cada categoria vira uma aba.
// A home mostra as 4 primeiras; a página /recursos.php mostra todas.

const RECURSOS = [
    [
        'titulo' => 'Plataforma e tecnologia',
        'descricao' => 'Softwares inovadores, com interface 100% visual, inteligentes e adaptáveis à operação de cada empresa.',
        'itens' => [
            'Interface 100% visual',
            'Sistemas inteligentes e adaptáveis',
            'Multiplataforma',
            'Multiempresa',
            'Disponível na Web, com hospedagem em nuvem',
        ],
    ],
    [
        'titulo' => 'Relatórios e inteligência de dados',
        'descricao' => 'Informação organizada para apoiar decisões de compra, precificação e giro de estoque.',
        'itens' => [
            'Relatórios e gráficos exportáveis em PDF, DOC, XLS, TXT e HTML',
            'Análise ABC por volume, consumo, lucratividade, frequência e popularidade',
        ],
    ],
    [
        'titulo' => 'Segurança e governança',
        'descricao' => 'Controle de quem acessa o sistema e o que é feito em cada operação, com visibilidade sobre todas as unidades.',
        'itens' => [
            'Logs de todas as ações dos usuários',
            'Segurança de dados e políticas de acesso por usuário',
            'Monitoramento em tempo real de todas as filiais',
        ],
    ],
    [
        'titulo' => 'Fiscal e conformidade',
        'descricao' => 'Emissão de documentos fiscais integrada à operação, com backup e conformidade com a legislação.',
        'itens' => [
            'Emissão rápida de NFe, NFCe, CCe, CTe, MDFe e CTeOS',
            'Sintegra, SPED Fiscal e Contribuições',
            'Backup automático de XMLs',
        ],
    ],
    [
        'titulo' => 'Operação comercial',
        'descricao' => 'Do orçamento à venda concluída, com cadastro automático e precificação flexível.',
        'itens' => [
            'Geração de DAV, orçamento e pré-venda',
            'Importação de XML do fornecedor com cadastro automático de produtos e fornecedores',
            'Cadastro de produtos, clientes e usuários com foto',
            'Cálculo de preço de venda por markup, margem bruta ou lucro',
            'Montagem e fragmentação de produtos',
            'Controle de entrega',
        ],
    ],
    [
        'titulo' => 'Equipamentos e aplicativos',
        'descricao' => 'Integração com os equipamentos da operação e com canais de venda utilizados pelos clientes.',
        'itens' => [
            'Integração com balanças',
            'Integração com leitores de código de barras',
            'Integração com impressoras de etiquetas',
            'Integração com o app PedidoOk',
            'Integração com Mercado Livre',
            'Integração com Shopee',
        ],
    ],
];
