-- script d'initialisation de la base de données pour l'application web avec les droits de l'utilisateur
DROP DATABASE IF EXISTS `mvc_app`;

CREATE DATABASE IF NOT EXISTS `mvc_app` CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP USER IF EXISTS 'WebMvcApp'@'%';
CREATE USER 'WebMvcApp'@'%' IDENTIFIED BY 'pwd2WebMvcApp';
USE `mvc_app`;
