CREATE DATABASE Fabbrica;
USE Fabbrica;

-- TABELLA DIPENDENTI
CREATE TABLE Dipendenti (
    Matricola INT PRIMARY KEY,
    CF VARCHAR(16) NOT NULL UNIQUE,
    Nome VARCHAR(50) NOT NULL,
    Cognome VARCHAR(50) NOT NULL,
    Indirizzo VARCHAR(100)
);

-- TABELLA MAGAZZINI
CREATE TABLE Magazzini (
    Codice INT PRIMARY KEY,
    Capienza INT NOT NULL,
    Indirizzo VARCHAR(100)
);

-- TABELLA PRODOTTI
CREATE TABLE Prodotti (
    Id INT PRIMARY KEY,
    Codice INT,
    Matricola INT,
    Descrizione VARCHAR(255),
    Nome VARCHAR(100),
    FOREIGN KEY (Codice) REFERENCES Magazzini(Codice)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    FOREIGN KEY (Matricola) REFERENCES Dipendenti(Matricola)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- TABELLA MATERIE PRIME
CREATE TABLE MateriePrime (
    Tipologia VARCHAR(50) PRIMARY KEY,
    CostoUnitario DECIMAL(10,2) NOT NULL,
    PesoUnitario DECIMAL(10,2),
    Codice INT,
    FOREIGN KEY (Codice) REFERENCES Magazzini(Codice)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

-- TABELLA RICETTE (relazione N:M tra Prodotti e MateriePrime)
CREATE TABLE Ricette (
    Tipologia VARCHAR(50),
    Id INT,
    Qtà DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (Tipologia, Id),
    FOREIGN KEY (Tipologia) REFERENCES MateriePrime(Tipologia)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (Id) REFERENCES Prodotti(Id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
