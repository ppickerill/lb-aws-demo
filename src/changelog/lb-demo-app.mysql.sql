-- liquibase formatted changelog
-- changeset ppickerill:create-employees-table
CREATE TABLE `EMPLOYEES` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(45) DEFAULT NULL,
  `ADDRESS` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`ID`)
);

-- changeset ppickerill:add-casserole-to-employees
ALTER TABLE sample.EMPLOYEES ADD FAV_CASSEROLE varchar(45) NOT NULL DEFAULT "SPACE AGE EXPERIMENTAL CASSEROLE!";

