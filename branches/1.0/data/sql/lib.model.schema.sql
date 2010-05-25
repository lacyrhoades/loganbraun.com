
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- video
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video`;


CREATE TABLE `video`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`description` TEXT,
	`filename` VARCHAR(255),
	`preview` VARCHAR(255),
	`video_type_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `video_FI_1` (`video_type_id`),
	CONSTRAINT `video_FK_1`
		FOREIGN KEY (`video_type_id`)
		REFERENCES `video_type` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- video_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video_type`;


CREATE TABLE `video_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`external_link` VARCHAR(255),
	`external_link_name` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- page
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `page`;


CREATE TABLE `page`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255),
	`nav_title` VARCHAR(255),
	`body` TEXT,
	`sort_order` INTEGER,
	`special_handling` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
