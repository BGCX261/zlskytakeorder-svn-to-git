-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2011 年 04 月 18 日 12:04
-- 服务器版本: 5.0.27
-- PHP 版本: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `operator`
--

-- --------------------------------------------------------

--
-- 表的结构 `op_about`
--

CREATE TABLE IF NOT EXISTS `op_about` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `sort` int(11) NOT NULL COMMENT '排序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站相关表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_about`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_admin_module`
--

CREATE TABLE IF NOT EXISTS `op_admin_module` (
  `module` char(20) NOT NULL COMMENT '模块',
  `name` varchar(200) NOT NULL COMMENT '模块名称',
  `act` text NOT NULL COMMENT '角色',
  PRIMARY KEY  (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模块表';

--
-- 转存表中的数据 `op_admin_module`
--

INSERT INTO `op_admin_module` (`module`, `name`, `act`) VALUES
('setup', '系统设置', 'master,operator'),
('index', '默认显示', 'operator,master');

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_role`
--

CREATE TABLE IF NOT EXISTS `op_admin_role` (
  `key` char(20) NOT NULL COMMENT '角色标识',
  `name` varchar(100) NOT NULL COMMENT '角色名',
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='后台角色表';

--
-- 转存表中的数据 `op_admin_role`
--

INSERT INTO `op_admin_role` (`key`, `name`) VALUES
('master', '管理员'),
('operator', '运营');

-- --------------------------------------------------------

--
-- 表的结构 `op_admin_user`
--

CREATE TABLE IF NOT EXISTS `op_admin_user` (
  `id` int(11) NOT NULL auto_increment,
  `user` char(30) NOT NULL,
  `vuser` varchar(200) NOT NULL COMMENT '用户呢称',
  `pwd` char(32) NOT NULL,
  `role` text NOT NULL COMMENT '角色标识 以,隔开',
  `login_count` int(11) NOT NULL COMMENT '登录次数',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='后台用户表' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `op_admin_user`
--

INSERT INTO `op_admin_user` (`id`, `user`, `vuser`, `pwd`, `role`, `login_count`) VALUES
(1, 'zlsky', '朱磊', '032b11afcc6147bd7154450672ceaa22', 'operator', 7),
(2, 'zl8522115', '朱磊zl8522115', '6e591ec6a9b684f6773a101e04763b24', '0', 0),
(3, 'power', '力量', '032b11afcc6147bd7154450672ceaa22', '0', 0),
(4, 'zlsky1', '朱磊1', '032b11afcc6147bd7154450672ceaa22', '0', 0),
(5, 'zlsky2', '朱磊2', '032b11afcc6147bd7154450672ceaa22', '0', 1);

-- --------------------------------------------------------

--
-- 表的结构 `op_fried_link`
--

CREATE TABLE IF NOT EXISTS `op_fried_link` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL COMMENT '名称',
  `url` varchar(50) NOT NULL COMMENT '网址',
  `sort` int(10) NOT NULL COMMENT '排序',
  `img` varchar(50) NOT NULL COMMENT '图片',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_fried_link`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_games`
--

CREATE TABLE IF NOT EXISTS `op_games` (
  `mark` char(20) NOT NULL COMMENT '游戏标识',
  `name` varchar(100) NOT NULL COMMENT '游戏名称',
  `small_img` varchar(200) NOT NULL COMMENT '游戏图片,小图',
  `normal_img` varchar(200) NOT NULL COMMENT '中图',
  `big_img` varchar(200) NOT NULL COMMENT '大图',
  `content` text NOT NULL COMMENT '内容',
  `sort` int(10) NOT NULL COMMENT '排序',
  `time` int(11) NOT NULL COMMENT '添加时间',
  PRIMARY KEY  (`mark`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `op_games`
--

INSERT INTO `op_games` (`mark`, `name`, `small_img`, `normal_img`, `big_img`, `content`, `sort`, `time`) VALUES
('bto', '商业大亨', '', '', '', '商业大亨', 0, 1303106029),
('frg', '富人国', '', '', '', '富人国,模拟经营类游戏', 0, 1303192461);

-- --------------------------------------------------------

--
-- 表的结构 `op_news`
--

CREATE TABLE IF NOT EXISTS `op_news` (
  `id` int(11) NOT NULL auto_increment,
  `is_top` tinyint(1) NOT NULL COMMENT '是否顶置',
  `game_type` tinyint(3) NOT NULL COMMENT '游戏类型',
  `jump_url` varchar(200) NOT NULL COMMENT '跳转URL',
  `user_id` int(11) NOT NULL COMMENT '发布人',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `time` int(10) NOT NULL COMMENT '时间',
  `source` varchar(30) NOT NULL COMMENT '来源',
  `click_rate` int(10) NOT NULL COMMENT '点击率',
  `type` tinyint(1) NOT NULL COMMENT '新闻类型',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='新闻表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `op_news`
--

INSERT INTO `op_news` (`id`, `is_top`, `game_type`, `jump_url`, `user_id`, `title`, `content`, `time`, `source`, `click_rate`, `type`) VALUES
(2, 0, 0, '0', 1, 'demo', 'show me the money', 1303108708, '官网', 0, 1),
(3, 0, 0, '0', 1, 'javascript', 'power over whelming', 1303108720, '官网', 0, 1),
(4, 0, 0, '0', 1, 'sendtime', 'operation cwal', 1303108738, '官网', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `op_servers`
--

CREATE TABLE IF NOT EXISTS `op_servers` (
  `id` int(11) NOT NULL auto_increment,
  `game_mark` char(20) NOT NULL COMMENT '游戏标识',
  `server_id` int(10) NOT NULL COMMENT '服务器id',
  `open_time` int(10) NOT NULL COMMENT '开服时间',
  `name` varchar(200) NOT NULL COMMENT '服务器名称',
  `status` tinyint(1) NOT NULL COMMENT '服务器状态.1:新服,2:火爆,3:待开,4:维护',
  `pay_status` tinyint(1) NOT NULL COMMENT '充值状态.0:关闭.1:开启',
  PRIMARY KEY  (`id`),
  KEY `server_id` (`server_id`),
  KEY `game_mark` (`game_mark`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `op_servers`
--

INSERT INTO `op_servers` (`id`, `game_mark`, `server_id`, `open_time`, `name`, `status`, `pay_status`) VALUES
(1, 'bto', 1, 1303112030, '一服', 1, 0),
(2, 'bto', 4, 1302680106, '四服', 1, 1),
(3, 'bto', 3, 1303112047, '三服', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `op_service_ask`
--

CREATE TABLE IF NOT EXISTS `op_service_ask` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(250) NOT NULL COMMENT '标题',
  `game_mark` char(20) NOT NULL COMMENT '游戏标识',
  `server_id` int(10) NOT NULL COMMENT '服务器ID',
  `type` tinytext NOT NULL COMMENT '提问类型',
  `time` int(10) NOT NULL COMMENT '提问时间',
  `play_user` varchar(100) NOT NULL COMMENT '玩家角色名',
  `qq` varchar(20) NOT NULL COMMENT 'QQ',
  `tel` varchar(20) NOT NULL COMMENT '电话',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客服系统提问' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_service_ask`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_service_ask_dialog`
--

CREATE TABLE IF NOT EXISTS `op_service_ask_dialog` (
  `id` int(11) NOT NULL auto_increment,
  `ask_id` int(11) NOT NULL COMMENT '工单ID',
  `user_id` int(11) NOT NULL COMMENT '回复人id',
  `content` text NOT NULL COMMENT '回复内容',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ask对话表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_service_ask_dialog`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_system_var`
--

CREATE TABLE IF NOT EXISTS `op_system_var` (
  `key` char(20) NOT NULL COMMENT '变量key',
  `name` varchar(200) NOT NULL COMMENT '变量名称',
  `var` text NOT NULL COMMENT '变量,序列化字符串',
  PRIMARY KEY  (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统变量';

--
-- 转存表中的数据 `op_system_var`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_detail`
--

CREATE TABLE IF NOT EXISTS `op_user_detail` (
  `id` int(11) NOT NULL COMMENT 'user_id',
  `v_user_name` varchar(20) NOT NULL COMMENT '呢称',
  `sex` tinyint(1) NOT NULL COMMENT '性别.0:女.1:男',
  `id_card` varchar(50) NOT NULL COMMENT '身份证',
  `tel` varchar(20) NOT NULL COMMENT '联系电话',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `qq` varchar(20) NOT NULL COMMENT 'qq',
  `msn` varchar(20) NOT NULL COMMENT 'msn',
  `reg_time` int(10) NOT NULL COMMENT '注册时间',
  `reg_ip` int(10) NOT NULL COMMENT '注册ip',
  `ask1` varchar(200) NOT NULL COMMENT '密码保护提问1',
  `ask2` varchar(200) NOT NULL COMMENT '密码保护提问2',
  `answer1` varchar(200) NOT NULL COMMENT '回复1',
  `answer2` varchar(200) NOT NULL COMMENT '回复2',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户详细资料表';

--
-- 转存表中的数据 `op_user_detail`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_loginlog_1`
--

CREATE TABLE IF NOT EXISTS `op_user_loginlog_1` (
  `id` int(11) NOT NULL auto_increment,
  `user` char(32) NOT NULL COMMENT '登陆账号',
  `pwd` int(11) NOT NULL COMMENT '登陆密码',
  `ip` int(11) NOT NULL COMMENT '登陆IP',
  `time` int(11) NOT NULL COMMENT '登陆时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_loginlog_1`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_0`
--

CREATE TABLE IF NOT EXISTS `op_user_members_0` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_0`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_1`
--

CREATE TABLE IF NOT EXISTS `op_user_members_1` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_1`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_2`
--

CREATE TABLE IF NOT EXISTS `op_user_members_2` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_2`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_3`
--

CREATE TABLE IF NOT EXISTS `op_user_members_3` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_3`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_4`
--

CREATE TABLE IF NOT EXISTS `op_user_members_4` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_4`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_5`
--

CREATE TABLE IF NOT EXISTS `op_user_members_5` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_5`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_6`
--

CREATE TABLE IF NOT EXISTS `op_user_members_6` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_6`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_7`
--

CREATE TABLE IF NOT EXISTS `op_user_members_7` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_7`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_8`
--

CREATE TABLE IF NOT EXISTS `op_user_members_8` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_8`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_members_9`
--

CREATE TABLE IF NOT EXISTS `op_user_members_9` (
  `id` int(11) NOT NULL auto_increment COMMENT '用户ID',
  `user` char(32) NOT NULL COMMENT '用户名',
  `pwd` char(32) NOT NULL COMMENT '用户密码',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_members_9`
--


-- --------------------------------------------------------

--
-- 表的结构 `op_user_server_1`
--

CREATE TABLE IF NOT EXISTS `op_user_server_1` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL COMMENT '用户ID',
  `game_id` int(11) NOT NULL COMMENT '游戏ID',
  `server_id` int(11) NOT NULL COMMENT '服务器ID',
  `ip` int(11) NOT NULL COMMENT '登录IP',
  `time` int(11) NOT NULL COMMENT '登录时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户登陆服务器记录' AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `op_user_server_1`
--

