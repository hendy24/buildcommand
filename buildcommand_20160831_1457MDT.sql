#
# SQL Export
# Created by Querious (1048)
# Created: August 31, 2016 at 2:57:36 PM MDT
# Encoding: Unicode (UTF-8)
#


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


DROP TABLE IF EXISTS `user_project`;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `template`;
DROP TABLE IF EXISTS `project_type`;
DROP TABLE IF EXISTS `project_partner`;
DROP TABLE IF EXISTS `project_class_type`;
DROP TABLE IF EXISTS `project_class`;
DROP TABLE IF EXISTS `project`;
DROP TABLE IF EXISTS `pipeline`;
DROP TABLE IF EXISTS `partner`;
DROP TABLE IF EXISTS `note`;
DROP TABLE IF EXISTS `group`;
DROP TABLE IF EXISTS `estimate_detail`;
DROP TABLE IF EXISTS `estimate_item`;
DROP TABLE IF EXISTS `estimate`;
DROP TABLE IF EXISTS `company`;
DROP TABLE IF EXISTS `action`;
DROP TABLE IF EXISTS `account_speciality_link`;
DROP TABLE IF EXISTS `account_speciality`;
DROP TABLE IF EXISTS `account_type`;


CREATE TABLE `account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


CREATE TABLE `account_speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_type` (`account_type_id`),
  CONSTRAINT `fk_account_type` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `account_speciality_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT '0',
  `account_speciality_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_company_speciality` (`company_id`),
  KEY `fk_account_speciality` (`account_speciality_id`),
  CONSTRAINT `fk_account_speciality` FOREIGN KEY (`account_speciality_id`) REFERENCES `account_speciality` (`id`),
  CONSTRAINT `fk_company_speciality` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(18) NOT NULL,
  `project` int(11) DEFAULT NULL,
  `item` varchar(128) DEFAULT NULL,
  `date_due` date DEFAULT NULL,
  `complete` tinyint(1) DEFAULT '0',
  `user_created` int(11) DEFAULT '0',
  `datetime_created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_action` (`project`),
  KEY `fk_user_action_created` (`user_created`),
  CONSTRAINT `fk_project_action` FOREIGN KEY (`project`) REFERENCES `project` (`id`),
  CONSTRAINT `fk_user_action_created` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;


CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) DEFAULT NULL,
  `account_type_id` int(11) DEFAULT '0',
  `account_speciality_id` int(11) DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  `contact_name` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `license_number` varchar(128) DEFAULT NULL,
  `logo` varchar(128) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT '0',
  `user_modified` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE `estimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) NOT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `template_id` int(11) DEFAULT '0',
  `estimated_cost` decimal(13,2) DEFAULT '0.00',
  `actual_cost` decimal(13,2) DEFAULT '0.00',
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT '0',
  `user_modified` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_project` (`project_id`),
  KEY `fk_estimate_template` (`template_id`),
  CONSTRAINT `fk_estimate_template` FOREIGN KEY (`template_id`) REFERENCES `template` (`id`),
  CONSTRAINT `fk_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `estimate_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_id` int(11) DEFAULT '0',
  `partner_id` int(11) DEFAULT '0',
  `estimate_filename` varchar(128) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `estimated_cost` decimal(13,2) DEFAULT '0.00',
  `actual_cost` decimal(13,2) DEFAULT '0.00',
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT '0',
  `user_modified` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_estimate` (`estimate_id`),
  CONSTRAINT `fk_estimate` FOREIGN KEY (`estimate_id`) REFERENCES `estimate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `estimate_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_item_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_estimate_item` (`estimate_item_id`),
  CONSTRAINT `fk_estimate_item` FOREIGN KEY (`estimate_item_id`) REFERENCES `estimate_item` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(14) NOT NULL,
  `project` int(11) DEFAULT '0',
  `content` text,
  `user_created` int(11) NOT NULL DEFAULT '0',
  `user_modified` int(11) DEFAULT '0',
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;


CREATE TABLE `partner` (
  `company_id` int(11) NOT NULL DEFAULT '0',
  `builder_id` int(11) NOT NULL DEFAULT '0',
  KEY `fk_this_company` (`company_id`),
  KEY `fk_partner_company` (`builder_id`),
  CONSTRAINT `fk_partner_company` FOREIGN KEY (`builder_id`) REFERENCES `company` (`id`),
  CONSTRAINT `fk_this_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `pipeline` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) NOT NULL,
  `company_id` int(11) NOT NULL DEFAULT '0',
  `class_type_id` int(11) DEFAULT '0',
  `pipeline_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `bid_type` varchar(128) DEFAULT NULL,
  `margin` decimal(13,2) DEFAULT '0.00',
  `contingency` decimal(13,2) DEFAULT '0.00',
  `finished_sq_ft` int(11) DEFAULT '0',
  `unfinished_sq_ft` int(11) DEFAULT '0',
  `owner_email` varchar(128) DEFAULT NULL,
  `owner_phone` varchar(25) DEFAULT NULL,
  `lender_email` varchar(128) DEFAULT NULL,
  `lender_phone` varchar(25) DEFAULT NULL,
  `status` enum('Pending','Active','Completed','Lost') DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT '0',
  `user_modified` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_company` (`company_id`),
  KEY `fk_class_type` (`class_type_id`),
  CONSTRAINT `fk_class_type` FOREIGN KEY (`class_type_id`) REFERENCES `project_class_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `project_class` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE `project_class_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_class_id` int(11) unsigned NOT NULL DEFAULT '0',
  `project_type_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_class` (`project_class_id`),
  KEY `fk_type` (`project_type_id`),
  CONSTRAINT `fk_class` FOREIGN KEY (`project_class_id`) REFERENCES `project_class` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_type` FOREIGN KEY (`project_type_id`) REFERENCES `project_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;


CREATE TABLE `project_partner` (
  `project_id` int(11) NOT NULL DEFAULT '0',
  `partner_id` int(11) NOT NULL DEFAULT '0',
  KEY `fk1_project` (`project_id`),
  KEY `fk_project_partner` (`partner_id`),
  CONSTRAINT `fk1_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_project_partner` FOREIGN KEY (`partner_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `project_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE `template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  `user_created` int(11) DEFAULT '0',
  `user_modified` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_company1` (`company_id`),
  CONSTRAINT `fk_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) DEFAULT NULL,
  `company_id` int(11) DEFAULT '0',
  `group_id` int(11) DEFAULT '0',
  `last_name` varchar(128) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `terms` tinyint(1) NOT NULL DEFAULT '0',
  `privacy` tinyint(1) NOT NULL DEFAULT '0',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `datetime_created` datetime DEFAULT NULL,
  `datetime_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_company` (`company_id`),
  KEY `fk_user_group` (`group_id`),
  CONSTRAINT `fk_user_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`),
  CONSTRAINT `fk_user_group` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


CREATE TABLE `user_project` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL DEFAULT '0',
  KEY `fk_user_link` (`user_id`),
  KEY `fk_user_project` (`project_id`),
  CONSTRAINT `fk_user_link` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


SET @PREVIOUS_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS;
SET FOREIGN_KEY_CHECKS = 0;


LOCK TABLES `account_type` WRITE;
ALTER TABLE `account_type` DISABLE KEYS;
INSERT INTO `account_type` (`id`, `name`) VALUES 
	(1,'Builder'),
	(2,'Contractor'),
	(3,'Supplier'),
	(4,'Realtor'),
	(5,'Lendor');
ALTER TABLE `account_type` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `account_speciality` WRITE;
ALTER TABLE `account_speciality` DISABLE KEYS;
ALTER TABLE `account_speciality` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `account_speciality_link` WRITE;
ALTER TABLE `account_speciality_link` DISABLE KEYS;
ALTER TABLE `account_speciality_link` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `action` WRITE;
ALTER TABLE `action` DISABLE KEYS;
INSERT INTO `action` (`id`, `public_id`, `project`, `item`, `date_due`, `complete`, `user_created`, `datetime_created`) VALUES 
	(14,'gWgT9LIPgj',1,'Get deck color selection',NULL,1,4,'2016-05-10 16:16:14'),
	(22,'Qd4vKX2UKz',1,'Check on framers',NULL,1,4,'2016-05-10 16:34:57'),
	(25,'baYUEcLarH',2,'Call Don Able','2016-05-13',1,4,'2016-05-10 16:56:35'),
	(28,'GZDTLIdr4D',2,'Send message to find painter',NULL,1,4,'2016-05-10 18:17:38'),
	(30,'5pc3GKwRsJ',1,'This is a test',NULL,1,4,'2016-05-10 21:33:19'),
	(31,'8kIDBRXFqa',1,'Schedule construction door delivery','2016-05-13',1,4,'2016-05-12 13:19:26'),
	(32,'7L0alyYd6V',1,'This is a new action',NULL,1,4,'2016-05-12 15:02:18'),
	(33,'acBHtcgDYI',1,'Another',NULL,1,4,'2016-05-12 15:05:13'),
	(34,'0eLKWbUjf0',1,'Testing',NULL,1,4,'2016-05-12 15:07:41'),
	(35,'Mn2a6XiYQn',2,'Call Brian Able',NULL,1,4,'2016-05-30 14:44:45');
ALTER TABLE `action` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `company` WRITE;
ALTER TABLE `company` DISABLE KEYS;
INSERT INTO `company` (`id`, `public_id`, `account_type_id`, `account_speciality_id`, `name`, `contact_name`, `address`, `city`, `state`, `zip`, `phone`, `fax`, `email`, `license_number`, `logo`, `datetime_created`, `datetime_modified`, `user_created`, `user_modified`) VALUES 
	(1,'D9YKsyFl',1,NULL,'Timberline Building Company',NULL,'2632 SW 3 1/2 Ave.','Fruitland','ID','83619','(208) 740-3224',NULL,'info@tbcidaho.com','RCE-11353',NULL,NULL,NULL,0,0);
ALTER TABLE `company` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `estimate` WRITE;
ALTER TABLE `estimate` DISABLE KEYS;
ALTER TABLE `estimate` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `estimate_item` WRITE;
ALTER TABLE `estimate_item` DISABLE KEYS;
ALTER TABLE `estimate_item` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `estimate_detail` WRITE;
ALTER TABLE `estimate_detail` DISABLE KEYS;
ALTER TABLE `estimate_detail` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `group` WRITE;
ALTER TABLE `group` DISABLE KEYS;
INSERT INTO `group` (`id`, `name`) VALUES 
	(1,'Administrator'),
	(2,'Manager'),
	(3,'User');
ALTER TABLE `group` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `note` WRITE;
ALTER TABLE `note` DISABLE KEYS;
INSERT INTO `note` (`id`, `public_id`, `project`, `content`, `user_created`, `user_modified`, `datetime_created`, `datetime_modified`) VALUES 
	(1,'k7wvcrPwF4',1,'This is content for the test note that I just wrote',1,1,'2016-05-11 17:06:06','2016-05-11 17:06:06'),
	(16,'duY1vqQkX4',1,'Framers are working on sheeting the back of the roof. They will not be ready for fireplace installation tomorrow, but will work around the plumbers.',4,4,'2016-05-12 10:51:25','2016-05-12 11:17:19'),
	(17,'milRyWKIpa',1,'Will this note save the project correctly now?',4,4,'2016-05-12 10:54:25','2016-05-12 10:54:25'),
	(18,'FWvif2VI86',1,'New note test again.',4,4,'2016-05-12 11:23:25','2016-05-12 11:33:37'),
	(21,'tW2zxORxWX',2,'This is another test',4,4,'2016-05-12 11:42:06','2016-05-12 11:42:06'),
	(22,'Az9MryXVc4',1,'Framers are working on sheeting the back of the roof. They will not be ready for fireplace installation tomorrow, but will work around the plumbers.\n            ',4,4,'2016-05-12 13:10:32','2016-05-12 13:10:32'),
	(23,'pNAa4rrMO0',1,'            ',4,4,'2016-06-23 08:41:32','2016-06-23 08:41:32'),
	(24,'kFtbo5WY5f',3,'            ',4,4,'2016-08-17 10:15:47','2016-08-17 10:15:47');
ALTER TABLE `note` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `partner` WRITE;
ALTER TABLE `partner` DISABLE KEYS;
ALTER TABLE `partner` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `pipeline` WRITE;
ALTER TABLE `pipeline` DISABLE KEYS;
INSERT INTO `pipeline` (`id`, `name`) VALUES 
	(1,'Lead'),
	(2,'Discovery'),
	(3,'Design'),
	(4,'Estimating'),
	(5,'Complete');
ALTER TABLE `pipeline` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `project` WRITE;
ALTER TABLE `project` DISABLE KEYS;
INSERT INTO `project` (`id`, `public_id`, `company_id`, `class_type_id`, `pipeline_id`, `name`, `bid_type`, `margin`, `contingency`, `finished_sq_ft`, `unfinished_sq_ft`, `owner_email`, `owner_phone`, `lender_email`, `lender_phone`, `status`, `datetime_created`, `datetime_modified`, `user_created`, `user_modified`) VALUES 
	(1,'PwpFEpiOWI',1,3,0,'David Residence','fixed_price',0.16,0.05,2680,420,NULL,NULL,NULL,NULL,'Pending','2016-04-28 22:10:47','2016-04-28 22:10:47',4,4),
	(2,'3m0zYyoprK',1,7,NULL,'Youngberg Remodel','fixed_price',0.05,0.12,2300,0,NULL,NULL,NULL,NULL,'Pending','2016-05-10 11:44:41','2016-05-10 11:44:41',4,4),
	(3,'AKv6ou18N0',1,NULL,NULL,'Hansen Residence','cost_plus',0.10,0.06,3000,0,'jahansen84@gmail.com',NULL,NULL,NULL,'Pending','2016-08-17 10:15:03','2016-08-17 10:15:03',4,4);
ALTER TABLE `project` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `project_class` WRITE;
ALTER TABLE `project_class` DISABLE KEYS;
INSERT INTO `project_class` (`id`, `name`) VALUES 
	(1,'Commercial'),
	(2,'Residential');
ALTER TABLE `project_class` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `project_class_type` WRITE;
ALTER TABLE `project_class_type` DISABLE KEYS;
INSERT INTO `project_class_type` (`id`, `project_class_id`, `project_type_id`) VALUES 
	(3,2,1),
	(4,2,2),
	(5,2,2),
	(6,2,2),
	(7,2,2),
	(8,2,1);
ALTER TABLE `project_class_type` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `project_partner` WRITE;
ALTER TABLE `project_partner` DISABLE KEYS;
ALTER TABLE `project_partner` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `project_type` WRITE;
ALTER TABLE `project_type` DISABLE KEYS;
INSERT INTO `project_type` (`id`, `name`) VALUES 
	(1,'New Construction'),
	(2,'Remodel'),
	(3,'Addition');
ALTER TABLE `project_type` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `template` WRITE;
ALTER TABLE `template` DISABLE KEYS;
ALTER TABLE `template` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `user` WRITE;
ALTER TABLE `user` DISABLE KEYS;
INSERT INTO `user` (`id`, `public_id`, `company_id`, `group_id`, `last_name`, `first_name`, `phone`, `address`, `city`, `state`, `zip`, `email`, `password`, `terms`, `privacy`, `verified`, `datetime_created`, `datetime_modified`) VALUES 
	(4,'lcItjJcQ',1,1,'Hendershot','Kemish','(208) 250-2488','2632 SW 3 1/2 Ave.','Fruitland','ID','83619','kemish@tbcidaho.com','7ed02cc8e39a99a58915815b449bd8c7',1,1,1,'2016-04-28 20:07:38','2016-08-31 14:51:32');
ALTER TABLE `user` ENABLE KEYS;
UNLOCK TABLES;


LOCK TABLES `user_project` WRITE;
ALTER TABLE `user_project` DISABLE KEYS;
INSERT INTO `user_project` (`user_id`, `project_id`) VALUES 
	(4,1),
	(4,2),
	(4,3);
ALTER TABLE `user_project` ENABLE KEYS;
UNLOCK TABLES;




SET FOREIGN_KEY_CHECKS = @PREVIOUS_FOREIGN_KEY_CHECKS;


