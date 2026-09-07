-- script d'initialisation de la base de données pour l'application web avec les droits de l'utilisateur
DROP DATABASE IF EXISTS `tp_sio2_bdjourneeintegration`;

CREATE DATABASE IF NOT EXISTS `tp_sio2_bdjourneeintegration` CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP USER IF EXISTS 'consultSIO2Integration' @'%';

CREATE USER 'consultSIO2Integration' @'%' IDENTIFIED BY 'pwd2Consult';

GRANT
SELECT ON tp_sio2_bdjourneeintegration.* TO 'consultSIO2Integration' @'%';

USE `tp_sio2_bdjourneeintegration`;