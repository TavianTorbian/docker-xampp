-- DIPENDENTI
INSERT INTO Dipendenti (Matricola, CF, Nome, Cognome, Indirizzo)
VALUES
(1, 'RSSMRA80A01F205X', 'Mario', 'Rossi', 'Via Roma 12, Milano'),
(2, 'BNCLGU85B22H501Z', 'Luigi', 'Bianchi', 'Corso Italia 45, Torino'),
(3, 'VRDPLA90C15L219Y', 'Paola', 'Verdi', 'Via Dante 99, Firenze');

-- MAGAZZINI
INSERT INTO Magazzini (Codice, Capienza, Indirizzo)
VALUES
(10, 5000, 'Via dei Magazzini 1, Milano'),
(11, 3000, 'Via Torino 22, Torino'),
(12, 4000, 'Via Firenze 33, Firenze');

-- PRODOTTI
INSERT INTO Prodotti (Id, Codice, Matricola, Descrizione, Nome)
VALUES
(100, 10, 1, 'Gelato alla vaniglia artigianale', 'Gelato Vaniglia'),
(101, 10, 2, 'Gelato al cioccolato fondente', 'Gelato Cioccolato'),
(102, 11, 3, 'Panna montata pronta', 'Panna Montata');

-- MATERIE PRIME
INSERT INTO MateriePrime (Tipologia, CostoUnitario, PesoUnitario, Codice)
VALUES
('Panna Fresca', 2.50, 1.00, 10),
('Latte Intero', 1.20, 1.00, 10),
('Zucchero', 0.80, 1.00, 11),
('Cacao in Polvere', 3.00, 0.50, 11),
('Vaniglia', 5.00, 0.10, 12);

-- RICETTE (relazioni tra Prodotti e Materie Prime)
-- Gelato Vaniglia
INSERT INTO Ricette (Tipologia, Id, Qtà)
VALUES
('Latte Intero', 100, 2.00),
('Zucchero', 100, 0.50),
('Vaniglia', 100, 0.05),
('Panna Fresca', 100, 0.80);

-- Gelato Cioccolato
INSERT INTO Ricette (Tipologia, Id, Qtà)
VALUES
('Latte Intero', 101, 2.00),
('Zucchero', 101, 0.50),
('Cacao in Polvere', 101, 0.30),
('Panna Fresca', 101, 0.70);

-- Panna Montata
INSERT INTO Ricette (Tipologia, Id, Qtà)
VALUES
('Panna Fresca', 102, 1.00),
('Zucchero', 102, 0.10);
