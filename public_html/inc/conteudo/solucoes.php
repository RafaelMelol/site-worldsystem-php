<?php
// Soluções (produtos). Cada item gera um cartão nas listagens e a página
// /solucao.php?s={slug}. Para criar uma solução nova, acrescente um item aqui.

const SOLUCOES = [
    [
        'slug' => 'varejo',
        'categoria' => 'Varejo',
        'nome' => 'SCA 5.0 Pro – Varejo',
        'chamada' => 'Sistema de retaguarda completo para lojas varejistas',
        'descricao' => 'Solução de gestão para lojas varejistas de diversos segmentos, unindo controle de estoque, financeiro e emissão fiscal em um único sistema de retaguarda.',
        'segmentos' => [
            'Autopeças',
            'Boutiques',
            'Móveis',
            'Materiais de construção',
            'Calçados',
            'Cosméticos',
            'Presentes',
            'Outros segmentos varejistas',
        ],
        'grupos' => [
            [
                'titulo' => 'Estoque e produtos',
                'itens' => [
                    'Controle de estoque',
                    'Cadastro de produtos com foto',
                    'Controle de insumos e produção',
                    'Montagem e fragmentação de produtos',
                    'Inventário de estoque',
                    'Cálculo automático do preço de venda',
                ],
            ],
            [
                'titulo' => 'Financeiro',
                'itens' => [
                    'Contas a pagar e a receber',
                    'Controle de caixa diário, mensal e anual',
                    'Limite de crédito por cliente',
                    'Boletos de cobrança',
                    'Conciliação bancária',
                ],
            ],
            [
                'titulo' => 'Fiscal',
                'itens' => [
                    'Emissão de nota fiscal eletrônica',
                    'Importação de XML com cadastro automático',
                    'Envio de DANFE por e-mail ao destinatário',
                    'Geração de arquivos Sintegra, SPED Fiscal e Contribuições',
                ],
            ],
            [
                'titulo' => 'Gestão e clientes',
                'itens' => [
                    'Gestão de funcionários',
                    'Controle de acesso por usuário com senha',
                    'Histórico de vendas por cliente',
                    'Mala direta',
                ],
            ],
        ],
    ],
    [
        'slug' => 'atacado',
        'categoria' => 'Atacado',
        'nome' => 'SCA 5.0 Pro – Atacado',
        'chamada' => 'Solução comercial para pequenos e médios atacadistas',
        'descricao' => 'Sistema de retaguarda voltado a pequenos atacadistas, com controle de produção, custos, conformidade fiscal e gestão financeira de ponta a ponta.',
        'segmentos' => [
            'Peças de bicicleta e moto',
            'Revenda de enxovais',
            'Matéria-prima em geral',
        ],
        'grupos' => [
            [
                'titulo' => 'Estoque e produção',
                'itens' => [
                    'Controle de estoque',
                    'Controle de insumos e produção',
                    'Inventário de estoque',
                    'Formação de custo e montagem de produtos',
                    'Cálculo automático do preço de venda',
                ],
            ],
            [
                'titulo' => 'Financeiro',
                'itens' => [
                    'Contas a pagar e a receber',
                    'Controle de limite de crédito e cobrança',
                    'Controle de caixa e banco diário, mensal e anual',
                ],
            ],
            [
                'titulo' => 'Fiscal e expedição',
                'itens' => [
                    'Geração de arquivos Sintegra, SPED Fiscal e Contribuições',
                    'Etiquetagem e documentos de expedição',
                ],
            ],
            [
                'titulo' => 'Gestão',
                'itens' => [
                    'Gestão de funcionários e transportadoras',
                    'Controle de acesso por usuário com senha',
                    'Mala direta a clientes e fornecedores',
                ],
            ],
        ],
    ],
    [
        'slug' => 'nfe-nfce',
        'categoria' => 'Fiscal',
        'nome' => 'Emissor NFe e NFCe',
        'chamada' => 'Emissão fiscal rápida e sem erros tributários',
        'descricao' => 'Solução fiscal para diversos segmentos varejistas, com PDV integrado para emitir Nota Fiscal Eletrônica e Nota Fiscal de Consumidor Eletrônica com agilidade e conformidade com a legislação vigente.',
        'segmentos' => null,
        'grupos' => [
            [
                'titulo' => 'Ponto de venda',
                'itens' => [
                    'TEF (Transferência Eletrônica de Fundos)',
                    'Consulta de preço',
                    'Venda rápida',
                    'Controle de vendas em cartão débito e crédito',
                    'Integração com Ordem de Serviço',
                ],
            ],
            [
                'titulo' => 'Hardware e documentos',
                'itens' => [
                    'Integração com impressora e balança',
                    'Leitura por código de barras ou teclado',
                    'Leitura e impressão de documentos fiscais',
                ],
            ],
            [
                'titulo' => 'Operação e fiscal',
                'itens' => [
                    'Fechamento de caixa',
                    'Emissão de DAV (orçamento e pré-venda)',
                    'Conformidade com a legislação vigente',
                ],
            ],
        ],
    ],
    [
        'slug' => 'cte-mdfe',
        'categoria' => 'Transporte',
        'nome' => 'Emissor CTe, CTe OS e MDFe',
        'chamada' => 'Documentos fiscais para o transporte de mercadorias',
        'descricao' => 'Emissão de documentos fiscais para acobertar o transporte de mercadorias e pessoas, com geração rápida e conformidade tributária.',
        'segmentos' => null,
        'grupos' => [
            [
                'titulo' => 'Cadastros',
                'itens' => [
                    'Cadastro de veículos próprios e de terceiros',
                    'Cadastro de motoristas e RNTC',
                ],
            ],
            [
                'titulo' => 'Emissão e operação',
                'itens' => [
                    'Emissão rápida de CTe, CTe OS e MDFe',
                    'Importação de XMLs',
                    'Integração com impressoras',
                    'Leitura e impressão de documentos fiscais',
                    'Controle de fechamento de caixa',
                ],
            ],
            [
                'titulo' => 'Conformidade',
                'itens' => ['Conformidade com a legislação vigente'],
            ],
        ],
    ],
];

/** Busca uma solução pelo slug da URL. Devolve null se não existir. */
function solucao_por_slug(string $slug): ?array
{
    foreach (SOLUCOES as $solucao) {
        if ($solucao['slug'] === $slug) {
            return $solucao;
        }
    }

    return null;
}
