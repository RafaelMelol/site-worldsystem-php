<?php
// Leitura e gravação das vagas de emprego.
//
// Requisitos e benefícios são guardados como texto, um item por linha, que é
// como o administrador digita no painel.

require_once __DIR__ . '/banco.php';

/** Vagas publicadas, da mais nova para a mais antiga. Usada no site. */
function vagas_publicadas(): array
{
    return banco()
        ->query('SELECT * FROM vagas WHERE ativa = 1 ORDER BY criada_em DESC')
        ->fetchAll();
}

/** Todas as vagas, publicadas ou não. Usada no painel. */
function vagas_todas(): array
{
    return banco()
        ->query('SELECT * FROM vagas ORDER BY ativa DESC, criada_em DESC')
        ->fetchAll();
}

/** Uma vaga pelo código. Devolve null se não existir. */
function vaga_por_id(int $id): ?array
{
    $consulta = banco()->prepare('SELECT * FROM vagas WHERE id = ?');
    $consulta->execute([$id]);

    return $consulta->fetch() ?: null;
}

/** Cria uma vaga e devolve o código dela. */
function vaga_criar(array $dados): int
{
    $consulta = banco()->prepare(
        'INSERT INTO vagas (titulo, descricao, requisitos, beneficios, ativa) VALUES (?, ?, ?, ?, ?)'
    );
    $consulta->execute([
        $dados['titulo'],
        $dados['descricao'],
        $dados['requisitos'],
        $dados['beneficios'],
        $dados['ativa'] ? 1 : 0,
    ]);

    return (int) banco()->lastInsertId();
}

/** Atualiza uma vaga existente. */
function vaga_atualizar(int $id, array $dados): void
{
    $consulta = banco()->prepare(
        'UPDATE vagas SET titulo = ?, descricao = ?, requisitos = ?, beneficios = ?, ativa = ? WHERE id = ?'
    );
    $consulta->execute([
        $dados['titulo'],
        $dados['descricao'],
        $dados['requisitos'],
        $dados['beneficios'],
        $dados['ativa'] ? 1 : 0,
        $id,
    ]);
}

/** Apaga uma vaga. */
function vaga_excluir(int $id): void
{
    banco()->prepare('DELETE FROM vagas WHERE id = ?')->execute([$id]);
}

/** Publica ou despublica uma vaga. */
function vaga_alternar_publicacao(int $id): void
{
    banco()->prepare('UPDATE vagas SET ativa = 1 - ativa WHERE id = ?')->execute([$id]);
}

/** Quebra um texto de "um item por linha" em uma lista, sem linhas vazias. */
function linhas_em_lista(string $texto): array
{
    $itens = preg_split('/\r\n|\r|\n/', $texto) ?: [];
    $itens = array_map('trim', $itens);

    return array_values(array_filter($itens, fn ($item) => $item !== ''));
}

/** Conta caracteres mesmo sem a extensão mbstring instalada. */
function contar_caracteres(string $valor): int
{
    return function_exists('mb_strlen') ? mb_strlen($valor) : strlen($valor);
}

/** Confere os campos de uma vaga. Devolve os erros por campo. */
function vaga_validar(array $dados): array
{
    $erros = [];

    if (contar_caracteres(trim($dados['titulo'] ?? '')) < 3) {
        $erros['titulo'] = 'Informe o nome da vaga.';
    }
    if (contar_caracteres(trim($dados['descricao'] ?? '')) < 20) {
        $erros['descricao'] = 'Descreva a vaga com pelo menos 20 caracteres.';
    }
    if (!linhas_em_lista($dados['requisitos'] ?? '')) {
        $erros['requisitos'] = 'Informe ao menos um requisito.';
    }
    if (!linhas_em_lista($dados['beneficios'] ?? '')) {
        $erros['beneficios'] = 'Informe ao menos um benefício.';
    }

    return $erros;
}
