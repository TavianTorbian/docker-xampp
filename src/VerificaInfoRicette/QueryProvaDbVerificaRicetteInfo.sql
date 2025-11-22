--1)la capienza media di tutti i magazzini
SELECT AVG(capienza) AS capienza_media_magazzini
FROM Magazzini

--2)il numero di volte che la materia prima "Panna Fresca" viene utilizzata in delle ricette
SELECT COUNT(*) AS numero_panne
FROM MateriePrime JOIN Ricette
WHERE Tipologia = "Panna Fresca"

--3)il numero di ingredienti utilizzati per ciascun prodotto
SELECT p.Id AS IdProdotto, p.Nome AS NomeProdotto, COUNT(r.Tipologia) AS NumeroIngredienti
FROM Prodotti p
JOIN Ricette r ON p.Id = r.Id
GROUP BY p.Id, p.Nome;

--4)la lista dei dipendenti che non sono responsabili di alcun prodotto 
SELECT d.Matricola, d.Nome, d.Cognome
FROM Dipendenti d
JOIN Prodotti p ON d.Matricola = p.Matricola
WHERE p.Id = null;

--5)le migliori 10 materie prime che vengono utilizzata in maggior quantità (intesa come peso totale, non numero di utilizzi)
SELECT m.Tipologia, SUM(r.Qta * m.PesoUnitario) AS PesoTotaleUtilizzato
FROM MateriePrime m
JOIN Ricette r
ORDER BY PesoTotaleUtilizzato DESC
LIMIT 10;

--6)il numero di prodotti contenuti in ciascun magazzino, mantenendo soltanto quelli che ne hanno più di 50
SELECT m.Codice, COUNT(*) AS NumeroProdotti
FROM Magazzini m
WHERE (
        SELECT COUNT(*)
        FROM Prodotti p
        WHERE p.Codice = m.Codice
        ) > 50;

--7)la lista dei prodotti che utilizzano almeno una materia prima che non è contenuta in alcun magazzino
SELECT DISTINCT p.Id, p.Nome
FROM Prodotti p
JOIN Ricette r ON p.Id = r.Id
JOIN MateriePrime m ON r.Tipologia = m.Tipologia
WHERE m.Codice =null;

--8)la lista dei prodotti il cui costa totale delle materie prime supera la media dei costi totali di tutti i prodotti
SELECT p.Id, p.Nome, SUM(r.Qta * m.CostoUnitario) AS CostoTotale
FROM Prodotti p
JOIN Ricette r ON p.Id = r.Id
JOIN MateriePrime m ON r.Tipologia = m.Tipologia
GROUP BY p.Id, p.Nome
HAVING SUM(r.Qta * m.CostoUnitario) > (
                                        SELECT AVG(CostoTotale)
                                        FROM (
                                                SELECT SUM(r2.Qta * m2.CostoUnitario) AS CostoTotale
                                                FROM Prodotti p2
                                                JOIN Ricette r2 ON p2.Id = r2.Id
                                                JOIN MateriePrime m2 ON r2.Tipologia = m2.Tipologia
                                                GROUP BY p2.Id
                                            ) AS Media
                                    );