create database tcc;
use tcc;

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nome` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `cidade` varchar (20) NOT NULL,
  `estado` varchar (2) NOT NULL,
  `telefone` varchar (14) DEFAULT NULL,
   `email` varchar(100) NOT NULL
);

CREATE TABLE `notificacao` (
    `id_notificacao` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data` date NOT NULL,
    `texto` varchar(200) NOT NULL,
	`notificado` boolean NOT NULL,
	`email` varchar(100) DEFAULT NULL,
    `id_usuario` integer,
    CONSTRAINT fk_usuarionotificacao FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
);

CREATE TABLE `colmeia` (
    `id_colmeia` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `identificador` varchar(20) NOT NULL,
    `procedencia` varchar(30) NOT NULL,
    `id_usuario` integer,
    CONSTRAINT fk_usuariocolmeia FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
);

CREATE TABLE `verificacao` (
    `id_verificacao` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `data_visita` date NOT NULL,
    `producao` int DEFAULT NULL,
	`postura` varchar(20) DEFAULT NULL,
	`lamina_nova` int DEFAULT NULL,
	`castilho` varchar(20) DEFAULT NULL,
	`melgueira` int DEFAULT NULL,
	`rainha` varchar(20) DEFAULT NULL,
	`anotacao` text(200) DEFAULT NULL,
	`id_colmeia` integer,
    CONSTRAINT fk_colemiaverificacao FOREIGN KEY (id_colmeia) REFERENCES colmeia (id_colmeia)
);

INSERT INTO usuario (id_usuario, nome, senha, cidade, estado, telefone) VALUES (5, 'Maria Helo', '12345', 'taquaruçu', 'rs', '55996551372');
select*from usuario;
