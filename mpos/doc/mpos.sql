-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 01 月 30 日 09:50
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `mpos`
--

-- --------------------------------------------------------

--
-- 表的结构 `mpos_answer`
--

CREATE TABLE `mpos_answer` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `question_no` varchar(15) NOT NULL default '',
  `user_no` varchar(20) NOT NULL default '',
  `answer_time` int(10) unsigned NOT NULL default '0',
  `answer` text,
  `remark` text,
  `status` char(1) NOT NULL COMMENT '0.无效，1.有效.9.删除',
  PRIMARY KEY  (`k_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 导出表中的数据 `mpos_answer`
--

INSERT INTO `mpos_answer` (`k_id`, `question_no`, `user_no`, `answer_time`, `answer`, `remark`, `status`) VALUES
(1, '1264492578', '123', 1264492977, '一般般拉haha ', NULL, '1'),
(2, '1264492840', '123', 1264492985, '测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测试数据1测试数据1 测试数据1测试数据1测试数据1测', NULL, '1'),
(3, '1264556109', '123', 1264556168, 'hehaha你撒发生防撒大撒防撒地方', NULL, '1'),
(4, '1264556469', '123', 1264556801, 'fdsafdsa', NULL, '1'),
(5, '1264838250', '123', 1264844456, '32132321', NULL, '1');

-- --------------------------------------------------------

--
-- 表的结构 `mpos_question`
--

CREATE TABLE `mpos_question` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `question_no` varchar(15) NOT NULL default '',
  `user_no` varchar(20) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `question` text,
  `question_time` int(10) unsigned NOT NULL default '0',
  `agree_rate` char(1) NOT NULL default '' COMMENT '分数为：0,1,2,3,4,5,6,7,8,9,10',
  `status` char(1) NOT NULL default '1' COMMENT '1.待处理，2.已处理，3.锁定. 9.删除',
  `type` char(1) NOT NULL default '1' COMMENT '1咨询 2问题 3建议 4投诉 5合作 6其他',
  `conter` varchar(25) NOT NULL,
  `conter_email` varchar(50) NOT NULL,
  `conter_tel` varchar(20) NOT NULL,
  `privileges` char(1) NOT NULL,
  `admin_user` varchar(25) NOT NULL,
  `groupid` int(10) NOT NULL default '0',
  PRIMARY KEY  (`k_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `mpos_question`
--

INSERT INTO `mpos_question` (`k_id`, `question_no`, `user_no`, `title`, `question`, `question_time`, `agree_rate`, `status`, `type`, `conter`, `conter_email`, `conter_tel`, `privileges`, `admin_user`, `groupid`) VALUES
(7, '1264838250', '李某', '', '312312312', 1264838250, '0', '2', '3', '李某', '32@sid.com', '+86.32312', '2', 'user', 0),
(6, '1264838151', '李某', '', '测试型不 型收费额肤色 ', 1264838151, '0', '1', '3', '李某', '32@sid.com', '+86.3123213213', '2', 'user', 0),
(5, '1264838069', '李某', '', '432432432234234234', 1264838069, '0', '1', '1', '李某', '32@sid.com', '+86.3123213213', '4', 'guest', 0),
(8, '1264842827', '李某', '', '432423432', 1264842827, '0', '1', '3', '李某', '32@sid.com', '+86.3123213213', '2', 'user', 1),
(9, '1264842871', '李某', '', '312312312312312', 1264842871, '0', '1', '3', '李某', '32@sid.com', '+86.3123213213', '2', 'user', 1),
(10, '1264843141', '李某', '', 'fsdafasdfsdafsda', 1264843141, '0', '1', '4', '李某', '32@sid.com', '+86.3123213213', '2', 'user', 1);

-- --------------------------------------------------------

--
-- 表的结构 `mpos_user`
--

CREATE TABLE `mpos_user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(20) NOT NULL default '',
  `password` varchar(50) NOT NULL default '',
  `tname` varchar(20) NOT NULL default '',
  `privileges` char(1) NOT NULL default '3' COMMENT '1.管理员，2. VIP用户，3.游客',
  `created` int(10) unsigned NOT NULL default '0',
  `updated` int(10) unsigned NOT NULL default '0',
  `is_admin` char(1) NOT NULL default '0',
  `groupid` int(10) NOT NULL,
  `group_name` varbinary(10) NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `mpos_user`
--

INSERT INTO `mpos_user` (`user_id`, `username`, `password`, `tname`, `privileges`, `created`, `updated`, `is_admin`, `groupid`, `group_name`) VALUES
(4, 'admin', 'admin', '管理员', '1', 0, 0, '', 0, ''),
(5, 'user', '123456', '群组管理员', '2', 0, 0, '1', 1, '代理1'),
(7, 'user1', '123456', '群组普通成员', '2', 0, 0, '0', 1, '代理1');
