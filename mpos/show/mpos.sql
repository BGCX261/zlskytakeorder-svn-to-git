
-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2009 年 10 月 17 日 18:57
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `comment`
--

-- --------------------------------------------------------

--
-- 表的结构 `coment`
--

CREATE TABLE `coment` (
  `id` int(10) NOT NULL auto_increment,
  `title` varchar(20) default NULL,
  `name` varchar(20) NOT NULL,
  `context` text,
  `time` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `coment`
--

INSERT INTO `coment` (`id`, `title`, `name`, `context`, `time`) VALUES
(1, 'CNG终端设备FAQ整理', '', '前后面板的提示灯，正常情况应该为以下显示状态：\r\n\r\n标签     意义\r\nPower     接通电源后此灯常亮，此灯在电源按钮上端，无标签显示\r\nActive     接通电源此灯为闪烁状态，表示设备进入运行状态\r\nLink     使用双绞网线接通10BASE-T 接口时此灯常亮\r\nTx     设备在有数据包传输时，此灯闪烁\r\nLine N     连接后面版的相应端口，并且在使用时此灯为常亮\r\n10BASE-T     连接交换机或电脑时，此灯为常亮\r\n100BASE-T     连接ADSL Modem 或ISP 线路时，此灯为常亮\r\nControl     连接电脑COM 接口在开机时，会闪烁1-2 秒\r\n', '2009-10-17 00:00:00'),
(2, '设备调试指南', '', '<img src=images/3.gif><img src=images/3.gif>可以告诉我吗？', '2009-10-17 00:00:00'),
(3, '设备调试指南', '', '<div class=newarticle><img src=images/3.gif><img src=images/3.gif>可以告诉我吗？</div>   当发现设备配置完毕后，仍无法拨打电话，请按如下步骤进行检查\r\n    1、检查设备是否可以连接公网（Internet）\r\n     2、如果设备与电脑使用控制线连接并且打开了超级终端，在屏幕上会显示设备连接EasyServer 的状态，通过就会出显“EasyTrans server connected successful！”的提示信息，并将注册信息发往网守，如果注册通过就会出显“GK Registration[60] UP! ”的提示信息。如果不能正常出显以上提示，请安照安装前的准备工作中的第2 项《对路由器/共享器或防火墙的要求》进行检查；\r\n<img src=images/1.gif><img src=images/1.gif><img src=images/1.gif><img src=images/1.gif>', '2009-10-17 00:00:00'),
(4, '忘记登录设备的密码？（已经作废了）', '', '首先使用一个BIGCOS 的软件包将设备中的配置数据清空，然后下载适应设备使用的COS 软件包版本，有关BIGCOS 软件包可以在世纪网通或代理商方取得。', '2009-10-17 00:00:00'),
(5, 'Alerttime(s) 和Alertm', '', 'Alerttime 表示回铃时间，本端设备在收到“alerting ”信令之后，在该时间内未收到对端设备的“connect”(摘机) 信令则挂机。 Alertmode 表示回铃模式，分为terminal （终端）和relay（中继）两种方式，在line 和dial 下都有该配置。 \r\n', '2009-10-17 00:00:00'),
(6, 'Alerttime(s) 和Alertm', '', '<div class=newarticle>Alerttime 表示回铃时间，本端设备在收到“alerting ”信令之后，在该时间内未收到对端设备的“connect”(摘机) 信令则挂机。 Alertmode 表示回铃模式，分为terminal （终端）和relay（中继）两种方式，在line 和dial 下都有该配置。 \r\n</div><img src=images/2.gif><img src=images/2.gif>还是不太明白', '2009-10-17 00:00:00'),
(7, '不明白的话看这里', '', '<div class=newarticle><div class=newarticle>Alerttime 表示回铃时间，本端设备在收到“alerting ”信令之后，在该时间内未收到对端设备的“connect”(摘机) 信令则挂机。 Alertmode 表示回铃模式，分为terminal （终端）和relay（中继）两种方式，在line 和dial 下都有该配置。 \r\n</div><img src=images/2.gif><img src=images/2.gif>还是不太明白</div><img src=images/3.gif><img src=images/4.gif><img src=images/1.gif>\r\n不明白的话 可以再在我们公司的网站上查找相关信息', '2009-10-17 00:00:00'),
(8, '我没找到啊 ', '', '<div class=newarticle><div class=newarticle><div class=newarticle>Alerttime 表示回铃时间，本端设备在收到“alerting ”信令之后，在该时间内未收到对端设备的“connect”(摘机) 信令则挂机。 Alertmode 表示回铃模式，分为terminal （终端）和relay（中继）两种方式，在line 和dial 下都有该配置。 \r\n</div><img src=images/2.gif><img src=images/2.gif>还是不太明白</div><img src=images/3.gif><img src=images/4.gif><img src=images/1.gif>\r\n不明白的话 可以再在我们公司的网站上查找相关信息</div><img src=images/3.gif><img src=images/4.gif>\r\n真的没找到那些信息', '2009-10-17 00:00:00'),
(9, '怎么这么笨啊 ', '', '<div class=newarticle><div class=newarticle><div class=newarticle><div class=newarticle>Alerttime 表示回铃时间，本端设备在收到“alerting ”信令之后，在该时间内未收到对端设备的“connect”(摘机) 信令则挂机。 Alertmode 表示回铃模式，分为terminal （终端）和relay（中继）两种方式，在line 和dial 下都有该配置。 \r\n</div><img src=images/2.gif><img src=images/2.gif>还是不太明白</div><img src=images/3.gif><img src=images/4.gif><img src=images/1.gif>\r\n不明白的话 可以再在我们公司的网站上查找相关信息</div><img src=images/3.gif><img src=images/4.gif>\r\n真的没找到那些信息</div><img src=images/3.gif><img src=images/5.gif><img src=images/4.gif>\r\n找不到可以上google搜索下撒', '2009-10-17 00:00:00'),
(10, '如何调节增益？增益推荐值', '', '<img src=images/2.gif><img src=images/3.gif><img src=images/4.gif>\r\n配置语音增益在（Line）线路中有以下命令：\r\nIv | ov d(igital) | a(nalog) volume \r\niv : 设置语音端口的语音输入（Input）增益，对于本端设备来讲，其方向为 从电话侧到网络侧 \r\nov : 设置语音端口的语音输出(output) 增益，对于本端设备来讲，其方向为从网络侧到电话侧 \r\nd(igital): 设置数字的增益\r\na(nalog)： 设置模拟的增益\r\nvolume： 端口输入/出增益 \r\n', '2009-10-17 00:00:00');
