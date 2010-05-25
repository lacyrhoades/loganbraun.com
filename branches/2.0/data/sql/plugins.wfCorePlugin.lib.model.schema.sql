
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- wf_constant
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wf_constant`;


CREATE TABLE `wf_constant`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`value` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `wf_constant_I_1`(`slug`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wf_content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wf_content`;


CREATE TABLE `wf_content`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`body` TEXT,
	`permission_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `wf_content_I_1`(`slug`),
	INDEX `wf_content_FI_1` (`permission_id`),
	CONSTRAINT `wf_content_FK_1`
		FOREIGN KEY (`permission_id`)
		REFERENCES `sf_guard_permission` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wf_contact_message
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wf_contact_message`;


CREATE TABLE `wf_contact_message`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`sent_to` VARCHAR(255),
	`name` VARCHAR(255),
	`email` VARCHAR(255),
	`phone` VARCHAR(255),
	`message` TEXT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
