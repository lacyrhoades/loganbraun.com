
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- sf_error_log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `sf_error_log`;


CREATE TABLE `sf_error_log`
(
	`type` VARCHAR(3),
	`class_name` VARCHAR(255),
	`message` TEXT,
	`module_name` VARCHAR(255),
	`action_name` VARCHAR(255),
	`exception_object` LONGTEXT,
	`request` LONGTEXT,
	`uri` VARCHAR(255),
	`created_at` DATETIME,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
