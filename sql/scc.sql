CREATE TABLE `id9282948_scc`.`usuario` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`nome` VARCHAR(40) NOT NULL,
	`login` VARCHAR(20) NOT NULL UNIQUE,
	`senha` VARCHAR(20) NOT NULL ,
	`email` VARCHAR(35),
	`cargo` VARCHAR(15),
	`status` VARCHAR(10) NOT NULL
) ENGINE = InnoDB;