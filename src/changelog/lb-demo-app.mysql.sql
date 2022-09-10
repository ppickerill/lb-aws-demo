-- liquibase formatted changelog
-- changeset ppickerill:add-phone-number
ALTER TABLE sample.EMPLOYEES ADD PHONE_NUMBER varchar(100) NULL;
