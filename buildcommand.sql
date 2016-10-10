-- MySQL dump 10.13  Distrib 5.7.12, for osx10.11 (x86_64)
--
-- Host: localhost    Database: buildcommand
-- ------------------------------------------------------
-- Server version	5.7.12

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
-- Table structure for table `account_speciality`
--

DROP TABLE IF EXISTS `account_speciality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_speciality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_account_type` (`account_type`),
  CONSTRAINT `fk_account_type` FOREIGN KEY (`account_type`) REFERENCES `account_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_speciality`
--

LOCK TABLES `account_speciality` WRITE;
/*!40000 ALTER TABLE `account_speciality` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_speciality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_speciality_link`
--

DROP TABLE IF EXISTS `account_speciality_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_speciality_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) DEFAULT '0',
  `account_speciality` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_company_speciality` (`company`),
  KEY `fk_account_speciality` (`account_speciality`),
  CONSTRAINT `fk_account_speciality` FOREIGN KEY (`account_speciality`) REFERENCES `account_speciality` (`id`),
  CONSTRAINT `fk_company_speciality` FOREIGN KEY (`company`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_speciality_link`
--

LOCK TABLES `account_speciality_link` WRITE;
/*!40000 ALTER TABLE `account_speciality_link` DISABLE KEYS */;
/*!40000 ALTER TABLE `account_speciality_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `account_type`
--

DROP TABLE IF EXISTS `account_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_type`
--

LOCK TABLES `account_type` WRITE;
/*!40000 ALTER TABLE `account_type` DISABLE KEYS */;
INSERT INTO `account_type` VALUES (1,'Builder'),(2,'Contractor'),(3,'Supplier'),(4,'Realtor'),(5,'Lendor');
/*!40000 ALTER TABLE `account_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `action`
--

DROP TABLE IF EXISTS `action`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `action`
--

LOCK TABLES `action` WRITE;
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
INSERT INTO `action` VALUES (14,'gWgT9LIPgj',1,'Get deck color selection',NULL,1,4,'2016-05-10 16:16:14'),(22,'Qd4vKX2UKz',1,'Check on framers',NULL,1,4,'2016-05-10 16:34:57'),(25,'baYUEcLarH',2,'Call Don Able','2016-05-13',1,4,'2016-05-10 16:56:35'),(28,'GZDTLIdr4D',2,'Send message to find painter',NULL,1,4,'2016-05-10 18:17:38'),(30,'5pc3GKwRsJ',1,'This is a test',NULL,1,4,'2016-05-10 21:33:19'),(31,'8kIDBRXFqa',1,'Schedule construction door delivery','2016-05-13',1,4,'2016-05-12 13:19:26'),(32,'7L0alyYd6V',1,'This is a new action',NULL,1,4,'2016-05-12 15:02:18'),(33,'acBHtcgDYI',1,'Another',NULL,1,4,'2016-05-12 15:05:13'),(34,'0eLKWbUjf0',1,'Testing',NULL,1,4,'2016-05-12 15:07:41'),(35,'Mn2a6XiYQn',2,'Call Brian Able',NULL,1,4,'2016-05-30 14:44:45'),(36,'FsMaKteusb',7,'Follow up with Building Official on driveway',NULL,1,4,'2016-09-13 18:32:07');
/*!40000 ALTER TABLE `action` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) DEFAULT NULL,
  `account_type` int(11) DEFAULT '0',
  `account_speciality` int(11) DEFAULT '0',
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'D9YKsyFl',1,NULL,'Timberline Building Company',NULL,'2632 SW 3 1/2 Ave.','Fruitland','ID','83619','(208) 740-3224',NULL,'info@tbcidaho.com','RCE-11353',NULL,NULL,NULL,0,0);
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimate`
--

DROP TABLE IF EXISTS `estimate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL DEFAULT '0',
  `estimate_item` int(11) NOT NULL DEFAULT '0',
  `amount` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimate`
--

LOCK TABLES `estimate` WRITE;
/*!40000 ALTER TABLE `estimate` DISABLE KEYS */;
/*!40000 ALTER TABLE `estimate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimate_category`
--

DROP TABLE IF EXISTS `estimate_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimate_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pipeline` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimate_category`
--

LOCK TABLES `estimate_category` WRITE;
/*!40000 ALTER TABLE `estimate_category` DISABLE KEYS */;
INSERT INTO `estimate_category` VALUES (1,3,'General Requirements'),(2,5,'Site Work'),(3,5,'Rough Structure'),(4,5,'Doors & Windows'),(5,6,'Mechanical'),(6,6,'Exterior Finishes'),(7,6,'Interior Finishes'),(8,7,'Closing Costs'),(9,NULL,'Company Overhead & Profit');
/*!40000 ALTER TABLE `estimate_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estimate_item`
--

DROP TABLE IF EXISTS `estimate_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estimate_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estimate_category` int(11) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `bid_filename` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estimate_item`
--

LOCK TABLES `estimate_item` WRITE;
/*!40000 ALTER TABLE `estimate_item` DISABLE KEYS */;
INSERT INTO `estimate_item` VALUES (1,1,'Drawings',NULL),(2,1,'Permits & Fees',NULL),(3,1,'Construction Utilities',NULL),(4,1,'Portable Toilet',NULL),(5,1,'Insurance',NULL),(6,2,'Dirt Work',NULL),(7,2,'Drives & Approaches',NULL),(8,2,'Water & Sewer',NULL),(9,2,'Site Improvements',NULL),(10,3,'Foundation',NULL),(11,3,'Flatwork',NULL),(12,3,'Concrete Pumping',NULL),(13,3,'Rough Lumber',NULL),(14,3,'Framing Labor',NULL),(15,3,'Trusses',NULL),(16,3,'Insulation',NULL),(17,4,'Exterior Doors',NULL),(18,4,'Interior Doors',NULL),(19,4,'Overhead Doors',NULL),(20,4,'Windows',NULL),(21,5,'Plumbing',NULL),(22,5,'HVAC',NULL),(23,5,'Fireplaces',NULL),(24,5,'Electrical',NULL),(25,5,'Central Vacuum',NULL),(26,5,'Sound System',NULL),(27,6,'Roofing',NULL),(28,6,'Siding',NULL),(29,6,'Masonry & Stone Work',NULL),(30,6,'Stucco',NULL),(31,6,'Exterior Painting',NULL),(32,6,'Deck',NULL),(33,6,'Exterior Cleaning',NULL),(34,7,'Drywall',NULL),(35,7,'Finish Lumber',NULL),(36,7,'Finish Carpentry',NULL),(37,7,'Interior Painting',NULL),(38,7,'Cabinetry',NULL),(39,7,'Countertops',NULL),(40,7,'Backsplash',NULL),(41,7,'Finish Hardware',NULL),(42,7,'Tile',NULL),(43,7,'Floorcoverings',NULL),(44,7,'Mirrors',NULL),(45,7,'Interior Cleaning',NULL),(46,8,'Lot Cost',NULL),(47,8,'Appraisal',NULL),(48,8,'Title Insurance',NULL),(49,8,'Loan Interest',NULL),(50,8,'Origination Fee',NULL),(51,8,'Real Estate Fee',NULL),(52,9,'Contingency',NULL),(53,9,'Supervision',NULL),(54,9,'Overhead',NULL),(55,9,'Profit Margin',NULL),(56,9,'Initial Payment',NULL);
/*!40000 ALTER TABLE `estimate_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'Administrator'),(2,'Manager'),(3,'User');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note`
--

DROP TABLE IF EXISTS `note`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note`
--

LOCK TABLES `note` WRITE;
/*!40000 ALTER TABLE `note` DISABLE KEYS */;
INSERT INTO `note` VALUES (1,'k7wvcrPwF4',1,'This is content for the test note that I just wrote',1,1,'2016-05-11 17:06:06','2016-05-11 17:06:06'),(16,'duY1vqQkX4',1,'Framers are working on sheeting the back of the roof. They will not be ready for fireplace installation tomorrow, but will work around the plumbers.',4,4,'2016-05-12 10:51:25','2016-05-12 11:17:19'),(17,'milRyWKIpa',1,'Will this note save the project correctly now?',4,4,'2016-05-12 10:54:25','2016-05-12 10:54:25'),(18,'FWvif2VI86',1,'New note test again.',4,4,'2016-05-12 11:23:25','2016-05-12 11:33:37'),(21,'tW2zxORxWX',2,'This is another test',4,4,'2016-05-12 11:42:06','2016-05-12 11:42:06'),(22,'Az9MryXVc4',1,'Framers are working on sheeting the back of the roof. They will not be ready for fireplace installation tomorrow, but will work around the plumbers.\n            ',4,4,'2016-05-12 13:10:32','2016-05-12 13:10:32'),(23,'pNAa4rrMO0',1,'            ',4,4,'2016-06-23 08:41:32','2016-06-23 08:41:32'),(24,'kFtbo5WY5f',3,'            ',4,4,'2016-08-17 10:15:47','2016-08-17 10:15:47');
/*!40000 ALTER TABLE `note` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partner`
--

DROP TABLE IF EXISTS `partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partner` (
  `company` int(11) NOT NULL DEFAULT '0',
  `builder_id` int(11) NOT NULL DEFAULT '0',
  KEY `fk_this_company` (`company`),
  KEY `fk_partner_company` (`builder_id`),
  CONSTRAINT `fk_partner_company` FOREIGN KEY (`builder_id`) REFERENCES `company` (`id`),
  CONSTRAINT `fk_this_company` FOREIGN KEY (`company`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partner`
--

LOCK TABLES `partner` WRITE;
/*!40000 ALTER TABLE `partner` DISABLE KEYS */;
/*!40000 ALTER TABLE `partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pipeline`
--

DROP TABLE IF EXISTS `pipeline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pipeline` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pipeline`
--

LOCK TABLES `pipeline` WRITE;
/*!40000 ALTER TABLE `pipeline` DISABLE KEYS */;
INSERT INTO `pipeline` VALUES (1,'Lead'),(2,'Discovery'),(3,'Planning'),(4,'Estimating'),(5,'Exterior Construction'),(6,'Interior Construction'),(7,'Finishing Construction'),(8,'Complete');
/*!40000 ALTER TABLE `pipeline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) NOT NULL,
  `company` int(11) NOT NULL DEFAULT '0',
  `class_type` int(11) DEFAULT '0',
  `pipeline` int(11) unsigned DEFAULT NULL,
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
  KEY `fk_company` (`company`),
  KEY `fk_class_type` (`class_type`),
  CONSTRAINT `fk_company` FOREIGN KEY (`company`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'PwpFEpiOWI',1,3,0,'David Residence','fixed_price',0.16,0.05,2680,420,NULL,NULL,NULL,NULL,'Completed','2016-04-28 22:10:47','2016-08-31 17:13:33',4,4),(2,'3m0zYyoprK',1,7,NULL,'Youngberg Remodel','fixed_price',0.05,0.12,2300,0,NULL,NULL,NULL,NULL,'Completed','2016-05-10 11:44:41','2016-08-31 17:13:50',4,4),(3,'AKv6ou18N0',1,NULL,NULL,'Hansen Residence','cost_plus',0.10,0.06,3000,0,'jahansen84@gmail.com',NULL,NULL,NULL,'Completed','2016-08-17 10:15:03','2016-08-17 10:15:03',4,4),(4,'b0YPhX5Msj',1,7,NULL,'Rohrer Residence','fixed_price',0.14,0.06,2123,0,'mcrsolutionsllc@gmail.com',NULL,NULL,NULL,'Completed','2016-08-31 17:12:25','2016-08-31 17:13:46',4,4),(5,'srBUslnYdC',1,8,NULL,'Rohrer Residence','fixed_price',0.14,0.06,2123,0,'mcrsolutionsllc@gmail.com',NULL,NULL,NULL,'Completed','2016-08-31 17:12:49','2016-08-31 17:13:42',4,4),(7,'YCI9Dgvd10',1,10,NULL,'Hansen Residence','cost_plus',0.10,0.05,3024,0,NULL,NULL,NULL,NULL,'Pending','2016-08-31 17:15:25','2016-08-31 17:15:25',4,4);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_partner`
--

DROP TABLE IF EXISTS `project_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_partner` (
  `project` int(11) NOT NULL DEFAULT '0',
  `partner_id` int(11) NOT NULL DEFAULT '0',
  KEY `fk1_project` (`project`),
  KEY `fk_project_partner` (`partner_id`),
  CONSTRAINT `fk1_project` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_project_partner` FOREIGN KEY (`partner_id`) REFERENCES `company` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_partner`
--

LOCK TABLES `project_partner` WRITE;
/*!40000 ALTER TABLE `project_partner` DISABLE KEYS */;
/*!40000 ALTER TABLE `project_partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `public_id` varchar(128) DEFAULT NULL,
  `company` int(11) DEFAULT '0',
  `group` int(11) DEFAULT '0',
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
  KEY `fk_user_company` (`company`),
  KEY `fk_user_group` (`group`),
  CONSTRAINT `fk_user_company` FOREIGN KEY (`company`) REFERENCES `company` (`id`),
  CONSTRAINT `fk_user_group` FOREIGN KEY (`group`) REFERENCES `group` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'lcItjJcQ',1,1,'Hendershot','Kemish','(208) 250-2488','2632 SW 3 1/2 Ave.','Fruitland','ID','83619','kemish@tbcidaho.com','7ed02cc8e39a99a58915815b449bd8c7',1,1,1,'2016-04-28 20:07:38','2016-09-14 05:39:28');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_project`
--

DROP TABLE IF EXISTS `user_project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_project` (
  `user` int(11) NOT NULL DEFAULT '0',
  `project` int(11) NOT NULL DEFAULT '0',
  KEY `fk_user_link` (`user`),
  KEY `fk_user_project` (`project`),
  CONSTRAINT `fk_user_link` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_project` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_project`
--

LOCK TABLES `user_project` WRITE;
/*!40000 ALTER TABLE `user_project` DISABLE KEYS */;
INSERT INTO `user_project` VALUES (4,1),(4,2),(4,3),(4,4),(4,5),(4,7);
/*!40000 ALTER TABLE `user_project` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-05 19:46:58
