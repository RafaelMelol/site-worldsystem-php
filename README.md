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
  inc/             layout, componentes, conteúdo e funções
  envio/           recebe os formulários de contato e de currículo
  assets/          css, js e imagens
build/             fonte do Tailwind, usada só no desenvolvimento
```

Os textos ficam em `public_html/inc/conteudo/`. Para mudar uma solução, um recurso, o FAQ ou os dados de contato, basta editar esses arquivos.

## Gerando o CSS

O CSS já vai pronto em `public_html/assets/css/site.css`. Depois de mexer nas classes das páginas, gere de novo:

```bash
cd build
npm install
npm run css
```

## Rodando localmente

```bash
php -S localhost:8080 -t public_html
```

## Publicação

Envie o conteúdo de `public_html/` para a pasta pública da hospedagem. É preciso PHP 8 e o Apache com `mod_rewrite` para os endereços sem `.php`.
