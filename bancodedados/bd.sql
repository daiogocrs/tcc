CREATE DATABASE meubanco;

use meubanco;

CREATE TABLE usuarios(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    cidade VARCHAR (100) NOT NULL,
    bairro VARCHAR (100) NOT NULL,
    rua VARCHAR (100) NOT NULL,
    senha VARCHAR (100) NOT NULL,
    nivel_acesso ENUM('adm', 'usuario') NOT NULL
);

CREATE TABLE produtos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    preco VARCHAR(100) NOT NULL,
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
