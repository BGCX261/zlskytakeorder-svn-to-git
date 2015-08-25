-- MySQL dump 10.11
--
-- Host: localhost    Database: socket
-- ------------------------------------------------------
-- Server version	5.0.45-community-nt

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
-- Table structure for table `socket_chn_initial_info`
--

DROP TABLE IF EXISTS `socket_chn_initial_info`;
CREATE TABLE `socket_chn_initial_info` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `dev_no` varchar(20) NOT NULL default '',
  `chn` char(1) NOT NULL default '1',
  `chnshort` char(10) NOT NULL default '',
  `apid` char(4) default NULL,
  `prgname` char(20) default NULL,
  `agcstat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  `gain` char(2) default NULL COMMENT '范围-3~+9',
  `mutestat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  `passstat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_chn_initial_info`
--

LOCK TABLES `socket_chn_initial_info` WRITE;
/*!40000 ALTER TABLE `socket_chn_initial_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_chn_initial_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_chninfo`
--

DROP TABLE IF EXISTS `socket_chninfo`;
CREATE TABLE `socket_chninfo` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `dev_no` int(10) NOT NULL,
  `chn` char(1) NOT NULL default '1',
  `chnshort` char(10) NOT NULL,
  `apid` char(4) default NULL,
  `prgname` char(20) default NULL,
  `agcstat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  `gain` char(2) default NULL COMMENT '范围-3~+9',
  `mutestat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  `passstat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_chninfo`
--

LOCK TABLES `socket_chninfo` WRITE;
/*!40000 ALTER TABLE `socket_chninfo` DISABLE KEYS */;
INSERT INTO `socket_chninfo` VALUES (25,6,'1','TSAGCX','5545','广东卫视','C','2','O','O'),(26,6,'2','TSAGCX','5545','2','C','2','O','O'),(27,6,'3','TSAGCX','5545','3','C','2','O','O'),(28,6,'4','TSAGCX','5545','4','C','2','O','O'),(29,6,'5','TSAGCX','5545','5','C','2','O','O'),(30,6,'6','TSAGCX','5545','6','C','2','O','O'),(31,6,'7','TSAGCX','5545','7','C','2','O','O'),(32,6,'8','TSAGCX','5545','8','C','2','O','O'),(33,7,'1','TSAGCX','5545','1','C','2','O','O'),(34,7,'2','TSAGCX','5545','2','C','2','O','O'),(35,7,'3','TSAGCX','5545','3','C','2','O','O'),(36,7,'4','TSAGCX','5545','4','C','2','O','O'),(37,7,'5','TSAGCX','5545','5','C','2','O','O'),(38,7,'6','TSAGCX','5545','6','C','2','O','O'),(39,7,'7','TSAGCX','5545','7','C','2','O','O'),(40,7,'8','TSAGCX','5545','8','C','2','O','O');
/*!40000 ALTER TABLE `socket_chninfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_dev_initial_info`
--

DROP TABLE IF EXISTS `socket_dev_initial_info`;
CREATE TABLE `socket_dev_initial_info` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `ipaddr` char(15) NOT NULL default '',
  `ipport` char(5) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_dev_initial_info`
--

LOCK TABLES `socket_dev_initial_info` WRITE;
/*!40000 ALTER TABLE `socket_dev_initial_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_dev_initial_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_dev_schedule`
--

DROP TABLE IF EXISTS `socket_dev_schedule`;
CREATE TABLE `socket_dev_schedule` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `prgname` varchar(100) NOT NULL default '1',
  `schedule` char(8) NOT NULL default '',
  `gain` char(2) NOT NULL default '' COMMENT '范围-3~+9',
  `schedule_desc` text,
  `update_date` char(20) NOT NULL default '0',
  `chnserial` char(20) NOT NULL default '',
  `run_type` char(1) NOT NULL default '0' COMMENT '0,单个频道，1.整个设备',
  `kind` char(1) NOT NULL default '0' COMMENT '0.每天，1.每周，2.每月，3.每年',
  `which_day` varchar(3) NOT NULL default '' COMMENT '第几天，如周：则为1-7',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_dev_schedule`
--

LOCK TABLES `socket_dev_schedule` WRITE;
/*!40000 ALTER TABLE `socket_dev_schedule` DISABLE KEYS */;
INSERT INTO `socket_dev_schedule` VALUES (1,'广东卫视','16:30','-2','sdf','0','25','0','0','');
/*!40000 ALTER TABLE `socket_dev_schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_devinfo`
--

DROP TABLE IF EXISTS `socket_devinfo`;
CREATE TABLE `socket_devinfo` (
  `serial` int(11) NOT NULL auto_increment,
  `ipaddr` char(15) NOT NULL default '',
  `ipport` char(5) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_devinfo`
--

LOCK TABLES `socket_devinfo` WRITE;
/*!40000 ALTER TABLE `socket_devinfo` DISABLE KEYS */;
INSERT INTO `socket_devinfo` VALUES (6,'192.168.1.5','1000','zlsky'),(7,'192.168.1.5','1000','zlfly');
/*!40000 ALTER TABLE `socket_devinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_operatorlog`
--

DROP TABLE IF EXISTS `socket_operatorlog`;
CREATE TABLE `socket_operatorlog` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `name` char(8) NOT NULL default '',
  `time` char(12) NOT NULL,
  `devname` char(20) NOT NULL default '',
  `ipaddr` char(15) NOT NULL default '',
  `operask` char(50) NOT NULL default '',
  `operasw` char(100) default NULL,
  `run_type` char(1) NOT NULL default '0' COMMENT '0.手动，1.自动',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_operatorlog`
--

LOCK TABLES `socket_operatorlog` WRITE;
/*!40000 ALTER TABLE `socket_operatorlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `socket_operatorlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_org`
--

DROP TABLE IF EXISTS `socket_org`;
CREATE TABLE `socket_org` (
  `org_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `no` varchar(50) NOT NULL default '',
  `des` text,
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`org_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_org`
--

LOCK TABLES `socket_org` WRITE;
/*!40000 ALTER TABLE `socket_org` DISABLE KEYS */;
INSERT INTO `socket_org` VALUES (1,'产品维护部','001','产品维护部',1244100882,1252485154);
/*!40000 ALTER TABLE `socket_org` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_roles`
--

DROP TABLE IF EXISTS `socket_roles`;
CREATE TABLE `socket_roles` (
  `role_id` int(10) unsigned NOT NULL auto_increment,
  `rolename` varchar(32) NOT NULL default '',
  `roledes` varchar(32) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_roles`
--

LOCK TABLES `socket_roles` WRITE;
/*!40000 ALTER TABLE `socket_roles` DISABLE KEYS */;
INSERT INTO `socket_roles` VALUES (1,'sysadmin','系统管理员',1215239222,1215239222),(4,'main','管理员',1254106499,1254106499),(5,'operate','操作员',1254106515,1254106515),(6,'infomonitor','信息监控',1254993088,1254993088);
/*!40000 ALTER TABLE `socket_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_rose`
--

DROP TABLE IF EXISTS `socket_rose`;
CREATE TABLE `socket_rose` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_rose`
--

LOCK TABLES `socket_rose` WRITE;
/*!40000 ALTER TABLE `socket_rose` DISABLE KEYS */;
INSERT INTO `socket_rose` VALUES (1,1),(2,4),(3,5),(4,6),(5,5);
/*!40000 ALTER TABLE `socket_rose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socket_user`
--

DROP TABLE IF EXISTS `socket_user`;
CREATE TABLE `socket_user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `tname` varchar(20) NOT NULL default '',
  `session_id` varchar(11) NOT NULL default '0',
  `org_id` int(10) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `socket_user`
--

LOCK TABLES `socket_user` WRITE;
/*!40000 ALTER TABLE `socket_user` DISABLE KEYS */;
INSERT INTO `socket_user` VALUES (1,'admin','0b7dab01503c10f96ecedad1972ebaad','','admin','0',1,0,1257236090),(2,'main','fad58de7366495db4650cfefac2fcd61','main@da.com','管理员','9372680',1,1254103783,1262144352),(3,'man','39c63ddb96a31b9610cd976b896ad4f0','man@da.com','操作员','0',1,1254106328,1254106533),(4,'monitor','e10adc3949ba59abbe56e057f20f883e','ss@fd.com','信息监控员','0',1,1254993374,1255144081),(5,'robin','098f6bcd4621d373cade4e832627b4f6','robin@socket.com','robin huang','0',1,1262144378,1262144378);
/*!40000 ALTER TABLE `socket_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-01-11  2:27:41
