
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- media_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `media_type`;


CREATE TABLE `media_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`sort_order` INTEGER,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- media_file
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `media_file`;


CREATE TABLE `media_file`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`media_type_id` INTEGER,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`filename` VARCHAR(255),
	`preview_filename` VARCHAR(255),
	`active` TINYINT default 1,
	`sort_order` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `media_file_FI_1` (`media_type_id`),
	CONSTRAINT `media_file_FK_1`
		FOREIGN KEY (`media_type_id`)
		REFERENCES `media_type` (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
