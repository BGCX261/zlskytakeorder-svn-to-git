-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 01 月 21 日 13:58
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `socket`
--

-- --------------------------------------------------------

--
-- 表的结构 `socket_chninfo`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- 导出表中的数据 `socket_chninfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `socket_chn_initial_info`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `socket_chn_initial_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `socket_devinfo`
--

CREATE TABLE `socket_devinfo` (
  `serial` int(11) NOT NULL auto_increment,
  `ipaddr` char(15) NOT NULL default '',
  `ipport` char(5) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  PRIMARY KEY  (`serial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 导出表中的数据 `socket_devinfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `socket_dev_initial_info`
--

CREATE TABLE `socket_dev_initial_info` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `ipaddr` char(15) NOT NULL default '',
  `ipport` char(5) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  PRIMARY KEY  (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `socket_dev_initial_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `socket_dev_schedule`
--

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
  `week` int(1) NOT NULL default '0',
  PRIMARY KEY  (`serial`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `socket_dev_schedule`
--


-- --------------------------------------------------------

--
-- 表的结构 `socket_operatorlog`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `socket_operatorlog`
--


-- --------------------------------------------------------

--
-- 表的结构 `socket_org`
--

CREATE TABLE `socket_org` (
  `org_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `no` varchar(50) NOT NULL default '',
  `des` text,
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`org_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `socket_org`
--

INSERT INTO `socket_org` (`org_id`, `name`, `no`, `des`, `created`, `updated`) VALUES
(1, '产品维护部', '001', '产品维护部', 1244100882, 1252485154);

-- --------------------------------------------------------

--
-- 表的结构 `socket_roles`
--

CREATE TABLE `socket_roles` (
  `role_id` int(10) unsigned NOT NULL auto_increment,
  `rolename` varchar(32) NOT NULL default '',
  `roledes` varchar(32) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `socket_roles`
--

INSERT INTO `socket_roles` (`role_id`, `rolename`, `roledes`, `created`, `updated`) VALUES
(1, 'sysadmin', '系统管理员', 1215239222, 1215239222),
(4, 'main', '管理员', 1254106499, 1254106499),
(5, 'operate', '操作员', 1254106515, 1254106515),
(6, 'infomonitor', '信息监控', 1254993088, 1254993088);

-- --------------------------------------------------------

--
-- 表的结构 `socket_rose`
--

CREATE TABLE `socket_rose` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `socket_rose`
--

INSERT INTO `socket_rose` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 4),
(3, 5),
(4, 6),
(5, 5);

-- --------------------------------------------------------

--
-- 表的结构 `socket_user`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `socket_user`
--

INSERT INTO `socket_user` (`user_id`, `username`, `password`, `email`, `tname`, `session_id`, `org_id`, `created`, `updated`) VALUES
(1, 'admin', '0b7dab01503c10f96ecedad1972ebaad', '', 'admin', '0', 1, 0, 1257236090),
(2, 'main', 'fad58de7366495db4650cfefac2fcd61', 'main@da.com', '管理员', '4082489', 1, 1254103783, 1264081303),
(3, 'man', '39c63ddb96a31b9610cd976b896ad4f0', 'man@da.com', '操作员', '0', 1, 1254106328, 1254106533),
(4, 'monitor', 'e10adc3949ba59abbe56e057f20f883e', 'ss@fd.com', '信息监控员', '0', 1, 1254993374, 1255144081),
(5, 'robin', '098f6bcd4621d373cade4e832627b4f6', 'robin@socket.com', 'robin huang', '0', 1, 1262144378, 1262144378);
