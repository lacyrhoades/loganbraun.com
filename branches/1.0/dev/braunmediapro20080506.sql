-- MySQL dump 10.11
--
-- Host: localhost    Database: projects_braun_braunmediapro
-- ------------------------------------------------------
-- Server version	5.0.45-Debian_1ubuntu3-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) default NULL,
  `nav_title` varchar(255) NOT NULL default '',
  `body` text,
  `sort_order` int(11) NOT NULL default '0',
  `special_handling` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (3,'Event Recording','Event<br/>Recording','<div class=\"right\">\r\n<img src=\"/images/event1.jpg\" class=\"floatl\"  style=\"padding: 43px 0 0 20px;\"/>\r\n<img src=\"/images/event2.jpg\" class=\"floatl\" style=\"padding: 0 0 0 35px;\"/>\r\n<img src=\"/images/event3.jpg\" class=\"floatl clear\" style=\"padding-left: 20px;\" />\r\n<h1 style=\"padding-top: 43px; margin-top: 0;\">Sporting Events</h1>\r\n<h1>Weddings</h1>\r\n<h1>Dance Recitals</h1>\r\n<h1>Corporate</h1>\r\n<h1>ENG/Documentaries</h1>\r\n<h1>Theatricals</h1>\r\n<h1>Documenting Property</h1>\r\n</div>\r\n\r\n<div class=\"pricing\">\r\n<h4>Pricing</h4>\r\n<ul>\r\n<li>$50/hour - Camera & Operator</li>\r\n<li>$10 per video tape</li>\r\n<li>$35/hour for timeline editing</li>\r\n<li>$7 per DVD</li>\r\n<ul>\r\n</div>',1,''),(4,'Photo & Video Montage','Photo &<br/>Video Montage','<h1 class=\"center\">Pick out old family photos and/or video clips for fun montages for special events:</h1>\r\n\r\n<div class=\"left\" style=\"padding-left: 30px;\">\r\n  <a href=\"/uploads/video/70EPV for BMP website.mov\">\r\n    <img src=\"/php/phpThumb.php?src=/uploads/preview/39Picture%2083%20copy.jpg&w=300\" class=\"floatr\" alt=\"click to view video\" />\r\n  </a>\r\n  <h3>High School Graduation Party</h3>\r\n  <h3>Weddings</h3>\r\n  <h3>Anniversaries</h3>\r\n  <h3>Mother\'s / Father\'s Day</h3>\r\n  <h3>Birthdays</h3>\r\n  <h3>Valentines Day</h3>\r\n</div>\r\n\r\n<div class=\"pricing\">\r\n  <h4>Pricing</h4>\r\n  <ul>\r\n    <li>\r\n      Digitizing Video Clips from Video Tapes for timeline editing  \r\n<li> $10 per 15 minutes of tape</li>\r\n      <ul>\r\n        <li>$7 per DVD</li>\r\n      </ul>\r\n    </li>\r\n<li> </li>\r\n    <li>\r\n    Picture Transfer:\r\n      <ul>\r\n        <li>$1.50 per scanned picture [4x6]</li>\r\n        <li>    - includes automatic color correction and minor spot & dust removal</li>\r\n      </ul>\r\n    </li>\r\n  </ul>\r\n</div>',3,''),(5,'Digital Reproduction','Digital<br/>Reproduction','<div id=\"dig_repo\"></div>\r\n\r\n<div class=\"pricing\">\r\n  <h4>Pricing</h4>\r\n  <ul>\r\n    <li>\r\n      Video Transfer:\r\n      <ul>\r\n        <li>$8 per 30 minutes of Tape</li>\r\n        <li>$7 per DVD</li>\r\n      </ul>\r\n    </li>\r\n\r\n    <li>Picture Transfer:\r\n      <ul>\r\n        <li>$1.50 per picture (4x6)</li>\r\n        <li>    - includes automatic color correction and minor spot & dust removal.</li>\r\n        <li>$2 per CD</li>\r\n        <li>$7 per DVD</li>\r\n      </ul>\r\n    </li>\r\n  </ul>\r\n</div>',2,''),(6,'Contact Information','Contact<br/>Information','<div class=\"contact_stuff\">\r\n  <div>\r\n    <a href=\"/uploads/custom/loganbraunresume41308v1.pdf\">\r\n      <img src=\"/uploads/custom/loganbraunpreview41308v2.jpg\" />\r\n    </a>\r\n  </div>\r\n  <div style=\"width: 400px;margin-top:10px;\">\r\n    <h1>resume</h1>\r\n    (right click and choose save target as to download)\r\n  </div>\r\n  <div class=\"clear\" style=\"float:none;\"></div>\r\n</div>\r\n\r\n\r\n\r\n<div class=\"contact_stuff\">\r\n  <div>\r\n    <a href=\"/uploads/custom/Logan Braun Let of Rec March08.pdf\">\r\n      <img src=\"/uploads/custom/LETTER_OF_REC_2.22.jpg\" />\r\n    </a>\r\n  </div>\r\n  <div style=\"width: 400px;margin-top:10px;\">\r\n    <h1>letter of recommendation</h1>\r\n    (right click and choose save target as to download)\r\n  </div>\r\n  <div class=\"clear\" style=\"float:none;\"></div>\r\n</div>',5,''),(7,'Sample Work','Sample<br/>Work','my sample work',4,'video');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE `video` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL default '',
  `preview` varchar(255) NOT NULL default '',
  `front_page` int(11) NOT NULL default '0',
  `video_type_id` int(11) NOT NULL default '0',
  `include_on_sample` int(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
INSERT INTO `video` VALUES (52,'Evan Picture Video','','70EPV for BMP website.mov','39Picture 83 copy.jpg',0,1,0),(45,'_My Demo Reel_','','38demo reel_c.mov','478a5e03d995a20cd828045c98bee63f.jpg',0,1,1),(46,'Key West Graphic Design','','14keywest.jpg','92keywest.jpg',0,2,1),(54,'Three Logan\'s working hard for you','','84IMG_0144-copy-for-bmp-website.jpg','31IMG_0144-copy1.jpg',0,2,1),(55,'Alternative Braun Media Logo 1','','91new text logo copy.jpg','8new-text-logo-copy.jpg',0,2,1),(56,'Alternative Braun Media Logo 2','','11braunmedia logo.jpg','19braunmedia-logo.jpg',0,2,1),(57,'Alternative Braun Media Logo 3','','62braun logo 2 _1.jpg','48braun-logo-2-_1.jpg',0,2,1),(58,'Alternative Contemporary Media Logo 1','','76cmw logo for braun media website.jpg','44cmw-logo-for-braun-media-website.jpg',0,2,1),(59,'Fun Couples Poster','','44Carrie Poster copy.jpg','66Carrie-Poster-copy.jpg',0,2,1),(61,'editing/graphics sample','','45sample-4:3-H.264 800Kbps.mov','88magnum sample.jpg',0,1,1),(62,'magnUM Indoor Highlight Video 2008','','32indoorSV3FILM large dnld2.mov','50magnum-indoor-08-test_better.jpg',0,1,1),(63,'Corporate Video','','77fx video for website-16x9-for website for 16x9.mov','6gail and rice logo.png',0,1,1),(64,'motion Bogglemania','','81fx video for website-4x3-bmp website.mov','63boggle title for website.jpg',0,1,1);
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_type`
--

DROP TABLE IF EXISTS `video_type`;
CREATE TABLE `video_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) default NULL,
  `external_link` varchar(255) default NULL,
  `external_link_name` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video_type`
--

LOCK TABLES `video_type` WRITE;
/*!40000 ALTER TABLE `video_type` DISABLE KEYS */;
INSERT INTO `video_type` VALUES (1,'videos','http://www.apple.com/quicktime/download/','Download Apple Quicktime Player'),(2,'graphics','','');
/*!40000 ALTER TABLE `video_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2008-05-06 11:34:30
