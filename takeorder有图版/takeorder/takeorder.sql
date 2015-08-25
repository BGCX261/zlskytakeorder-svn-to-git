-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 08 月 31 日 10:08
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `takeorder`
--

-- --------------------------------------------------------

--
-- 表的结构 `a_user`
--

CREATE TABLE `takeorder_a_user` (
  `user_id` int(10) unsigned NOT NULL auto_increment,
  `login_name` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `login_pass` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `tname` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `create_time` int(10) unsigned NOT NULL default '0',
  `update_time` int(10) unsigned NOT NULL default '0',
  `mac_address` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `a_user`
--

INSERT INTO `takeorder_a_user` (`user_id`, `login_name`, `login_pass`, `tname`, `create_time`, `update_time`, `mac_address`) VALUES
(1, '123', '123', '', 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `takeorder_customer` (
  `id` int(11) NOT NULL auto_increment,
  `no` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 导出表中的数据 `customer`
--

INSERT INTO `takeorder_customer` (`id`, `no`, `name`, `phone`, `mobile`, `status`) VALUES
(2, '00000001', 'Robel hat', '134324567', '1456423466', 'normal'),
(4, '00000002', 'steven', '321332', '13213213', 'normal'),
(6, '00000003', 'kit', '321354532', '1321da3213', 'normal'),
(8, '00000004', 'fat', '321354ds532', '13213214353', 'normal'),
(10, '00000005', 'jack', '321354fds532', '13213213', 'normal'),
(12, '00000006', 'rose', '321354532', '13213213', 'normal');

-- --------------------------------------------------------

--
-- 表的结构 `item`
--

CREATE TABLE `takeorder_item` (
  `id` int(11) NOT NULL auto_increment,
  `sortname` varchar(100) default NULL,
  `itemname` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `status` varchar(2) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 导出表中的数据 `item`
--

INSERT INTO `takeorder_item` (`id`, `sortname`, `itemname`, `price`, `status`) VALUES
(1, 'Cider', '', 0, '1'),
(2, 'Apertiff ogLikoor', '', 0, '1'),
(3, 'Apertiff ogLikoor', 'Bristol Cream', 30.5, '1'),
(4, 'Apertiff ogLikoor', 'Bristol Cream 8CL', 20.8, '1'),
(5, 'Apertiff ogLikoor', 'Cinzanu Bianco.4', 18, '1'),
(6, 'Apertiff ogLikoor', 'Cinzano Bianc', 54.7, '1'),
(7, 'Apertiff ogLikoor', 'Campari Bitte', 34, '1'),
(8, 'Apertiff ogLikoor', 'WarnickAsvoc', 18.7, '1'),
(9, 'Apertiff ogLikoor', 'ewew', 3, '1'),
(10, 'Apertiff ogLikoor', 'fhr yhtrtr.0', 54, '1'),
(11, 'Apertiff ogLikoor', 'rewrv yt', 18.7, '1'),
(12, 'Apertiff ogLikoor', 'qwq', 0, '1'),
(13, 'Apertiff ogLikoor', 'rwr', 5, '1'),
(14, 'Apertiff ogLikoor', 'ewew', 4, '1'),
(15, 'Alkoholfrie', '', 0, '1'),
(16, 'Tobakk', '', 0, '1'),
(17, 'Chanpagne', '', 0, '1'),
(18, 'Poeng', '', 0, '1'),
(19, 'hhhhh', '', 0, '1'),
(20, 'aaaaaaa', '', 0, '1'),
(21, 'bbbbbbbbbb', '', 0, '1'),
(22, 'cccccccccc', '', 0, '1'),
(23, 'ddddddddd', '', 0, '1'),
(24, 'eeeeeeeee', '', 0, '1'),
(25, 'fffffffffffff', '', 0, '1'),
(26, 'gggggggggg', '', 0, '1'),
(27, 'hhhhhhhhh', '', 0, '1'),
(28, 'iiiiiiiiiiii', '', 0, '1');

-- --------------------------------------------------------

--
-- 表的结构 `kind`
--

CREATE TABLE `takeorder_kind` (
  `id` int(11) NOT NULL auto_increment,
  `classname` varchar(100) collate utf8_bin NOT NULL,
  `status` char(1) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- 导出表中的数据 `kind`
--

INSERT INTO `takeorder_kind` (`id`, `classname`, `status`) VALUES
(1, '中国菜', '1'),
(2, '韩国菜', '1'),
(3, '日本菜', '1'),
(4, '泰国菜', '1'),
(5, '法国菜', '1'),
(6, '印度菜', '1'),
(7, '西班牙菜', '1'),
(8, '意大利菜', '1');

-- --------------------------------------------------------

--
-- 表的结构 `kind_sub`
--

CREATE TABLE `takeorder_kind_sub` (
  `k_id` int(11) NOT NULL auto_increment,
  `id` int(11) NOT NULL,
  `name` varchar(100) collate utf8_bin NOT NULL,
  `price` varchar(100) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `kind_sub`
--

INSERT INTO `takeorder_kind_sub` (`k_id`, `id`, `name`, `price`) VALUES
(1, 1, '热干面', '12'),
(2, 1, '肉丸汤', '14'),
(3, 1, '鸡肉饭汤', '14'),
(4, 2, '韩国烤肉', '12'),
(5, 2, '韩国冷面', '12'),
(6, 2, '韩国年糕', '12');

-- --------------------------------------------------------

--
-- 表的结构 `main`
--

CREATE TABLE `takeorder_main` (
  `id` int(11) NOT NULL auto_increment,
  `no` varchar(50) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `disc` varchar(50) NOT NULL,
  `lineamt` varchar(50) NOT NULL,
  `tax` varchar(50) NOT NULL,
  `r` varchar(50) NOT NULL,
  `info` varchar(20) NOT NULL,
  `customize` varchar(50) NOT NULL,
  `totalqty` varchar(50) NOT NULL,
  `grossamt` varchar(50) NOT NULL,
  `normal` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL,
  `addin` varchar(50) NOT NULL,
  `netamount` varchar(50) NOT NULL,
  `importer` varchar(50) NOT NULL,
  `salesman` varchar(50) NOT NULL,
  `customer` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `class` varchar(50) NOT NULL,
  `delete` varchar(50) NOT NULL,
  `single` varchar(50) NOT NULL,
  `b` varchar(50) NOT NULL,
  `c` varchar(50) NOT NULL,
  `customeerno` varchar(50) NOT NULL,
  `hold` varchar(50) NOT NULL,
  `rethold` varchar(50) NOT NULL,
  `reprint` varchar(50) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `function` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `exit` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='主界面字段录入' AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `main`
--

INSERT INTO `takeorder_main` (`id`, `no`, `itemname`, `price`, `qty`, `disc`, `lineamt`, `tax`, `r`, `info`, `customize`, `totalqty`, `grossamt`, `normal`, `discount`, `addin`, `netamount`, `importer`, `salesman`, `customer`, `name`, `class`, `delete`, `single`, `b`, `c`, `customeerno`, `hold`, `rethold`, `reprint`, `remark`, `function`, `payment`, `exit`) VALUES
(1, 'No', 'Item Name', 'Price', 'QTY', 'Disc', 'LineAmt', 'Tax', 'R', 'Info', 'Customize', 'TotalQTY', 'GrossAmt', 'Normal', 'DisCount', 'Add In', 'NetaMount', 'Importer', 'SalesMan', 'Customer', 'Name', 'Class', 'Delete', 'Single', 'B', 'C', 'CustomerNo', 'Hold', 'Rethold', 'Reprint', 'Remark', 'Function', 'Payment', 'Exit');

-- --------------------------------------------------------

--
-- 表的结构 `menu_list`
--

CREATE TABLE `takeorder_menu_list` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `class_id` int(10) unsigned NOT NULL default '0',
  `name` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `price` decimal(5,2) unsigned NOT NULL default '0.00',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- 导出表中的数据 `menu_list`
--

INSERT INTO `takeorder_menu_list` (`k_id`, `class_id`, `name`, `price`) VALUES
(1, 1, '热干面', '0.00'),
(2, 1, '土豆', '0.00'),
(3, 2, '香蕉', '0.00'),
(4, 2, '香蕉', '0.00'),
(5, 1, 'skwk', '0.00'),
(6, 1, 'sina', '0.00'),
(7, 1, 'skwk', '0.00'),
(8, 1, 'sina', '0.00'),
(9, 1, 'skwk', '0.00'),
(10, 1, 'sina', '0.00'),
(11, 1, 'skwk', '0.00'),
(12, 1, 'sina', '0.00'),
(13, 1, 'skwk', '0.00'),
(14, 1, 'sina', '0.00'),
(15, 1, 'skwk', '0.00'),
(16, 1, 'sina', '0.00'),
(17, 1, 'skwk', '0.00'),
(18, 1, 'sina', '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `menu_remark`
--

CREATE TABLE `takeorder_menu_remark` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `order_id` int(10) unsigned NOT NULL default '0',
  `action` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `remark` varchar(500) collate utf8_unicode_ci NOT NULL default '',
  `remark_no` varchar(6) collate utf8_unicode_ci NOT NULL default '',
  `seq_id` int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `menu_remark`
--

INSERT INTO `takeorder_menu_remark` (`k_id`, `order_id`, `action`, `remark`, `remark_no`, `seq_id`) VALUES
(5, 17, 'Add', 'Cow', '', 1),
(6, 17, 'Small', 'Pig', '', 1),
(7, 18, 'Small', 'Pig', '', 1),
(8, 18, 'Small', 'Pig', '', 1),
(9, 21, 'Add', 'Cow', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE `takeorder_order` (
  `id` int(11) NOT NULL auto_increment,
  `customize` varchar(20) NOT NULL default '0',
  `no` varchar(100) NOT NULL,
  `num` int(11) NOT NULL default '0',
  `itemid` int(11) NOT NULL default '0',
  `remarkid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `order`
--


-- --------------------------------------------------------

--
-- 表的结构 `order_detail`
--

CREATE TABLE `takeorder_order_detail` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `order_id` int(10) unsigned NOT NULL default '1' COMMENT '关联主表的k_id',
  `client_id` int(10) unsigned NOT NULL default '1',
  `menu_id` int(10) unsigned NOT NULL default '0' COMMENT '对应菜单项表中的k_id',
  `qty` int(10) unsigned NOT NULL default '1',
  `remark_id` int(10) unsigned NOT NULL default '0',
  `fact_price` decimal(6,2) unsigned NOT NULL default '0.00',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- 导出表中的数据 `order_detail`
--

INSERT INTO `takeorder_order_detail` (`k_id`, `order_id`, `client_id`, `menu_id`, `qty`, `remark_id`, `fact_price`) VALUES
(17, 15, 1, 1, 1, 0, '0.00'),
(18, 15, 2, 1, 1, 0, '0.00'),
(19, 16, 1, 1, 1, 0, '0.00'),
(20, 16, 2, 1, 1, 0, '0.00'),
(21, 16, 1, 1, 1, 0, '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `order_main`
--

CREATE TABLE `takeorder_order_main` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `table_id` int(10) unsigned NOT NULL default '1',
  `order_no` varchar(15) collate utf8_unicode_ci NOT NULL default '',
  `order_time` int(10) unsigned NOT NULL default '0',
  `price` decimal(8,2) unsigned NOT NULL default '0.00',
  `operator` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `status` char(1) collate utf8_unicode_ci NOT NULL default '0' COMMENT '0.未提交，1. 已提交',
  `pay_status` char(1) collate utf8_unicode_ci NOT NULL default '0' COMMENT '0.未付款。1.已付款',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- 导出表中的数据 `order_main`
--

INSERT INTO `takeorder_order_main` (`k_id`, `table_id`, `order_no`, `order_time`, `price`, `operator`, `status`, `pay_status`) VALUES
(15, 1, '44', 1251710076, '0.00', '', '0', '0'),
(16, 1, '44', 1251710076, '0.00', '', '0', '0'),
(17, 2, '92', 1251711294, '0.00', '', '0', '0');

-- --------------------------------------------------------

--
-- 表的结构 `remark_content`
--

CREATE TABLE `takeorder_remark_content` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `remark_no` varchar(4) collate utf8_unicode_ci NOT NULL,
  `status` char(1) collate utf8_unicode_ci NOT NULL default '1' COMMENT '0.无效，1.有效。',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- 导出表中的数据 `remark_content`
--

INSERT INTO `takeorder_remark_content` (`k_id`, `name`, `remark_no`, `status`) VALUES
(1, 'Cow', '', '1'),
(2, 'Pig', '', '1'),
(3, '01003E', '', '1'),
(4, '01004E', '', '1'),
(5, '01005E', '', '1'),
(6, '01006E', '', '1'),
(7, '01007E', '', '1'),
(8, '01008E', '', '1'),
(9, '01009E', '', '1'),
(10, '01010E', '', '1'),
(11, '01011E', '', '1'),
(12, '01012E', '', '1'),
(13, '01013E', '', '1'),
(14, '01014E', '', '1'),
(15, '01015E', '', '1'),
(16, '01016E', '', '1'),
(17, '01017E', '', '1'),
(18, '01018E', '', '1'),
(19, '01019E', '', '1'),
(20, '01020E', '', '1'),
(21, '01021E', '', '1'),
(22, '01022E', '', '1'),
(23, '01023E', '', '1'),
(24, '01024E', '', '1'),
(25, '01025E', '', '1'),
(26, '01026E', '', '1'),
(27, '01027E', '', '1'),
(28, '01028E', '', '1'),
(29, '01029E', '', '1'),
(30, '01030E', '', '1'),
(31, '01031E', '', '1'),
(32, '01032E', '', '1'),
(33, '01033E', '', '1'),
(34, '01034E', '', '1'),
(35, '01035E', '', '1'),
(36, '01036E', '', '1'),
(37, '01037E', '', '1'),
(38, '01038E', '', '1'),
(39, '01039E', '', '1'),
(40, '01040E', '', '1'),
(41, '01041E', '', '1'),
(42, '01042E', '', '1'),
(43, '01043E', '', '1'),
(44, '01044E', '', '1'),
(45, '01045E', '', '1'),
(46, '01046E', '', '1'),
(47, '01047E', '', '1'),
(48, '01048E', '', '1'),
(49, '01049E', '', '1'),
(50, '01050E', '', '1');

-- --------------------------------------------------------

--
-- 表的结构 `remark_sort`
--

CREATE TABLE `takeorder_remark_sort` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `remark_no` varchar(2) collate utf8_unicode_ci NOT NULL default '',
  `status` char(1) collate utf8_unicode_ci NOT NULL default '1' COMMENT '0.无效，1.有效',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 导出表中的数据 `remark_sort`
--

INSERT INTO `takeorder_remark_sort` (`k_id`, `name`, `remark_no`, `status`) VALUES
(1, 'Add', '', '1'),
(2, 'Small', '', '1'),
(3, 'None', '', '1'),
(4, 'Remark', '', '1'),
(5, '05OptionE', '', '1'),
(6, '06OptionE', '', '1');

-- --------------------------------------------------------

--
-- 表的结构 `s_class`
--

CREATE TABLE `takeorder_s_class` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL default '',
  `status` char(1) collate utf8_unicode_ci NOT NULL default '1' COMMENT '0.无效，1.有效',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- 导出表中的数据 `s_class`
--

INSERT INTO `takeorder_s_class` (`k_id`, `name`, `status`) VALUES
(1, '中国菜', '1'),
(2, '美国菜', '1'),
(3, '韩国菜', '1'),
(4, '西班牙菜', '1'),
(5, '法国', '1'),
(6, '日本菜', '1'),
(7, '泰国菜', '1'),
(8, '蒙古菜', '1'),
(9, '太空菜', '1');

-- --------------------------------------------------------

--
-- 表的结构 `tmp_menu_remark`
--

CREATE TABLE `takeorder_tmp_menu_remark` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `order_id` int(10) unsigned NOT NULL default '0',
  `action` varchar(50) collate utf8_unicode_ci NOT NULL default '',
  `remark` varchar(500) collate utf8_unicode_ci NOT NULL default '',
  `remark_no` varchar(6) collate utf8_unicode_ci NOT NULL default '',
  `seq_id` int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- 导出表中的数据 `tmp_menu_remark`
--


-- --------------------------------------------------------

--
-- 表的结构 `tmp_order_detail`
--

CREATE TABLE `takeorder_tmp_order_detail` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `order_id` int(10) unsigned NOT NULL default '1' COMMENT '关联主表的k_id',
  `client_id` int(10) unsigned NOT NULL default '1',
  `menu_id` int(10) unsigned NOT NULL default '0' COMMENT '对应菜单项表中的k_id',
  `qty` int(10) unsigned NOT NULL default '1',
  `remark_id` int(10) unsigned NOT NULL default '0',
  `fact_price` decimal(6,2) unsigned NOT NULL default '0.00',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- 导出表中的数据 `tmp_order_detail`
--

INSERT INTO `takeorder_tmp_order_detail` (`k_id`, `order_id`, `client_id`, `menu_id`, `qty`, `remark_id`, `fact_price`) VALUES
(26, 20, 1, 1, 1, 0, '0.00'),
(27, 20, 2, 1, 1, 0, '0.00');

-- --------------------------------------------------------

--
-- 表的结构 `tmp_order_main`
--

CREATE TABLE `takeorder_tmp_order_main` (
  `k_id` int(10) unsigned NOT NULL auto_increment,
  `table_id` int(10) unsigned NOT NULL default '1',
  `order_no` varchar(15) collate utf8_unicode_ci NOT NULL default '',
  `order_time` int(10) unsigned NOT NULL default '0',
  `price` decimal(8,2) unsigned NOT NULL default '0.00',
  `operator` varchar(20) collate utf8_unicode_ci NOT NULL default '',
  `status` char(1) collate utf8_unicode_ci NOT NULL default '0' COMMENT '0.未提交，1. 已提交',
  `pay_status` char(1) collate utf8_unicode_ci NOT NULL default '0' COMMENT '0.未付款。1.已付款',
  PRIMARY KEY  (`k_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- 导出表中的数据 `tmp_order_main`
--

INSERT INTO `takeorder_tmp_order_main` (`k_id`, `table_id`, `order_no`, `order_time`, `price`, `operator`, `status`, `pay_status`) VALUES
(20, 1, '44', 1251710076, '0.00', '', '0', '0'),
(21, 1, '44', 1251710076, '0.00', '', '0', '0');
