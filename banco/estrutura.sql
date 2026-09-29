-- Estrutura do banco do site. Rode uma vez, no phpMyAdmin da hospedagem
-- (aba Importar ou SQL) ou pela linha de comando do MySQL.

CREATE TABLE IF NOT EXISTS vagas (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(150) NOT NULL,
    descricao TEXT NOT NULL,
    requisitos TEXT NOT NULL,
    beneficios TEXT NOT NULL,
    ativa TINYINT(1) NOT NULL DEFAULT 1,
    criada_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizada_em DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_ativa (ativa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
