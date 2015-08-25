-- MySQL dump 10.11
--
-- Host: localhost    Database: ticket
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
-- Table structure for table `ticket_airlineinfo`
--

DROP TABLE IF EXISTS `ticket_airlineinfo`;
CREATE TABLE `ticket_airlineinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `comp_no` char(2) NOT NULL default '' COMMENT '航空公司代码',
  `comp_name` varchar(50) NOT NULL default '' COMMENT '航空公司名称',
  `office` varchar(50) NOT NULL default '' COMMENT 'office',
  `comp_type` char(1) NOT NULL default '1' COMMENT '航空公司类型:1.国内，2.国际',
  `is_autoticket` char(1) NOT NULL default '1' COMMENT '是否自动出票:0.否，1.是',
  `comp_ico` varchar(50) NOT NULL default '' COMMENT '航空公司图标',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='航空公司信息';

--
-- Dumping data for table `ticket_airlineinfo`
--

LOCK TABLES `ticket_airlineinfo` WRITE;
/*!40000 ALTER TABLE `ticket_airlineinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_airlineinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_area`
--

DROP TABLE IF EXISTS `ticket_area`;
CREATE TABLE `ticket_area` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `name` varchar(50) NOT NULL default '' COMMENT '地区名称',
  `ico` varchar(100) NOT NULL default '' COMMENT '地区图标',
  `seq_id` int(10) unsigned NOT NULL default '0' COMMENT '显示顺序',
  `display_status` char(1) NOT NULL default '0' COMMENT '显示状态：0.不显示，1.显示',
  `area_desc` text,
  `parent_id` int(10) unsigned NOT NULL default '0' COMMENT '所属ID',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='地区管理';

--
-- Dumping data for table `ticket_area`
--

LOCK TABLES `ticket_area` WRITE;
/*!40000 ALTER TABLE `ticket_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_area` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_arrivecity`
--

DROP TABLE IF EXISTS `ticket_arrivecity`;
CREATE TABLE `ticket_arrivecity` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `city_no` char(3) NOT NULL default '' COMMENT '城市编码',
  `continent` varchar(50) NOT NULL default '' COMMENT '洲',
  `country` varchar(50) NOT NULL default '' COMMENT '国家',
  `city_name` varchar(50) NOT NULL default '' COMMENT '城市名称',
  `city_spell` varchar(50) NOT NULL default '' COMMENT '城市拼音',
  `airport_name` varchar(50) NOT NULL default '1' COMMENT '机场名称',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='国际到达城市';

--
-- Dumping data for table `ticket_arrivecity`
--

LOCK TABLES `ticket_arrivecity` WRITE;
/*!40000 ALTER TABLE `ticket_arrivecity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_arrivecity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_baseinfo`
--

DROP TABLE IF EXISTS `ticket_baseinfo`;
CREATE TABLE `ticket_baseinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `air_company` varchar(100) NOT NULL default '' COMMENT '机票信息表',
  `airline_no` varchar(20) NOT NULL default '' COMMENT '航班号',
  `plane_model` varchar(20) NOT NULL default '' COMMENT '机型',
  `airport_name` varchar(50) NOT NULL default '1' COMMENT '机场名称',
  `arrive_city` varchar(50) NOT NULL default '' COMMENT '到达城市',
  `fly_date` int(10) unsigned NOT NULL default '0' COMMENT '航班日期',
  `fly_time` varchar(8) NOT NULL default '' COMMENT '起飞时间',
  `arrive_time` varchar(20) NOT NULL default '' COMMENT '到达时间',
  `airport_fee` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '机场费',
  `fuel_fee` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '燃油费',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='国际到达城市';

--
-- Dumping data for table `ticket_baseinfo`
--

LOCK TABLES `ticket_baseinfo` WRITE;
/*!40000 ALTER TABLE `ticket_baseinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_baseinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_berthdiscountinfo`
--

DROP TABLE IF EXISTS `ticket_berthdiscountinfo`;
CREATE TABLE `ticket_berthdiscountinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `comp_no` char(2) NOT NULL default '' COMMENT '航空公司代码',
  `start_city_no` char(3) NOT NULL default '' COMMENT '舱位代码',
  `arrive_city_no` char(3) NOT NULL default '' COMMENT '到达城市代码',
  `berth_no` varchar(5) NOT NULL default '' COMMENT '舱位代码',
  `discount_name` varchar(50) NOT NULL default '' COMMENT '折扣名称',
  `discount_rate` decimal(6,3) unsigned NOT NULL default '0.000' COMMENT '折扣率',
  `berth_remark` text COMMENT '备注',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='舱位折扣信息';

--
-- Dumping data for table `ticket_berthdiscountinfo`
--

LOCK TABLES `ticket_berthdiscountinfo` WRITE;
/*!40000 ALTER TABLE `ticket_berthdiscountinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_berthdiscountinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_berthinfo`
--

DROP TABLE IF EXISTS `ticket_berthinfo`;
CREATE TABLE `ticket_berthinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `comp_no` char(2) NOT NULL default '' COMMENT '航空公司代码',
  `berth_no` varchar(5) NOT NULL default '' COMMENT '舱位代码',
  `discount_name` varchar(50) NOT NULL default '' COMMENT '折扣名称',
  `discount_rate` decimal(6,3) unsigned NOT NULL default '0.000' COMMENT '折扣率',
  `ei` varchar(50) NOT NULL default '' COMMENT '折扣名称',
  `sign_desc` text COMMENT '签改退规定',
  `berth_remark` text COMMENT '备注',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='舱位信息';

--
-- Dumping data for table `ticket_berthinfo`
--

LOCK TABLES `ticket_berthinfo` WRITE;
/*!40000 ALTER TABLE `ticket_berthinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_berthinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_buildprice`
--

DROP TABLE IF EXISTS `ticket_buildprice`;
CREATE TABLE `ticket_buildprice` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `adult_price` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '成人大型机价格',
  `adult_micprice` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '成人小型机价格',
  `kid_price` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '小孩大型机价格',
  `kid_micprice` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '小孩小型机价格',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机场建设费信息';

--
-- Dumping data for table `ticket_buildprice`
--

LOCK TABLES `ticket_buildprice` WRITE;
/*!40000 ALTER TABLE `ticket_buildprice` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_buildprice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_dbbackup`
--

DROP TABLE IF EXISTS `ticket_dbbackup`;
CREATE TABLE `ticket_dbbackup` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `backup_type` char(1) NOT NULL default '1' COMMENT '备份类型:0.自动备份，1.手动备份',
  `backup_user` varchar(50) NOT NULL default '' COMMENT '备份人',
  `backup_time` int(10) unsigned NOT NULL default '0' COMMENT '备份时间',
  `backup_remark` text COMMENT '备注',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='数据库备份';

--
-- Dumping data for table `ticket_dbbackup`
--

LOCK TABLES `ticket_dbbackup` WRITE;
/*!40000 ALTER TABLE `ticket_dbbackup` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_dbbackup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_front_group`
--

DROP TABLE IF EXISTS `ticket_front_group`;
CREATE TABLE `ticket_front_group` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `name` varchar(100) NOT NULL default '',
  `no` varchar(50) NOT NULL default '',
  `des` text,
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分组表';

--
-- Dumping data for table `ticket_front_group`
--

LOCK TABLES `ticket_front_group` WRITE;
/*!40000 ALTER TABLE `ticket_front_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_front_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_front_menu`
--

DROP TABLE IF EXISTS `ticket_front_menu`;
CREATE TABLE `ticket_front_menu` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `name` varchar(100) NOT NULL default '',
  `http_page` varchar(100) NOT NULL default '' COMMENT 'http页面',
  `parent_id` int(10) unsigned NOT NULL default '0' COMMENT '所属ID',
  `opt_time` int(10) unsigned NOT NULL default '0' COMMENT '操作时间',
  `status` char(1) NOT NULL default '1' COMMENT '状态：0.无效，1.有效',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台导航菜单表';

--
-- Dumping data for table `ticket_front_menu`
--

LOCK TABLES `ticket_front_menu` WRITE;
/*!40000 ALTER TABLE `ticket_front_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_front_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_front_privileges`
--

DROP TABLE IF EXISTS `ticket_front_privileges`;
CREATE TABLE `ticket_front_privileges` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `role_id` int(10) unsigned NOT NULL default '0' COMMENT '角色ID',
  `menu_id` int(10) unsigned NOT NULL default '0' COMMENT '导航菜单ID',
  `is_grantable` enum('N','Y') NOT NULL default 'N' COMMENT '是否有权',
  `opt_time` int(10) unsigned NOT NULL default '0' COMMENT '操作时间',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台权限表';

--
-- Dumping data for table `ticket_front_privileges`
--

LOCK TABLES `ticket_front_privileges` WRITE;
/*!40000 ALTER TABLE `ticket_front_privileges` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_front_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_front_roles`
--

DROP TABLE IF EXISTS `ticket_front_roles`;
CREATE TABLE `ticket_front_roles` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `rolename` varchar(32) NOT NULL default '',
  `roledes` varchar(32) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  `status` char(1) NOT NULL default '1' COMMENT '状态:0.无效，1.有效。',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='前台角色表';

--
-- Dumping data for table `ticket_front_roles`
--

LOCK TABLES `ticket_front_roles` WRITE;
/*!40000 ALTER TABLE `ticket_front_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_front_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_front_rose`
--

DROP TABLE IF EXISTS `ticket_front_rose`;
CREATE TABLE `ticket_front_rose` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_front_rose`
--

LOCK TABLES `ticket_front_rose` WRITE;
/*!40000 ALTER TABLE `ticket_front_rose` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_front_rose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_fuelinfo`
--

DROP TABLE IF EXISTS `ticket_fuelinfo`;
CREATE TABLE `ticket_fuelinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `kilometre_count` varchar(50) NOT NULL default '' COMMENT '公里数',
  `fuel_tax` decimal(6,2) unsigned NOT NULL default '0.00' COMMENT '燃油税',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='燃油税信息';

--
-- Dumping data for table `ticket_fuelinfo`
--

LOCK TABLES `ticket_fuelinfo` WRITE;
/*!40000 ALTER TABLE `ticket_fuelinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_fuelinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_inlandcity`
--

DROP TABLE IF EXISTS `ticket_inlandcity`;
CREATE TABLE `ticket_inlandcity` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `city_no` char(3) NOT NULL default '' COMMENT '城市编码',
  `city_name` varchar(50) NOT NULL default '' COMMENT '城市名称',
  `city_spell` varchar(50) NOT NULL default '' COMMENT '城市拼音',
  `airport_name` varchar(50) NOT NULL default '1' COMMENT '机场名称',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='国内城市信息';

--
-- Dumping data for table `ticket_inlandcity`
--

LOCK TABLES `ticket_inlandcity` WRITE;
/*!40000 ALTER TABLE `ticket_inlandcity` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_inlandcity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_interfaceinfo`
--

DROP TABLE IF EXISTS `ticket_interfaceinfo`;
CREATE TABLE `ticket_interfaceinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `account_name` varchar(50) NOT NULL default '' COMMENT '账号名',
  `username` varchar(50) NOT NULL default '' COMMENT '用户中文名',
  `password` varchar(50) NOT NULL default '' COMMENT '密码',
  `ip_address` varchar(20) NOT NULL default '' COMMENT '密码',
  `start_time` int(10) unsigned NOT NULL default '0' COMMENT '账号启用时间',
  `end_time` int(10) unsigned NOT NULL default '0' COMMENT '账号启用时间',
  `status` char(1) NOT NULL default '0' COMMENT '用户状态：0.审核中，1.活动，2.冻结，3.删除',
  `interface_remark` text COMMENT '备注',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='接口账号信息';

--
-- Dumping data for table `ticket_interfaceinfo`
--

LOCK TABLES `ticket_interfaceinfo` WRITE;
/*!40000 ALTER TABLE `ticket_interfaceinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_interfaceinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_member`
--

DROP TABLE IF EXISTS `ticket_member`;
CREATE TABLE `ticket_member` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增id',
  `province_id` int(10) unsigned NOT NULL default '0' COMMENT '参赛个人所属省份',
  `city_id` int(10) unsigned NOT NULL default '0' COMMENT '参赛个人所属城市',
  `county_id` int(10) unsigned NOT NULL default '0' COMMENT '参赛个人所属县',
  `login_name` varchar(20) NOT NULL default '' COMMENT '登录账号',
  `password` varchar(20) NOT NULL default '' COMMENT '登录密码',
  `name` varchar(20) NOT NULL default '' COMMENT '参赛者姓名',
  `group_id` int(10) unsigned NOT NULL default '0' COMMENT '组别ID',
  `sex` char(1) NOT NULL default '' COMMENT '0,女 1,男',
  `age` varchar(10) NOT NULL default '' COMMENT '年龄',
  `id_card` varchar(18) NOT NULL default '' COMMENT '身份证号码',
  `telephone` varchar(20) NOT NULL default '' COMMENT '联系电话',
  `address` varchar(100) NOT NULL default '' COMMENT '联系地址',
  `postcode` varchar(20) NOT NULL default '' COMMENT '邮政编码',
  `email` varchar(50) NOT NULL default '' COMMENT '电子邮箱',
  `status` char(1) NOT NULL default '0' COMMENT '状态: 0,未激活，1,已激活 2,已锁定',
  `sign_time` int(11) unsigned NOT NULL default '0' COMMENT '注册时间',
  `modify_time` int(11) unsigned NOT NULL default '0' COMMENT '修改时间',
  `password_question` varchar(500) NOT NULL default '' COMMENT '找回密码问题',
  `password_answer` varchar(500) NOT NULL default '' COMMENT '找回密码答案',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='注册用户个人信息';

--
-- Dumping data for table `ticket_member`
--

LOCK TABLES `ticket_member` WRITE;
/*!40000 ALTER TABLE `ticket_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_notecontent`
--

DROP TABLE IF EXISTS `ticket_notecontent`;
CREATE TABLE `ticket_notecontent` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `note_type` char(1) NOT NULL default '1' COMMENT '短信类型:1.用户直接订购，注册会员时发送的短信。2.找回密码时发送的短信。3.机票订购成功时发送的短信',
  `note_content` text COMMENT '短信内容',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信内容管理';

--
-- Dumping data for table `ticket_notecontent`
--

LOCK TABLES `ticket_notecontent` WRITE;
/*!40000 ALTER TABLE `ticket_notecontent` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_notecontent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_order`
--

DROP TABLE IF EXISTS `ticket_order`;
CREATE TABLE `ticket_order` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `member_id` int(10) unsigned NOT NULL default '0' COMMENT '订票人ID',
  `order_time` int(10) unsigned NOT NULL default '0' COMMENT '订票时间',
  `fly_time` int(10) unsigned NOT NULL default '0' COMMENT '启程时间',
  `airline_no` varchar(20) NOT NULL default '' COMMENT '航班号',
  `arrive_time` varchar(20) NOT NULL default '' COMMENT '到达时间',
  `fly_time2` varchar(8) NOT NULL default '' COMMENT '起飞时间',
  `fly_date` int(10) unsigned NOT NULL default '0' COMMENT '航班日期',
  `arrive_city` varchar(50) NOT NULL default '' COMMENT '到达城市',
  `airport_name` varchar(50) NOT NULL default '1' COMMENT '机场名称',
  `plane_model` varchar(20) NOT NULL default '' COMMENT '机型',
  `air_company` varchar(100) NOT NULL default '' COMMENT '机票信息表',
  `berth_no` varchar(50) NOT NULL default '' COMMENT '舱位',
  `seat` varchar(50) NOT NULL default '' COMMENT '座位',
  `price` decimal(12,2) unsigned NOT NULL default '0.00' COMMENT '价格',
  `ticket_counts` int(10) unsigned NOT NULL default '1' COMMENT '票数',
  `status` char(1) NOT NULL COMMENT '状态:0.未付款，1.已付款，2.已退票，3.取消预订',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机票订单表';

--
-- Dumping data for table `ticket_order`
--

LOCK TABLES `ticket_order` WRITE;
/*!40000 ALTER TABLE `ticket_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_org`
--

DROP TABLE IF EXISTS `ticket_org`;
CREATE TABLE `ticket_org` (
  `org_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `no` varchar(50) NOT NULL default '',
  `des` text,
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`org_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_org`
--

LOCK TABLES `ticket_org` WRITE;
/*!40000 ALTER TABLE `ticket_org` DISABLE KEYS */;
INSERT INTO `ticket_org` VALUES (1,'产品维护部','001','产品维护部',1244100882,1252485154);
/*!40000 ALTER TABLE `ticket_org` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_passenger`
--

DROP TABLE IF EXISTS `ticket_passenger`;
CREATE TABLE `ticket_passenger` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `username` varchar(50) NOT NULL default '' COMMENT '姓名',
  `sex` char(1) NOT NULL default '1' COMMENT '性别：0.女，1.男',
  `passenger_type` char(1) NOT NULL default '1' COMMENT '乘客类型：1.成人，2.儿童',
  `certificate_type` char(1) NOT NULL default '1' COMMENT '证件类型：1.身份证，2.护照，3.其它',
  `certificate_no` varchar(50) NOT NULL default '' COMMENT '证件号码',
  `mobile` varchar(20) NOT NULL default '' COMMENT '手机',
  `telephone` varchar(20) NOT NULL default '' COMMENT '电话',
  `passenger_remark` text COMMENT '备注',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='常旅客管理';

--
-- Dumping data for table `ticket_passenger`
--

LOCK TABLES `ticket_passenger` WRITE;
/*!40000 ALTER TABLE `ticket_passenger` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_passenger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_payforaccount`
--

DROP TABLE IF EXISTS `ticket_payforaccount`;
CREATE TABLE `ticket_payforaccount` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `account_type` char(1) NOT NULL default '1' COMMENT '账号类型：1.支付宝，2.财宝通',
  `pay_type` char(1) NOT NULL default '1' COMMENT '付款类型：1.收款，2.分润',
  `account_name` varchar(50) NOT NULL default '' COMMENT '账号名',
  `account_id` varchar(50) NOT NULL default '' COMMENT '账号id',
  `verify_code` varchar(50) NOT NULL default '' COMMENT '安全校验码',
  `is_used` char(1) NOT NULL default '0' COMMENT '是否使用:0.不使用，1.使用',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='支付账号信息';

--
-- Dumping data for table `ticket_payforaccount`
--

LOCK TABLES `ticket_payforaccount` WRITE;
/*!40000 ALTER TABLE `ticket_payforaccount` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_payforaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_planeinfo`
--

DROP TABLE IF EXISTS `ticket_planeinfo`;
CREATE TABLE `ticket_planeinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `plane_no` varchar(5) NOT NULL default '' COMMENT '机型编号',
  `name` varchar(50) NOT NULL default '' COMMENT '机型名称',
  `is_micplane` char(1) NOT NULL default '0' COMMENT '是否小型机：0.不是，1.是小型机',
  `plane_desc` text COMMENT '机型介绍',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机型信息';

--
-- Dumping data for table `ticket_planeinfo`
--

LOCK TABLES `ticket_planeinfo` WRITE;
/*!40000 ALTER TABLE `ticket_planeinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_planeinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_price`
--

DROP TABLE IF EXISTS `ticket_price`;
CREATE TABLE `ticket_price` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `p_id` int(10) unsigned NOT NULL default '0' COMMENT '关联ID',
  `berth_no` varchar(50) NOT NULL default '' COMMENT '舱位',
  `seat` varchar(50) NOT NULL default '' COMMENT '座位',
  `price` decimal(12,2) unsigned NOT NULL default '0.00' COMMENT '价格',
  `scores` decimal(7,2) unsigned NOT NULL default '0.00' COMMENT '积分/优惠',
  `sign_desc` varchar(50) NOT NULL default '' COMMENT '签改退',
  `is_book` char(1) NOT NULL default '0' COMMENT '预订: 0.未预订，1.已预订',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机票价格表';

--
-- Dumping data for table `ticket_price`
--

LOCK TABLES `ticket_price` WRITE;
/*!40000 ALTER TABLE `ticket_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_roles`
--

DROP TABLE IF EXISTS `ticket_roles`;
CREATE TABLE `ticket_roles` (
  `role_id` int(10) unsigned NOT NULL auto_increment,
  `rolename` varchar(32) NOT NULL default '',
  `roledes` varchar(32) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_roles`
--

LOCK TABLES `ticket_roles` WRITE;
/*!40000 ALTER TABLE `ticket_roles` DISABLE KEYS */;
INSERT INTO `ticket_roles` VALUES (1,'sysadmin','系统管理员',1215239222,1215239222),(4,'main','管理员',1254106499,1254106499),(5,'operate','操作员',1254106515,1254106515),(6,'infomonitor','信息监控',1254993088,1254993088);
/*!40000 ALTER TABLE `ticket_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_rose`
--

DROP TABLE IF EXISTS `ticket_rose`;
CREATE TABLE `ticket_rose` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_rose`
--

LOCK TABLES `ticket_rose` WRITE;
/*!40000 ALTER TABLE `ticket_rose` DISABLE KEYS */;
INSERT INTO `ticket_rose` VALUES (1,1),(2,4),(3,5),(4,6),(5,5);
/*!40000 ALTER TABLE `ticket_rose` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_serverinfo`
--

DROP TABLE IF EXISTS `ticket_serverinfo`;
CREATE TABLE `ticket_serverinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `server_type` char(1) NOT NULL default '' COMMENT '服务器类型:1.E-TERM服务器，2.邮件服务器，3.短信服务器，4.支付宝服务器，5.天下通机票接口，6.票联盟机票接口，7.凯讯机票接口',
  `server_address` varchar(100) NOT NULL default '' COMMENT '服务器地址',
  `server_port` varchar(10) NOT NULL default '' COMMENT '服务器端口',
  `verify_code` varchar(50) NOT NULL default '' COMMENT '安全校验码',
  `username` varchar(50) NOT NULL default '' COMMENT '用户名',
  `password` varchar(50) NOT NULL default '' COMMENT '密码',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='服务器信息';

--
-- Dumping data for table `ticket_serverinfo`
--

LOCK TABLES `ticket_serverinfo` WRITE;
/*!40000 ALTER TABLE `ticket_serverinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_serverinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_ticketcheckinfo`
--

DROP TABLE IF EXISTS `ticket_ticketcheckinfo`;
CREATE TABLE `ticket_ticketcheckinfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `username` varchar(50) NOT NULL default '' COMMENT '用户名',
  `password` varchar(50) NOT NULL default '' COMMENT '密码',
  `is_used` char(1) NOT NULL default '0' COMMENT '是否使用:0.不使用，1.使用',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='机票查询账号信息';

--
-- Dumping data for table `ticket_ticketcheckinfo`
--

LOCK TABLES `ticket_ticketcheckinfo` WRITE;
/*!40000 ALTER TABLE `ticket_ticketcheckinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_ticketcheckinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_user`
--

DROP TABLE IF EXISTS `ticket_user`;
CREATE TABLE `ticket_user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `tname` varchar(20) NOT NULL default '',
  `org_id` int(10) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  `session_id` varchar(11) NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ticket_user`
--

LOCK TABLES `ticket_user` WRITE;
/*!40000 ALTER TABLE `ticket_user` DISABLE KEYS */;
INSERT INTO `ticket_user` VALUES (1,'admin','202cb962ac59075b964b07152d234b70','','admin',1,0,1264661495,'3331848'),(2,'main','fad58de7366495db4650cfefac2fcd61','main@da.com','管理员',1,1254103783,1264649339,'9892333'),(3,'man','39c63ddb96a31b9610cd976b896ad4f0','man@da.com','操作员',1,1254106328,1254106533,'0'),(4,'monitor','e10adc3949ba59abbe56e057f20f883e','ss@fd.com','信息监控员',1,1254993374,1255144081,'0'),(5,'robin','098f6bcd4621d373cade4e832627b4f6','robin@ticket.com','robin huang',1,1262144378,1262144378,'0');
/*!40000 ALTER TABLE `ticket_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_visainfo`
--

DROP TABLE IF EXISTS `ticket_visainfo`;
CREATE TABLE `ticket_visainfo` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `area_id` int(10) unsigned NOT NULL default '0' COMMENT '地区ID',
  `visa_type` varchar(100) NOT NULL default '' COMMENT '签证类型',
  `price` decimal(7,2) unsigned NOT NULL default '0.00' COMMENT '所需费用',
  `spend_time` varchar(20) NOT NULL default '' COMMENT '办理时间',
  `effective_time` varchar(20) NOT NULL default '' COMMENT '有效期',
  `stay_time` varchar(20) NOT NULL default '' COMMENT '停留期',
  `material` text COMMENT '所需材料',
  `taiwan` text COMMENT '所需材料',
  `related_remark` text COMMENT '备注',
  `visa_remark` text COMMENT '备注',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='签证信息';

--
-- Dumping data for table `ticket_visainfo`
--

LOCK TABLES `ticket_visainfo` WRITE;
/*!40000 ALTER TABLE `ticket_visainfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_visainfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket_websitebank`
--

DROP TABLE IF EXISTS `ticket_websitebank`;
CREATE TABLE `ticket_websitebank` (
  `k_id` int(10) unsigned NOT NULL auto_increment COMMENT '自增长ID',
  `bank_no` varchar(20) NOT NULL default '1' COMMENT '银行代码',
  `bank_name` varchar(50) NOT NULL default '' COMMENT '银行名称',
  `bank_http` varchar(100) NOT NULL default '' COMMENT '银行网址',
  `telephone` varchar(50) NOT NULL default '' COMMENT '服务电话',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网上银行信息';

--
-- Dumping data for table `ticket_websitebank`
--

LOCK TABLES `ticket_websitebank` WRITE;
/*!40000 ALTER TABLE `ticket_websitebank` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket_websitebank` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2010-02-02  8:30:13
