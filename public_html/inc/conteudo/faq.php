<?php
// Perguntas frequentes da página /faq.php, agrupadas por categoria.

const FAQ = [
    [
        'titulo' => 'SPED / EFD-Contribuições',
        'descricao' => 'Escrituração fiscal digital e recibos de entrega.',
        'itens' => [
            [
                'pergunta' => 'Perdi o recibo de entrega da EFD-Contribuições. Como recuperar?',
                'resposta' => 'O recibo é gerado pelo ReceitaNet com extensão .REC. É possível recuperá-lo usando o aplicativo ReceitanetBX, disponível no site da Receita Federal, ou reenviando a escrituração original para que o sistema gere um novo recibo.',
            ],
        ],
    ],
    [
        'titulo' => 'NFC-e (Nota Fiscal de Consumidor Eletrônica)',
        'descricao' => 'Cancelamentos, trocas e devoluções.',
        'itens' => [
            [
                'pergunta' => 'Qual o prazo máximo para cancelamento de NFC-e em Minas Gerais?',
                'resposta' => 'O prazo máximo padrão para o cancelamento de uma NFC-e em Minas Gerais é de até 30 minutos após a concessão da autorização de uso.',
            ],
            [
                'pergunta' => 'Qual o prazo máximo para cancelamento por substituição (contingência) de NFC-e em Minas Gerais?',
                'resposta' => 'O prazo máximo é de 168 horas (7 dias) contados da emissão da nota em contingência para cobrir a mesma operação.',
            ],
            [
                'pergunta' => 'Qual o prazo máximo para cancelamento extemporâneo (fora do prazo) de NFC-e em Minas Gerais?',
                'resposta' => 'Segundo o fisco mineiro, não há previsão regulamentada de cancelamento extemporâneo para a NFC-e. O procedimento usual recomendado para anular a operação é a emissão de uma NFe de devolução.',
            ],
        ],
    ],
    [
        'titulo' => 'Nota Fiscal Eletrônica (NF-e)',
        'descricao' => 'DANFE, carta de correção e cancelamento.',
        'itens' => [
            [
                'pergunta' => 'Por que o DANFE de empresas do Simples Nacional exibe o CST em vez do CSOSN?',
                'resposta' => 'O CSOSN altera apenas a parte referente à situação tributária do código, não a origem da mercadoria. Por isso, o CST — que reúne origem e tributação — continua aparecendo no DANFE.',
            ],
            [
                'pergunta' => 'Quando pode ser usada a Carta de Correção?',
                'resposta' => 'A Carta de Correção pode ser usada quando o erro não envolve valores de impostos, não exige alteração do remetente ou destinatário e não altera a data de emissão ou de saída.',
            ],
            [
                'pergunta' => 'Como cancelar uma NF-e fora do prazo legal de 24 horas?',
                'resposta' => 'É necessário solicitar autorização pelo sistema SIARE antes de transmitir o cancelamento. O sistema gera um protocolo válido por 30 dias para o processamento do cancelamento extemporâneo.',
            ],
        ],
    ],
    [
        'titulo' => 'SINTEGRA',
        'descricao' => 'Declaração de operações e créditos de ICMS.',
        'itens' => [
            [
                'pergunta' => 'Como declarar no SINTEGRA notas fiscais com CFOP 5.929 referentes a cupons?',
                'resposta' => 'As notas devem ser emitidas zerando os campos de imposto e excluindo os registros tipo 54, conforme o RICMS.',
            ],
            [
                'pergunta' => 'Empresas do Simples Nacional precisam informar base e valor de ICMS em notas de entrada?',
                'resposta' => 'Sim. As empresas devem informar os valores da operação quando a mercadoria não gerar crédito de imposto.',
            ],
        ],
    ],
    [
        'titulo' => 'Geral',
        'descricao' => 'Backup, manutenção e cadastro de produtos.',
        'itens' => [
            [
                'pergunta' => 'Quais procedimentos tomar antes de formatar o servidor?',
                'resposta' => 'É necessário contatar o suporte da World System para a realização de backup do banco de dados do sistema, arquivos de configuração da empresa, pastas de XMLs dos documentos fiscais, etc.',
            ],
            [
                'pergunta' => 'É necessário cadastrar individualmente cada item de aquisição na tabela de produtos?',
                'resposta' => 'Não. Conforme o Ato Cotepe nº 9, materiais de uso e consumo que não geram crédito de imposto podem ser consolidados, sem necessidade de cadastro individual.',
            ],
        ],
    ],
];
