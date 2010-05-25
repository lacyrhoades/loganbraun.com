
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- wf_page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wf_page`;


CREATE TABLE `wf_page`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`internal_slug` VARCHAR(50),
	`body` TEXT,
	`sort_order` INTEGER,
	`custom_module` VARCHAR(100),
	`custom_action` VARCHAR(100),
	`is_homepage` TINYINT default 0,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
