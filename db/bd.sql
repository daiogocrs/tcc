CREATE DATABASE meubanco;

use meubanco;

CREATE TABLE adm (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(100) NOT NULL
);

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
    produtonome VARCHAR(100) NOT NULL,
    preco VARCHAR(100) NOT NULL,
    categoria VARCHAR(100)
);

INSERT INTO usuarios (email, senha, nivel_acesso)
VALUES ('admin@gmail.com', '123123', 'adm');
