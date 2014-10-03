#
# Database : `rpg`
# 
CREATE DATABASE `rpg`;
USE rpg;

--
-- Table structure for table `levels`
--

DROP TABLE IF EXISTS `levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `levels` (
  `name` varchar(30) NOT NULL DEFAULT '',
  `username` varchar(30) NOT NULL DEFAULT '',
  `popularity` varchar(10) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `rating` char(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`name`),
  KEY `popularity` (`popularity`,`rating`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `levels`
--

LOCK TABLES `levels` WRITE;
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
INSERT INTO `levels` VALUES ('level','test','1','[default level]','100'),('MAP_test','test','1','User-made RPG map','50'),('MAP_test111','test','1','User-made RPG map','50');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map` (
  `username` varchar(30) NOT NULL DEFAULT '',
  `levelname` varchar(30) NOT NULL DEFAULT 'level',
  `fight` char(1) NOT NULL DEFAULT 'n',
  `xpos` smallint(6) NOT NULL DEFAULT '0',
  `ypos` smallint(6) NOT NULL DEFAULT '0',
  `kills` text NOT NULL,
  `hp` varchar(10) NOT NULL DEFAULT '',
  `def` varchar(10) NOT NULL DEFAULT '',
  `acc` char(3) NOT NULL DEFAULT '',
  `atk` varchar(10) NOT NULL DEFAULT '',
  `spd` varchar(10) NOT NULL DEFAULT '',
  `avitar` text NOT NULL,
  `exp` varchar(10) NOT NULL DEFAULT '',
  `lastpos` varchar(20) NOT NULL DEFAULT 'mofo',
  PRIMARY KEY (`username`,`levelname`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
INSERT INTO `map` VALUES ('test','level','n',7,8,'','5','1','1','1','1','models/bug_laugh.gif','','mofo'),('test','MAP_test','n',4,5,'','5','1','1','1','1','models/bug_laugh.gif','','mofo');
/*!40000 ALTER TABLE `map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rpg_fights`
--

DROP TABLE IF EXISTS `rpg_fights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_fights` (
  `fightID` varchar(50) NOT NULL DEFAULT '',
  `stance` char(1) NOT NULL DEFAULT '3',
  `log` text NOT NULL,
  `turn` varchar(20) NOT NULL DEFAULT '',
  `d_p` varchar(9) NOT NULL DEFAULT '0',
  `d_x` varchar(9) NOT NULL DEFAULT '0',
  `d_f` varchar(9) NOT NULL DEFAULT '0',
  `d_e` varchar(9) NOT NULL DEFAULT '0',
  `d_c` varchar(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fightID`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rpg_fights`
--

LOCK TABLES `rpg_fights` WRITE;
/*!40000 ALTER TABLE `rpg_fights` DISABLE KEYS */;
/*!40000 ALTER TABLE `rpg_fights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rpg_inventory`
--

DROP TABLE IF EXISTS `rpg_inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_inventory` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `s_1` varchar(9) NOT NULL DEFAULT '0',
  `s_2` varchar(9) NOT NULL DEFAULT '0',
  `s_3` varchar(9) NOT NULL DEFAULT '0',
  `s_4` varchar(9) NOT NULL DEFAULT '0',
  `s_5` varchar(9) NOT NULL DEFAULT '0',
  `s_6` varchar(9) NOT NULL DEFAULT '0',
  `s_7` varchar(9) NOT NULL DEFAULT '0',
  `s_8` varchar(9) NOT NULL DEFAULT '0',
  `s_9` varchar(9) NOT NULL DEFAULT '0',
  `s_10` varchar(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rpg_inventory`
--

LOCK TABLES `rpg_inventory` WRITE;
/*!40000 ALTER TABLE `rpg_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `rpg_inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rpg_items`
--

DROP TABLE IF EXISTS `rpg_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rpg_items` (
  `identifiername` varchar(20) NOT NULL DEFAULT '',
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `type` char(1) NOT NULL DEFAULT '1',
  `heal` varchar(9) NOT NULL DEFAULT '0',
  `i_p` varchar(9) NOT NULL DEFAULT '0',
  `i_x` varchar(9) NOT NULL DEFAULT '0',
  `i_f` varchar(9) NOT NULL DEFAULT '0',
  `i_e` varchar(9) NOT NULL DEFAULT '0',
  `i_c` varchar(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `identifiername` (`identifiername`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='PphysicalXelementalFfireEelectricCchemical1wpn2shield3potion';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rpg_items`
--

LOCK TABLES `rpg_items` WRITE;
/*!40000 ALTER TABLE `rpg_items` DISABLE KEYS */;
INSERT INTO `rpg_items` VALUES ('Knife',1,'Cuts meat nicely. ;)','1','0','1','0','0','0','0'),('Wooden Shield',2,'Will block 1 physical icons of damage.','2','0','1','0','0','0','0'),('Potion',3,'Heals 100HP','3','100','0','0','0','0','0'),('Poisoned Knife',4,'When this Knife was created, something bizarre happened. Thanks to the power of bad manufacturing standards, it has the power to magically inflict your opponents with poison damge!','1','0','1','0','0','0','1');
/*!40000 ALTER TABLE `rpg_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL DEFAULT '',
  `avitar` text NOT NULL,
  `levelname` varchar(30) NOT NULL DEFAULT 'level',
  `email` text NOT NULL,
  `validated` char(1) NOT NULL DEFAULT 'n',
  `created` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`username`)
)  COMMENT='the user''s data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('test','test','models/bug_laugh.gif','MAP_test','idiotproof@paradise.net.nz','y','1000000000');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-03 15:02:22
