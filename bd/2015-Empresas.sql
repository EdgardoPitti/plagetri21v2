CREATE TABLE `plagetri21`.`empresas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `descripcion` TEXT NULL,
  `created_at` VARCHAR(45) NULL,
  `updated_at` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


INSERT INTO `plagetri21`.`modulos` (`id`, `modulo`, `ruta`, `imagen`) VALUES ('10', 'Empresas', 'datos.empresas.index', 'empresa.png');

ALTER TABLE `plagetri21`.`empresas` 
ADD COLUMN `ruc` VARCHAR(45) NULL AFTER `nombre`;

