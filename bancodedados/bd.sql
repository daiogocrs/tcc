DROP DATABASE meubanco;

CREATE DATABASE meubanco;

USE meubanco;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    rua VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso ENUM('adm', 'usuario') NOT NULL
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL, 
    categoria VARCHAR(100) NOT NULL
);

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    tamanho VARCHAR(255) NOT NULL,
    carne VARCHAR(255) NOT NULL,
    comidas TEXT,
    saladas TEXT,
    outros TEXT
);

INSERT INTO usuarios (nome, email, cidade, bairro, rua, senha, nivel_acesso)
VALUES ('cantina', 'admin@gmail.com', 'sombrio', 'x', 'x', '123123', 'adm');

-- Recomendado para armazenar senhas com segurança
-- Aplique um algoritmo de hash e salting às senhas