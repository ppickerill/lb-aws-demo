-- liquibase formatted changelog
-- changeset ppickerill:create-employees-table
CREATE TABLE `EMPLOYEES` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(45) DEFAULT NULL,
  `ADDRESS` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`ID`)
);
