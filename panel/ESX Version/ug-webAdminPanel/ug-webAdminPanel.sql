CREATE DATABASE IF NOT EXISTS `ug-webAdminPanel`;
USE `ug-webAdminPanel`;

CREATE TABLE IF NOT EXISTS `users` (
    `ID` INT(55) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(155) NOT NULL,
    `password` VARCHAR(155) NOT NULL,
    PRIMARY KEY(`ID`),
    KEY(`password`)
) ENGINE=InnoDB AUTO_INCREMENT=1;

INSERT INTO `users` (username, password) VALUES
    ('admin', 'admin')
;