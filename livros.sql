CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    genero VARCHAR(100),
    ano_publicacao INT,
    status ENUM('Lido', 'Não Lido') DEFAULT 'Não Lido'
);