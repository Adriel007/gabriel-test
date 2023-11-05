-- drop database dbgabriel;

create database dbgabriel;
use dbgabriel;

-- Tabela de Animais
CREATE TABLE Pet (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    code_ CHAR(6) NOT NULL,
    name_ VARCHAR(255) NOT NULL,
    image_ VARCHAR(255) NOT NULL,
    sex_ ENUM("m", "f") NOT NULL,
    species_ VARCHAR(255) NOT NULL,
    breed_ VARCHAR(255) NOT NULL,
    age_ INT NOT NULL,
    weight_ DECIMAL(5, 2),
    size_ ENUM('small', 'medium', 'large') NOT NULL,
    local_ VARCHAR(255) NOT NULL,
    about_ TEXT,
    status_ ENUM('active', 'inactive') NOT NULL
);
insert into Pet
(code_, name_, image_, sex_, species_, breed_, age_, weight_, size_, local_, about_, status_)
values
("675092", "Bili", "bili.webp", "m", "Cachorro", "Yorkshire", 1, 2.2, "small", "Petz Casa Grande, Diadema - SP", "Filhotinho de yorkshire", "active"),
("873012", "Tini", "tini.webp", "f", "Gato", "American Shorthair", 3, 5.0, "small", "Petz Bom Retiro, Curitiba - PR", "💖 Frajolinha Fêmea de narizinho rosa", "active"),
("309123", "Luna", "luna.webp", "f", "Cachorro", "Schnauzer", 4, 10.0, "small", "Petz Vila Gomes, São Paulo - SP", "Schnauzer", "active"),
("129381", "Bird", "bird.webp", "m", "Gato", "Van turco", 3, 5.0, "small", "Petz Centro, Teresina - PI", "Gato", "active"),
("675092", "Suzy", "suzy.webp", "f", "Gato", "American Shorthair", 2, 4.5, "small", "Petz Bom Retiro, Curitiba - PR", "American Shorthair", "active"),
("675092", "Teco", "teco.webp", "m", "Gato", "Shorthair Europeu", 3, 6.5, "small", "Petz Centro, Teresina - PI", "Shorthair Europeu", "active"),
("675092", "Bruce", "bruce.webp", "m", "Cachorro", "Bulldog", 6, 8.0, "small", "Petz Buritis, Belo Horizonte - MG", "Bulldog", "active"),
("231032", "Maya", "maya.webp", "f", "Cachorro", "Shorthair Europeu", 2, 3.7, "small", "Petz Vila Joana, Jundiaí - SP", "", "active"),
("412398", "Bela", "bela.webp", "f", "Cachorro", "Labrador", 3, 10.0, "medium", "Petz Guará I, Brasília - DF", "", "active"),
("230131", "Gaia", "gaia.webp", "f", "Gato", "Persa", 7, 7.5, "small", "Petz Igrejinha, Capanema - PA", "Persa", "active"),
("005612", "Koda", "koda.webp", "m", "Coelho", "Teddy Dwerg", 5, 2.5, "small", "Petz Centro, Teresina - PI", "", "active"),
("093132", "Luke", "luke.webp", "m", "Cachorro", "Golden Retriever", 7, 15.0, "medium", "Petz Warta, Londrina - PR", "Golden Retriever", "active");


-- Tabela de Adoção
CREATE TABLE Adopt (
    name_ VARCHAR(255) NOT NULL,
    animal_id_ INT NOT NULL,
    cpf_ VARCHAR(11) NOT NULL,
    email_ VARCHAR(255) NOT NULL,
    cellphone_ VARCHAR(20) NOT NULL,
    birth_ DATE NOT NULL,
    date_ TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (name_, animal_id_)
);

-- Tabela de ADM
CREATE TABLE ADM (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name_ VARCHAR(255) NOT NULL,
    email_ VARCHAR(255) NOT NULL,
    password_ VARCHAR(255) NOT NULL
);

-- Tabela de Espécies
CREATE TABLE Species (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    species_name VARCHAR(255) NOT NULL
);

-- Tabela de Raças
CREATE TABLE Breeds (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    breed_name VARCHAR(255) NOT NULL,
    species_id INT,
    FOREIGN KEY (species_id) REFERENCES Species(ID)
);

-- INSERTS - TABELAS DE DADOS INICIAIS

-- Inserir algumas espécies
INSERT INTO Species (species_name) VALUES
('Cachorro'),
('Gato'),
('Coelho'),
('Pássaro'),
('Outro');

-- Inserir algumas raças para Cachorros
INSERT INTO Breeds (breed_name, species_id) VALUES
('Labrador', 1),
('Bulldog', 1),
('Poodle', 1);

-- Inserir algumas raças para Gatos
INSERT INTO Breeds (breed_name, species_id) VALUES
('Siamês', 2),
('Persa', 2),
('Maine Coon', 2);

-- Inserir algumas raças para Coelhos
INSERT INTO Breeds (breed_name, species_id) VALUES
('Holland Lop', 3),
('Mini Rex', 3);

-- Inserir algumas raças para Pássaros
INSERT INTO Breeds (breed_name, species_id) VALUES
('Canário', 4),
('Periquito', 4);

-- Inserir alguns registros na tabela ADM
INSERT INTO ADM (name_, email_, password_) VALUES
('admin1', 'admin1@example.com', 'senha1'),
('admin2', 'admin2@example.com', 'senha2'),
('admin3', 'admin3@example.com', 'senha3');

-- Generate 5 random pet records
INSERT INTO Pet (code_, name_, image_, sex_, species_, breed_, age_, weight_, size_, local_, about_, status_)
SELECT
    FLOOR(100000 + RAND() * 900000) AS code_,
    CONCAT('Pet', FLOOR(1 + RAND() * 100)) AS name_,
    'pet_image.jpg' AS image_,
    CASE WHEN RAND() < 0.5 THEN 'm' ELSE 'f' END AS sex_,
    'Random Species' AS species_,
    'Random Breed' AS breed_,
    FLOOR(1 + RAND() * 10) AS age_,
    ROUND(1 + RAND() * 10, 2) AS weight_,
    CASE
        WHEN RAND() < 0.3 THEN 'small'
        WHEN RAND() < 0.6 THEN 'medium'
        ELSE 'large'
    END AS size_,
    'Random Location' AS local_,
    'Random Description' AS about_,
    CASE WHEN RAND() < 0.8 THEN 'active' ELSE 'inactive' END AS status_
FROM (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) AS random_data;

-- Generate 5 random adoption records
INSERT INTO Adopt (name_, animal_id_, cpf_, email_, cellphone_, birth_)
SELECT
    CONCAT('Adopter', FLOOR(1 + RAND() * 100)) AS name_,
    FLOOR(1 + RAND() * 5) AS animal_id_,
    LPAD(FLOOR(100000 + RAND() * 900000), 11, '0') AS cpf_,
    CONCAT('adopter', FLOOR(1 + RAND() * 100), '@example.com') AS email_,
    CONCAT('9', FLOOR(10 + RAND() * 90), FLOOR(100000000 + RAND() * 900000000)) AS cellphone_,
    DATE_ADD('1970-01-01', INTERVAL FLOOR(RAND() * 365 * 40) DAY) AS birth_
FROM (SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) AS random_data;

select * from pet where 1=1;
