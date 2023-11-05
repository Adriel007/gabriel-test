-- Tabela de Animais
CREATE TABLE Animals (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name_ VARCHAR(255) NOT NULL,
    image_ VARCHAR(255) NOT NULL,
    specie_ VARCHAR(255) NOT NULL,
    breed_ VARCHAR(255) NOT NULL,
    age_ INT NOT NULL,
    weight_ DECIMAL(5, 2),
    size_ ENUM('little', 'middle', 'big') NOT NULL,
    local_ VARCHAR(255) NOT NULL,
    about_ TEXT,
    status_ ENUM('active', 'inactive') NOT NULL
);

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
INSERT INTO ADM (name_, email, password_) VALUES
('admin1', 'admin1@example.com', 'senha1'),
('admin2', 'admin2@example.com', 'senha2'),
('admin3', 'admin3@example.com', 'senha3');
