
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- wf_admin_faq_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wf_admin_faq_category`;


CREATE TABLE `wf_admin_faq_category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`internal_slug` VARCHAR(30),
	PRIMARY KEY (`id`),
	KEY `wf_admin_faq_category_I_1`(`slug`),
	KEY `wf_admin_faq_category_I_2`(`internal_slug`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- wf_admin_faq
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `wf_admin_faq`;


CREATE TABLE `wf_admin_faq`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`wf_admin_faq_category_id` INTEGER,
	`title` VARCHAR(255),
	`slug` VARCHAR(255),
	`body` TEXT,
	PRIMARY KEY (`id`),
	KEY `wf_admin_faq_I_1`(`slug`),
	INDEX `wf_admin_faq_FI_1` (`wf_admin_faq_category_id`),
	CONSTRAINT `wf_admin_faq_FK_1`
		FOREIGN KEY (`wf_admin_faq_category_id`)
		REFERENCES `wf_admin_faq_category` (`id`)
		ON DELETE SET NULL
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
