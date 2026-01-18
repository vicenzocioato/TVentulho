SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS comentarios;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL,
    senha VARCHAR(20) NOT NULL
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    texto VARCHAR(500) NOT NULL,
    obraId VARCHAR(16) NOT NULL,
    data DATE DEFAULT (CURRENT_DATE),
    CONSTRAINT fk_comentarios_usuario
        FOREIGN KEY (userId) REFERENCES usuarios(id)
);

CREATE TABLE items(
    id INT AUTO_INCREMENT PRIMARY KEY,
    texto VARCHAR(500) NOT NULL,
    userId INT NOT NULL,
    CONSTRAINT fk_items_usuario
        FOREIGN KEY (userId) REFERENCES usuarios(id)
);

SET FOREIGN_KEY_CHECKS = 1;
