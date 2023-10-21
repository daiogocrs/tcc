DROP DATABASE IF EXISTS bdcantina;

CREATE DATABASE bdcantina;

USE bdcantina;

CREATE TABLE usuarios (
    id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel_acesso ENUM('adm', 'usuario') NOT NULL
);

CREATE TABLE produtos (
    id_produtos INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL, 
    categoria VARCHAR(100) NOT NULL
);

CREATE TABLE pedidos (
    id_pedidos INT AUTO_INCREMENT PRIMARY KEY,
    tamanho VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    comidas TEXT,
    cidade VARCHAR(255) NOT NULL,
    bairro VARCHAR(255) NOT NULL,
    rua VARCHAR(255) NOT NULL,
    numero DECIMAL(3, 0) NOT NULL,
    complemento VARCHAR(255) NOT NULL,
    data_hora_pedido DATETIME NOT NULL,
    forma_pagamento VARCHAR(100) NOT NULL
);

INSERT INTO usuarios (nome, email, senha, nivel_acesso)
VALUES ('cantina', 'admin@gmail.com', '123123', 'adm');