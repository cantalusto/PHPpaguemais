
-- Banco de dados: farmacia_pague_mais

CREATE DATABASE IF NOT EXISTS farmacia_pague_mais;
USE farmacia_pague_mais;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de produtos
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade INT NOT NULL
);

-- Inserir usuário admin
INSERT INTO usuarios (nome, email, senha) VALUES
('Administrador', 'admin@farmacia.com', MD5('admin123'));
