CREATE DATABASE gestion_commande;
USE gestion_commande;
CREATE TABLE marchandise(
	id_marchandise CHAR(10) PRIMARY KEY,
    description VARCHAR(60),
    unit_price int
);
CREATE TABLE client(
	id_client CHAR(10) PRIMARY KEY,
    nom_client VARCHAR(50)
);
INSERT INTO client
SET id_client="C000000001",
nom_client="Zakaria AIT ERRAMI";

INSERT INTO client
SET id_client="C000000002",
nom_client="Soukaina HAFIDI";

INSERT INTO marchandise
SET id_marchandise="BA8379CF0K",
description="Dell ordinateur portable Core i5, 8Go de RAM, SSD 256 Go",
unit_price=40000;

INSERT INTO marchandise
SET id_marchandise="DR943TA39F",
description="Manuel du guerir de la lumiere ecrit par Paulo Coelho",
unit_price="500";

CREATE UNIQUE INDEX description_idx
ON marchandise(description);

INSERT INTO marchandise
SET id_marchandise="TH30759G6L",
description="Manette sans fil pour Playstation 4",
unit_price=2500;

CREATE TABLE commande(
	id_commande CHAR(10) PRIMARY KEY,
    id_client CHAR(10),
    FOREIGN KEY (id_client)
    REFERENCES client(id_client)
);

CREATE TABLE ligne_commande(
	id_commande CHAR(10),
    id_client CHAR(10),
    id_marchandise CHAR(10),
    quantity int,
    PRIMARY KEY(id_commande,id_marchandise),
    FOREIGN KEY(id_commande) REFERENCES commande(id_commande),
    FOREIGN KEY(id_marchandise) REFERENCES marchandise(id_marchandise)
);

-- commande pour Zakaria
INSERT INTO commande
SET id_client="C000000001",
id_commande="D000000001";
-- ligne commande Zakaria
INSERT INTO ligne_commande
SET id_commande="D000000001",
id_marchandise="BA8379CF0K",
quantity=4;
INSERT INTO ligne_commande
SET id_commande="D000000001",
id_marchandise="DR943TA39F",
quantity=2;
INSERT INTO ligne_commande
SET id_commande="D000000001",
id_marchandise="TH30759G6L",
quantity=1;
-- autre commande pour Zakaria
INSERT INTO commande
SET id_client="C000000001",
id_commande="D000000002";
-- ligne commande pour la deuxieme commande de Zakaria
INSERT INTO ligne_commande
SET id_commande="D000000002",
id_marchandise="BA8379CF0K",
quantity=20;
INSERT INTO ligne_commande
SET id_commande="D000000002",
id_marchandise="DR943TA39F",
quantity=50;
INSERT INTO ligne_commande
SET id_commande="D000000002",
id_marchandise="TH30759G6L",
quantity=15;

-- commande pour Soukaina
INSERT INTO commande
SET id_client="C000000002",
id_commande="D000000003";
-- ligne commande Soukaina
INSERT INTO ligne_commande
SET id_commande="D000000003",
id_marchandise="DR943TA39F",
quantity=1000;
INSERT INTO ligne_commande
SET id_commande="D000000003",
id_marchandise="TH30759G6L",
quantity=500;

-- lier tout
USE gestion_commande;
SELECT
client.nom_client,
ligne_commande.id_commande,
marchandise.description,
ligne_commande.quantity,
marchandise.unit_price /100 AS "unit_price_decimal",
ligne_commande.quantity * marchandise.unit_price / 100 AS "prix_total"
FROM ligne_commande, commande, client, marchandise
WHERE
ligne_commande.id_marchandise = marchandise.id_marchandise AND
commande.id_client = client.id_client AND
ligne_commande.id_commande = commande.id_commande
ORDER BY
nom_client,
ligne_commande.id_commande,
marchandise.description