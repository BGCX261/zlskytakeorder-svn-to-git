-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 09 月 19 日 09:57
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `socket`
--

-- --------------------------------------------------------

--
-- 表的结构 `chninfo`
--

CREATE TABLE `chninfo` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `chninfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `chn_initial_info`
--

CREATE TABLE `chn_initial_info` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `dev_no` varchar(20) NOT NULL default '',
  `chn` char(1) NOT NULL default '1',
  `chnshort` char(10) NOT NULL default '',
  `apid` char(4) default NULL,
  `prgname` char(20) default NULL,
  `schedule` char(8) NOT NULL default '',
  `agcstat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  `gain` char(2) default NULL COMMENT '范围-3~+9',
  `mutestat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  `passstat` char(1) default NULL COMMENT 'O.开启，C.关闭',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `chn_initial_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `devinfo`
--

CREATE TABLE `devinfo` (
  `serial` int(11) NOT NULL auto_increment,
  `dev_no` varchar(20) NOT NULL default '',
  `ipaddr` char(15) NOT NULL default '',
  `ipport` char(5) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `devinfo`
--


-- --------------------------------------------------------

--
-- 表的结构 `dev_initial_info`
--

CREATE TABLE `dev_initial_info` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `dev_no` varchar(20) NOT NULL default '',
  `ipaddr` char(15) NOT NULL default '',
  `ipport` char(5) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `dev_initial_info`
--


-- --------------------------------------------------------

--
-- 表的结构 `operatorlog`
--

CREATE TABLE `operatorlog` (
  `serial` int(10) unsigned NOT NULL auto_increment,
  `name` char(8) NOT NULL default '',
  `date` char(10) NOT NULL default '',
  `time` char(8) NOT NULL default '',
  `devname` char(20) NOT NULL default '',
  `ipaddr` char(15) NOT NULL default '',
  `operask` char(50) NOT NULL default '',
  `operasw` char(100) default NULL,
  PRIMARY KEY  (`serial`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `operatorlog`
--


-- --------------------------------------------------------

--
-- 表的结构 `org`
--

CREATE TABLE `org` (
  `org_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `no` varchar(50) NOT NULL default '',
  `des` text,
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`org_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `org`
--

INSERT INTO `org` (`org_id`, `name`, `no`, `des`, `created`, `updated`) VALUES
(1, '产品维护部', '001', '产品维护部', 1244100882, 1252485154);

-- --------------------------------------------------------

--
-- 表的结构 `roles`
--

CREATE TABLE `roles` (
  `role_id` int(10) unsigned NOT NULL auto_increment,
  `rolename` varchar(32) NOT NULL default '',
  `roledes` varchar(32) NOT NULL default '',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `roles`
--

INSERT INTO `roles` (`role_id`, `rolename`, `roledes`, `created`, `updated`) VALUES
(1, 'sysadmin', '系统管理员', 1215239222, 1215239222),
(2, 'main', '管理员', 1253353760, 1253353760);

-- --------------------------------------------------------

--
-- 表的结构 `rose`
--

CREATE TABLE `rose` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`user_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `rose`
--

INSERT INTO `rose` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `tname` varchar(20) NOT NULL default '',
  `org_id` int(10) unsigned NOT NULL default '0',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `tname`, `org_id`, `created`, `updated`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 'admin', 1, 0, 1252485764),
(2, 'main', 'e10adc3949ba59abbe56e057f20f883e', 'main@da.com', '管理员', 1, 1253353455, 1253354152);
