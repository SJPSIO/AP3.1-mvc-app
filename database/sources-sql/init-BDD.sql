-- script d'initialisation de la base de données pour l'application web avec les droits de l'utilisateur
DROP DATABASE IF EXISTS `mvc-app`;

CREATE DATABASE IF NOT EXISTS `mvc-app` CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP USER IF EXISTS 'app_produits_Read'@'%';

CREATE USER 'app_produits_Read'@'%' IDENTIFIED BY 'pwdAppPourProduits_R';


USE `mvc-app`;
