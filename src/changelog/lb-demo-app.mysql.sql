-- liquibase formatted changelog
-- changeset ppickerill:create-employees-table
CREATE TABLE `EMPLOYEES` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `NAME` varchar(45) DEFAULT NULL,
  `ADDRESS` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`ID`)
);

-- changeset ppickerill:add-phone-number-to-employees
ALTER TABLE sample.EMPLOYEES ADD PHONE_NUMBER varchar(100) NULL;
