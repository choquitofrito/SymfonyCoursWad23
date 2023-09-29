Ce fichier contient des exemples de requêtes SQL

# 1. Requêtes simples, un seul tableau

```sql
-- Obtenir le tableau complet Livre (obtenir toutes les colonnes de tous les livres)
SELECT * FROM Livre
-- Obtenir le titre et le nombre_pages de tous les livres
SELECT titre, nombre_pages FROM livre; 
```

# 2. Requêtes avec un filtre WHERE, un seul tableau

```sql
-- Livres de plus de 150 pages
SELECT id, titre, nombre_pages FROM livre WHERE nombre_pages>150; 
-- Livres publiés à partir de 2021 inclus
SELECT * FROM livre WHERE date_publication >= '2021-1-1' ORDER BY date_publication ASC; 
```

# 3. Requêtes avec un filtre WHERE multiple, un seul tableau

```sql
-- Livres de plus de 150 pages qui coûtent moins de 50 euros
SELECT * FROM livre WHERE nombre_pages >= 150 AND prix <=50
-- Livres qui coûtent entre 20 et 50 euros
SELECT * FROM livre WHERE prix BETWEEN 20 AND 50
-- Livres qui coûtent entre 10 et 80 euros et qui ont plus de 20 pages
SELECT * FROM livre WHERE prix >= 10 AND prix <= 80 AND nombre_pages >=20 ORDER BY prix ASC;
-- Auteurs dont le nom commence par 'J' (LIKE)
SELECT * FROM auteur WHERE nom LIKE "J%"
-- Auteurs dont le nom finit par 's' (LIKE)
SELECT * FROM auteur WHERE nom LIKE "%s" ORDER BY nom ASC
-- Livres dont le titre contient 'sa' (LIKE)
SELECT * FROM livre WHERE titre LIKE "%sa%" ORDER BY titre ASC
-- Obtenir les Livres dont le prix est inférieur à 20 et aussi les livres
-- dont le prix est supérieur à 40 
SELECT * FROM livre WHERE prix < 15 OR prix > 50
```

# 4. Requête multi-table simples (INNER JOIN)

```sql

-- Obtenir tous les exemplaires des livres dont le titre contient 
-- un certain texte et leur état
SELECT livre.id, livre.titre, exemplaire.id, exemplaire.etat 
FROM livre 
INNER JOIN exemplaire 
ON livre.id = exemplaire.livre_id 
WHERE livre.titre LIKE '%sa%' ORDER BY livre.id ASC; 

-- Livres publiés entre deux dates dont l'auteur est d'une nationalité précise
SELECT livre.id AS livreID, auteur.id AS auteurID, livre.titre, auteur.nom, auteur.nationalite, livre.date_publication 
FROM livre 
INNER JOIN auteur_livre 
INNER JOIN auteur 
ON livre.id = auteur_livre.livre_id AND auteur.id = auteur_livre.auteur_id 
WHERE livre.date_publication 
BETWEEN '2000-1-1' AND '2022-1-1' 
AND auteur.nationalite = 'Finland' 
OR auteur.nationalite='Korea'; 
```

