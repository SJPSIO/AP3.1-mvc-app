USE tp_sio2_bdjourneeintegration;

DROP TABLE IF EXISTS `developpeur`;

CREATE TABLE Developpeur (
    id int Auto_increment NOT NULL,
    nom Varchar(20) NOT NULL,
    prenom Varchar(15) NOT NULL,
    CONSTRAINT Classe_PK PRIMARY KEY (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb3 COLLATE = utf8mb3_general_ci;

INSERT INTO
    Developpeur
VALUES ('1', 'COVER', 'Harry'),
    ('2', 'TOUIL', 'Sacha');
