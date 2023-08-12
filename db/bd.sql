CREATE DATABASE meubanco;

use meubanco;

CREATE TABLE usuarios(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    cidade VARCHAR (100) NOT NULL,
    bairro VARCHAR (100) NOT NULL,
    rua VARCHAR (100) NOT NULL,
    senha VARCHAR (100) NOT NULL
);

CREATE TABLE produtos (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    produtonome VARCHAR(100) NOT NULL,
    preco VARCHAR(100) NOT NULL,
    categoria VARCHAR(100)
);

INSERT INTO produtos (nome, preco, categoria)
VALUES ('asd', 1, 'asd');

INSERT INTO usuarios (nome, email, cidade, bairro, rua, senha)
VALUES ('asd', 'asd@gmail.com', 'asd', 'asd', 'asd', '123');