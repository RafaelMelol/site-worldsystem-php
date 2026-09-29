# Site World System – versão PHP

Site institucional da World System – Soluções em TI, de Lagoa da Prata/MG, escrito em PHP para hospedagem compartilhada.

## Stack

- PHP 8
- HTML e CSS gerado com Tailwind CSS v4
- JavaScript sem bibliotecas

## Estrutura

```
public_html/       arquivos que sobem para a hospedagem
  *.php            páginas do site
  admin/           painel de vagas (login e cadastro)
  inc/             layout, componentes, conteúdo e funções
  envio/           recebe os formulários de contato e de currículo
  assets/          css, js e imagens
banco/             estrutura.sql, a tabela de vagas
build/             fonte do Tailwind, usada só no desenvolvimento
ferramentas/       gerador da senha do painel
```

Os textos ficam em `public_html/inc/conteudo/`. Para mudar uma solução, um recurso, o FAQ ou os dados de contato, basta editar esses arquivos.

## Gerando o CSS

O CSS já vai pronto em `public_html/assets/css/site.css`. Depois de mexer nas classes das páginas, gere de novo:

```bash
cd build
npm install
npm run css
```

## Painel de vagas

As vagas que aparecem na página Oportunidades são cadastradas em `/admin`.

Ele precisa de dois arquivos de configuração, que ficam fora do Git:

1. **Banco:** copie `public_html/inc/config-banco.example.php` para `config-banco.php` e preencha com os dados do MySQL. Crie a tabela rodando `banco/estrutura.sql` no phpMyAdmin.
2. **Acesso:** copie `public_html/inc/config-admin.example.php` para `config-admin.php` e gere a senha cifrada com:

```bash
php ferramentas/gerar-senha.php
```

O comando pede a senha, mostra a versão cifrada para colar no arquivo e não grava a senha em lugar nenhum.

Sem essas configurações o site continua funcionando; só a lista de vagas fica vazia.

## Rodando localmente

```bash
php -S localhost:8080 -t public_html
```

O PHP precisa das extensões `pdo_mysql`, `mbstring` e `fileinfo` ativadas no `php.ini`.

## Publicação

Envie o conteúdo de `public_html/` para a pasta pública da hospedagem. É preciso PHP 8, MySQL e o Apache com `mod_rewrite` para os endereços sem `.php`.
