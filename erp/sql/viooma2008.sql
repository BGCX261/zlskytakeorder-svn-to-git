-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 01 月 07 日 08:00
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `viooma2008`
--

-- --------------------------------------------------------

--
-- 表的结构 `viooma_accounts`
--

CREATE TABLE `viooma_accounts` (
  `id` smallint(8) NOT NULL auto_increment,
  `atype` varchar(10) NOT NULL,
  `amoney` double NOT NULL,
  `abank` smallint(6) NOT NULL,
  `dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `apeople` varchar(10) NOT NULL,
  `atext` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `viooma_accounts`
--

INSERT INTO `viooma_accounts` (`id`, `atype`, `amoney`, `abank`, `dtime`, `apeople`, `atext`) VALUES
(1, '收入', 321321, 1, '2010-01-07 01:54:05', 'admin', '323123333333333'),
(2, '收入', 46, 1, '2010-01-07 05:04:58', 'admin', '销售产品收入现金，对应销售单号为：Vs000001'),
(3, '支出', 492, 1, '2010-01-07 05:05:13', 'admin', '进货支出金额，对应入库单号为：Vin000001'),
(4, '收入', 466, 1, '2010-01-07 05:07:31', 'admin', '销售产品收入现金，对应销售单号为：Vs000002'),
(5, '支出', 246, 1, '2010-01-07 05:08:22', 'admin', '进货支出金额，对应入库单号为：Vin000002'),
(6, '支出', 699, 1, '2010-01-07 05:09:24', 'admin', '客户退货返回金额，对应退单号为：Vl000001'),
(7, '支出', 466, 1, '2010-01-07 05:11:30', 'admin', '客户退货返回金额，对应退单号为：Vl000002');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_area`
--

CREATE TABLE `viooma_area` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `reid` int(10) unsigned NOT NULL default '0',
  `disorder` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3118 ;

--
-- 导出表中的数据 `viooma_area`
--

INSERT INTO `viooma_area` (`id`, `name`, `reid`, `disorder`) VALUES
(1, '北京市', 0, 0),
(102, '西城区', 1, 2),
(3116, '崇文区', 1, 0),
(104, '宣武区', 1, 0),
(105, '朝阳区', 1, 0),
(106, '海淀区', 1, 0),
(107, '丰台区', 1, 0),
(108, '石景山区', 1, 0),
(109, '门头沟区', 1, 0),
(110, '房山区', 1, 0),
(111, '通州区', 1, 0),
(112, '顺义区', 1, 0),
(113, '昌平区', 1, 0),
(114, '大兴区', 1, 0),
(115, '平谷县', 1, 0),
(116, '怀柔县', 1, 0),
(117, '密云县', 1, 0),
(118, '延庆县', 1, 0),
(2, '上海市', 0, 0),
(201, '黄浦区', 2, 0),
(202, '卢湾区', 2, 0),
(203, '徐汇区', 2, 0),
(204, '长宁区', 2, 0),
(205, '静安区', 2, 0),
(206, '普陀区', 2, 0),
(207, '闸北区', 2, 0),
(208, '虹口区', 2, 0),
(209, '杨浦区', 2, 0),
(210, '宝山区', 2, 0),
(211, '闵行区', 2, 0),
(212, '嘉定区', 2, 0),
(213, '浦东新区', 2, 0),
(214, '松江区', 2, 0),
(215, '金山区', 2, 0),
(216, '青浦区', 2, 0),
(217, '南汇区', 2, 0),
(218, '奉贤区', 2, 0),
(219, '崇明县', 2, 0),
(3, '天津市', 0, 0),
(301, '和平区', 3, 0),
(302, '河东区', 3, 0),
(303, '河西区', 3, 0),
(304, '南开区', 3, 0),
(305, '河北区', 3, 0),
(306, '红桥区', 3, 0),
(307, '塘沽区', 3, 0),
(308, '汉沽区', 3, 0),
(309, '大港区', 3, 0),
(310, '东丽区', 3, 0),
(311, '西青区', 3, 0),
(312, '北辰区', 3, 0),
(313, '津南区', 3, 0),
(314, '武清区', 3, 0),
(315, '宝坻区', 3, 0),
(316, '静海县', 3, 0),
(317, '宁河县', 3, 0),
(318, '蓟县', 3, 0),
(4, '重庆市', 0, 0),
(401, '渝中区', 4, 0),
(402, '大渡口区', 4, 0),
(403, '江北区', 4, 0),
(404, '沙坪坝区', 4, 0),
(405, '九龙坡区', 4, 0),
(406, '南岸区', 4, 0),
(407, '北碚区', 4, 0),
(408, '万盛区', 4, 0),
(409, '双桥区', 4, 0),
(410, '渝北区', 4, 0),
(411, '巴南区', 4, 0),
(412, '万州区', 4, 0),
(413, '涪陵区', 4, 0),
(414, '黔江区', 4, 0),
(415, '永川市', 4, 0),
(416, '合川市', 4, 0),
(417, '江津市', 4, 0),
(418, '南川市', 4, 0),
(419, '长寿县', 4, 0),
(420, '綦江县', 4, 0),
(421, '潼南县', 4, 0),
(422, '荣昌县', 4, 0),
(423, '璧山县', 4, 0),
(424, '大足县', 4, 0),
(425, '铜梁县', 4, 0),
(426, '梁平县', 4, 0),
(427, '城口县', 4, 0),
(428, '垫江县', 4, 0),
(429, '武隆县', 4, 0),
(430, '丰都县', 4, 0),
(431, '奉节县', 4, 0),
(432, '开县', 4, 0),
(433, '云阳县', 4, 0),
(434, '忠县', 4, 0),
(435, '巫溪县', 4, 0),
(436, '巫山县', 4, 0),
(437, '石柱县', 4, 0),
(438, '秀山县', 4, 0),
(439, '酉阳县', 4, 0),
(440, '彭水县', 4, 0),
(5, '广东省', 0, 0),
(501, '广州市', 5, 0),
(502, '深圳市', 5, 0),
(503, '珠海市', 5, 0),
(504, '汕头市', 5, 0),
(505, '韶关市', 5, 0),
(506, '河源市', 5, 0),
(507, '梅州市', 5, 0),
(508, '惠州市', 5, 0),
(509, '汕尾市', 5, 0),
(510, '东莞市', 5, 0),
(511, '中山市', 5, 0),
(512, '江门市', 5, 0),
(513, '佛山市', 5, 0),
(514, '阳江市', 5, 0),
(515, '湛江市', 5, 0),
(516, '茂名市', 5, 0),
(517, '肇庆市', 5, 0),
(518, '清远市', 5, 0),
(519, '潮州市', 5, 0),
(520, '揭阳市', 5, 0),
(521, '云浮市', 5, 0),
(6, '福建省', 0, 0),
(601, '福州市', 6, 0),
(602, '厦门市', 6, 0),
(603, '三明市', 6, 0),
(604, '莆田市', 6, 0),
(605, '泉州市', 6, 0),
(606, '漳州市', 6, 0),
(607, '南平市', 6, 0),
(608, '龙岩市', 6, 0),
(609, '宁德市', 6, 0),
(7, '浙江省', 0, 0),
(701, '杭州市', 7, 0),
(702, '宁波市', 7, 0),
(703, '温州市', 7, 0),
(704, '嘉兴市', 7, 0),
(705, '湖州市', 7, 0),
(706, '绍兴市', 7, 0),
(707, '金华市', 7, 0),
(708, '衢州市', 7, 0),
(709, '舟山市', 7, 0),
(710, '台州市', 7, 0),
(711, '丽水市', 7, 0),
(8, '江苏省', 0, 0),
(801, '南京市', 8, 0),
(802, '徐州市', 8, 0),
(803, '连云港市', 8, 0),
(804, '淮安市', 8, 0),
(805, '宿迁市', 8, 0),
(806, '盐城市', 8, 0),
(807, '扬州市', 8, 0),
(808, '泰州市', 8, 0),
(809, '南通市', 8, 0),
(810, '镇江市', 8, 0),
(811, '常州市', 8, 0),
(812, '无锡市', 8, 0),
(813, '苏州市', 8, 0),
(9, '山东省', 0, 0),
(901, '济南市', 9, 0),
(902, '青岛市', 9, 0),
(903, '淄博市', 9, 0),
(904, '枣庄市', 9, 0),
(905, '东营市', 9, 0),
(906, '潍坊市', 9, 0),
(907, '烟台市', 9, 0),
(908, '威海市', 9, 0),
(909, '济宁市', 9, 0),
(910, '泰安市', 9, 0),
(911, '日照市', 9, 0),
(912, '莱芜市', 9, 0),
(913, '德州市', 9, 0),
(914, '临沂市', 9, 0),
(915, '聊城市', 9, 0),
(916, '滨州市', 9, 0),
(917, '菏泽市', 9, 0),
(10, '辽宁省', 0, 0),
(1001, '沈阳市', 10, 0),
(1002, '大连市', 10, 0),
(1003, '鞍山市', 10, 0),
(1004, '抚顺市', 10, 0),
(1005, '本溪市', 10, 0),
(1006, '丹东市', 10, 0),
(1007, '锦州市', 10, 0),
(1008, '葫芦岛市', 10, 0),
(1009, '营口市', 10, 0),
(1010, '盘锦市', 10, 0),
(1011, '阜新市', 10, 0),
(1012, '辽阳市', 10, 0),
(1013, '铁岭市', 10, 0),
(1014, '朝阳市', 10, 0),
(11, '江西省', 0, 0),
(1101, '南昌市', 11, 0),
(1102, '景德镇市', 11, 0),
(1103, '萍乡市', 11, 0),
(1104, '新余市', 11, 0),
(1105, '九江市', 11, 0),
(1106, '鹰潭市', 11, 0),
(1107, '赣州市', 11, 0),
(1108, '吉安市', 11, 0),
(1109, '宜春市', 11, 0),
(1110, '抚州市', 11, 0),
(1111, '上饶市', 11, 0),
(12, '四川省', 0, 0),
(1201, '成都市', 12, 0),
(1202, '自贡市', 12, 0),
(1203, '攀枝花市', 12, 0),
(1204, '泸州市', 12, 0),
(1205, '德阳市', 12, 0),
(1206, '绵阳市', 12, 0),
(1207, '广元市', 12, 0),
(1208, '遂宁市', 12, 0),
(1209, '内江市', 12, 0),
(1210, '乐山市', 12, 0),
(1211, '南充市', 12, 0),
(1212, '宜宾市', 12, 0),
(1213, '广安市', 12, 0),
(1214, '达州市', 12, 0),
(1215, '巴中市', 12, 0),
(1216, '雅安市', 12, 0),
(1217, '眉山市', 12, 0),
(1218, '资阳市', 12, 0),
(1219, '阿坝州', 12, 0),
(1220, '甘孜州', 12, 0),
(1221, '凉山州', 12, 0),
(13, '陕西省', 0, 0),
(3114, '西安市', 13, 0),
(1302, '铜川市', 13, 0),
(1303, '宝鸡市', 13, 0),
(1304, '咸阳市', 13, 0),
(1305, '渭南市', 13, 0),
(1306, '延安市', 13, 0),
(1307, '汉中市', 13, 0),
(1308, '榆林市', 13, 0),
(1309, '安康市', 13, 0),
(1310, '商洛地区', 13, 0),
(14, '湖北省', 0, 0),
(1401, '武汉市', 14, 0),
(1402, '黄石市', 14, 0),
(1403, '襄樊市', 14, 0),
(1404, '十堰市', 14, 0),
(1405, '荆州市', 14, 0),
(1406, '宜昌市', 14, 0),
(1407, '荆门市', 14, 0),
(1408, '鄂州市', 14, 0),
(1409, '孝感市', 14, 0),
(1410, '黄冈市', 14, 0),
(1411, '咸宁市', 14, 0),
(1412, '随州市', 14, 0),
(1413, '仙桃市', 14, 0),
(1414, '天门市', 14, 0),
(1415, '潜江市', 14, 0),
(1416, '神农架', 14, 0),
(1417, '恩施州', 14, 0),
(15, '河南省', 0, 0),
(1501, '郑州市', 15, 0),
(1502, '开封市', 15, 0),
(1503, '洛阳市', 15, 0),
(1504, '平顶山市', 15, 0),
(1505, '焦作市', 15, 0),
(1506, '鹤壁市', 15, 0),
(1507, '新乡市', 15, 0),
(1508, '安阳市', 15, 0),
(1509, '濮阳市', 15, 0),
(1510, '许昌市', 15, 0),
(1511, '漯河市', 15, 0),
(1512, '三门峡市', 15, 0),
(1513, '南阳市', 15, 0),
(1514, '商丘市', 15, 0),
(1515, '信阳市', 15, 0),
(1516, '周口市', 15, 0),
(1517, '驻马店市', 15, 0),
(1518, '济源市', 15, 0),
(16, '河北省', 0, 0),
(1601, '石家庄市', 16, 0),
(1602, '唐山市', 16, 0),
(1603, '秦皇岛市', 16, 0),
(1604, '邯郸市', 16, 0),
(1605, '邢台市', 16, 0),
(1606, '保定市', 16, 0),
(1607, '张家口市', 16, 0),
(1608, '承德市', 16, 0),
(1609, '沧州市', 16, 0),
(1610, '廊坊市', 16, 0),
(1611, '衡水市', 16, 0),
(17, '山西省', 0, 0),
(1701, '太原市', 17, 0),
(1702, '大同市', 17, 0),
(1703, '阳泉市', 17, 0),
(1704, '长治市', 17, 0),
(1705, '晋城市', 17, 0),
(1706, '朔州市', 17, 0),
(1707, '晋中市', 17, 0),
(1708, '忻州市', 17, 0),
(1709, '临汾市', 17, 0),
(1710, '运城市', 17, 0),
(1711, '吕梁地区', 17, 0),
(18, '内蒙古', 0, 0),
(1801, '呼和浩特', 18, 0),
(1802, '包头市', 18, 0),
(1803, '乌海市', 18, 0),
(1804, '赤峰市', 18, 0),
(1805, '通辽市', 18, 0),
(1806, '鄂尔多斯', 18, 0),
(1807, '乌兰察布', 18, 0),
(1808, '锡林郭勒', 18, 0),
(1809, '呼伦贝尔', 18, 0),
(1810, '巴彦淖尔', 18, 0),
(1811, '阿拉善盟', 18, 0),
(1812, '兴安盟', 18, 0),
(19, '吉林省', 0, 0),
(1901, '长春市', 19, 0),
(1902, '吉林市', 19, 0),
(1903, '四平市', 19, 0),
(1904, '辽源市', 19, 0),
(1905, '通化市', 19, 0),
(1906, '白山市', 19, 0),
(1907, '松原市', 19, 0),
(1908, '白城市', 19, 0),
(1909, '延边州', 19, 0),
(20, '黑龙江', 0, 0),
(2001, '哈尔滨市', 20, 0),
(2002, '齐齐哈尔', 20, 0),
(2003, '鹤岗市', 20, 0),
(2004, '双鸭山市', 20, 0),
(2005, '鸡西市', 20, 0),
(2006, '大庆市', 20, 0),
(2007, '伊春市', 20, 0),
(2008, '牡丹江市', 20, 0),
(2009, '佳木斯市', 20, 0),
(2010, '七台河市', 20, 0),
(2011, '黑河市', 20, 0),
(2012, '绥化市', 20, 0),
(2013, '大兴安岭', 20, 0),
(21, '安徽省', 0, 0),
(2101, '合肥市', 21, 0),
(2102, '芜湖市', 21, 0),
(2103, '蚌埠市', 21, 0),
(2104, '淮南市', 21, 0),
(2105, '马鞍山市', 21, 0),
(2106, '淮北市', 21, 0),
(2107, '铜陵市', 21, 0),
(2108, '安庆市', 21, 0),
(2109, '黄山市', 21, 0),
(2110, '滁州市', 21, 0),
(2111, '阜阳市', 21, 0),
(2112, '宿州市', 21, 0),
(2113, '巢湖市', 21, 0),
(2114, '六安市', 21, 0),
(2115, '亳州市', 21, 0),
(2116, '宣城市', 21, 0),
(2117, '池州市', 21, 0),
(22, '湖南省', 0, 0),
(2201, '长沙市', 22, 0),
(2202, '株州市', 22, 0),
(2203, '湘潭市', 22, 0),
(2204, '衡阳市', 22, 0),
(2205, '邵阳市', 22, 0),
(2206, '岳阳市', 22, 0),
(2207, '常德市', 22, 0),
(2208, '张家界市', 22, 0),
(2209, '益阳市', 22, 0),
(2210, '郴州市', 22, 0),
(2211, '永州市', 22, 0),
(2212, '怀化市', 22, 0),
(2213, '娄底市', 22, 0),
(2214, '湘西州', 22, 0),
(23, '广西区', 0, 0),
(2301, '南宁市', 23, 0),
(2302, '柳州市', 23, 0),
(2303, '桂林市', 23, 0),
(2304, '梧州市', 23, 0),
(2305, '北海市', 23, 0),
(2306, '防城港市', 23, 0),
(2307, '钦州市', 23, 0),
(2308, '贵港市', 23, 0),
(2309, '玉林市', 23, 0),
(2310, '南宁地区', 23, 0),
(2311, '柳州地区', 23, 0),
(2312, '贺州地区', 23, 0),
(2313, '百色地区', 23, 0),
(2314, '河池地区', 23, 0),
(24, '海南省', 0, 0),
(2401, '海口市', 24, 0),
(2402, '三亚市', 24, 0),
(2403, '五指山市', 24, 0),
(2404, '琼海市', 24, 0),
(2405, '儋州市', 24, 0),
(2406, '琼山市', 24, 0),
(2407, '文昌市', 24, 0),
(2408, '万宁市', 24, 0),
(2409, '东方市', 24, 0),
(2410, '澄迈县', 24, 0),
(2411, '定安县', 24, 0),
(2412, '屯昌县', 24, 0),
(2413, '临高县', 24, 0),
(2414, '白沙县', 24, 0),
(2415, '昌江县', 24, 0),
(2416, '乐东县', 24, 0),
(2417, '陵水县', 24, 0),
(2418, '保亭县', 24, 0),
(2419, '琼中县', 24, 0),
(25, '云南省', 0, 0),
(2501, '昆明市', 25, 0),
(2502, '曲靖市', 25, 0),
(2503, '玉溪市', 25, 0),
(2504, '保山市', 25, 0),
(2505, '昭通市', 25, 0),
(2506, '思茅地区', 25, 0),
(2507, '临沧地区', 25, 0),
(2508, '丽江地区', 25, 0),
(2509, '文山州', 25, 0),
(2510, '红河州', 25, 0),
(2511, '西双版纳', 25, 0),
(2512, '楚雄州', 25, 0),
(2513, '大理州', 25, 0),
(2514, '德宏州', 25, 0),
(2515, '怒江州', 25, 0),
(2516, '迪庆州', 25, 0),
(26, '贵州省', 0, 0),
(2601, '贵阳市', 26, 0),
(2602, '六盘水市', 26, 0),
(2603, '遵义市', 26, 0),
(2604, '安顺市', 26, 0),
(2605, '铜仁地区', 26, 0),
(2606, '毕节地区', 26, 0),
(2607, '黔西南州', 26, 0),
(2608, '黔东南州', 26, 0),
(2609, '黔南州', 26, 0),
(27, '西藏区', 0, 0),
(2701, '拉萨市', 27, 0),
(2702, '那曲地区', 27, 0),
(2703, '昌都地区', 27, 0),
(2704, '山南地区', 27, 0),
(2705, '日喀则', 27, 0),
(2706, '阿里地区', 27, 0),
(2707, '林芝地区', 27, 0),
(28, '甘肃省', 0, 0),
(2801, '兰州市', 28, 0),
(2802, '金昌市', 28, 0),
(2803, '白银市', 28, 0),
(2804, '天水市', 28, 0),
(2805, '嘉峪关市', 28, 0),
(2806, '武威市', 28, 0),
(2807, '定西地区', 28, 0),
(2808, '平凉地区', 28, 0),
(2809, '庆阳地区', 28, 0),
(2810, '陇南地区', 28, 0),
(2811, '张掖地区', 28, 0),
(2812, '酒泉地区', 28, 0),
(2813, '甘南州', 28, 0),
(2814, '临夏州', 28, 0),
(29, '宁夏区', 0, 0),
(2901, '银川市', 29, 0),
(2902, '石嘴山市', 29, 0),
(2903, '吴忠市', 29, 0),
(2904, '固原市', 29, 0),
(30, '青海省', 0, 0),
(3001, '西宁市', 30, 0),
(3002, '海东地区', 30, 0),
(3003, '海北州', 30, 0),
(3004, '黄南州', 30, 0),
(3005, '海南州', 30, 0),
(3006, '果洛州', 30, 0),
(3007, '玉树州', 30, 0),
(3008, '海西州', 30, 0),
(31, '新疆区', 0, 0),
(3101, '乌鲁木齐', 31, 0),
(3102, '克拉玛依', 31, 0),
(3103, '石河子市', 31, 0),
(3104, '吐鲁番', 31, 0),
(3105, '哈密地区', 31, 0),
(3106, '和田地区', 31, 0),
(3107, '阿克苏', 31, 0),
(3108, '喀什地区', 31, 0),
(3109, '克孜勒苏', 31, 0),
(3110, '巴音郭楞', 31, 0),
(3111, '昌吉州', 31, 0),
(3112, '博尔塔拉', 31, 0),
(3113, '伊犁州', 31, 0),
(3117, '东城区', 1, 0),
(32, '香港区', 0, 0),
(33, '澳门区', 0, 0),
(35, '台湾省', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_bank`
--

CREATE TABLE `viooma_bank` (
  `id` smallint(6) NOT NULL auto_increment,
  `bank_name` varchar(30) NOT NULL,
  `bank_money` float NOT NULL,
  `bank_account` varchar(30) NOT NULL,
  `bank_default` smallint(6) NOT NULL,
  `bank_text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_bank`
--

INSERT INTO `viooma_bank` (`id`, `bank_name`, `bank_money`, `bank_account`, `bank_default`, `bank_text`) VALUES
(1, '工商银行', 9.99861e+006, '34444444444444444234', 1, '工商银行');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_basic`
--

CREATE TABLE `viooma_basic` (
  `id` smallint(6) NOT NULL auto_increment,
  `cp_number` varchar(15) NOT NULL,
  `cp_tm` varchar(15) NOT NULL,
  `cp_name` varchar(50) NOT NULL,
  `cp_gg` varchar(50) NOT NULL,
  `cp_categories` smallint(6) NOT NULL,
  `cp_categories_down` smallint(6) NOT NULL,
  `cp_dwname` smallint(6) NOT NULL,
  `cp_jj` float NOT NULL,
  `cp_sale` float NOT NULL,
  `cp_saleall` float NOT NULL,
  `cp_sdate` date NOT NULL default '0000-00-00',
  `cp_edate` date NOT NULL default '0000-00-00',
  `cp_gys` varchar(50) NOT NULL,
  `cp_helpword` varchar(50) NOT NULL,
  `cp_bz` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `viooma_basic`
--

INSERT INTO `viooma_basic` (`id`, `cp_number`, `cp_tm`, `cp_name`, `cp_gg`, `cp_categories`, `cp_categories_down`, `cp_dwname`, `cp_jj`, `cp_sale`, `cp_saleall`, `cp_sdate`, `cp_edate`, `cp_gys`, `cp_helpword`, `cp_bz`) VALUES
(3, '1262828977', '4324324234234', '潘亭洗发水人', '321312', 1, 2, 1, 123, 233, 233, '2010-01-01', '2010-01-16', '广州日常生活用品公司', 'ptxfsr', '潘亭洗发水人'),
(4, '1262829020', '3254545345', '潘亭洗发水人他', '321312432432', 1, 2, 1, 123, 233, 233, '2010-01-06', '2010-01-15', '广州日常生活用品公司', 'ptxfsrt', '潘亭洗发水人他');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_boss`
--

CREATE TABLE `viooma_boss` (
  `id` int(11) NOT NULL auto_increment,
  `boss` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `logindate` datetime NOT NULL,
  `loginip` varchar(15) NOT NULL,
  `errnumber` int(11) NOT NULL,
  `rank` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=11 ;

--
-- 导出表中的数据 `viooma_boss`
--

INSERT INTO `viooma_boss` (`id`, `boss`, `password`, `logindate`, `loginip`, `errnumber`, `rank`) VALUES
(10, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2008-08-18 20:35:28', '127.0.0.1', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_categories`
--

CREATE TABLE `viooma_categories` (
  `id` smallint(6) NOT NULL auto_increment,
  `categories` varchar(50) NOT NULL,
  `reid` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `viooma_categories`
--

INSERT INTO `viooma_categories` (`id`, `categories`, `reid`) VALUES
(1, '日常用品', 0),
(2, '洗发水', 1);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_config`
--

CREATE TABLE `viooma_config` (
  `id` int(11) NOT NULL,
  `config_name` varchar(30) NOT NULL,
  `config_mem` varchar(50) NOT NULL,
  `config_value` varchar(30) NOT NULL,
  `config_type` varchar(20) NOT NULL,
  `config_len` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `viooma_config`
--

INSERT INTO `viooma_config` (`id`, `config_name`, `config_mem`, `config_value`, `config_type`, `config_len`) VALUES
(1, 'cfg_webname', '公司名称', '广州天地进口公司', 'string', '8'),
(2, 'cfg_basehost', '站点根网址', 'http://localhost', 'string', '8'),
(3, 'cfg_cmspath', '安装目录', '', 'string', '8'),
(5, 'cfg_cookie_encode', 'cookie加密码', 'NwLEl6742L', 'string', '8'),
(4, 'cfg_indexurl', '网页主页链接', '/', 'string', '8'),
(6, 'cfg_adminemail', '站长EMAIL', 'admin@yourmail.com', 'string', '8'),
(7, 'cfg_backup_dir', '数据备份目录', 'backup_data', 'string', '30'),
(8, 'cfg_keeptime', 'Cookie保持时间', '2', 'smallint', '6'),
(9, 'cfg_address', '公司地址', '广州天地进口公司', 'string', '200'),
(10, 'cfg_conact', '联系人', '王天牛', 'string', '10'),
(11, 'cfg_phone', '联系电话', '212121212', 'string', '15'),
(12, 'cfg_islevel', '是否启用会员等级', '0', 'smallint', '6'),
(13, 'cfg_isdiscount', '是否按等级打折', '0', 'smallint', '6'),
(14, 'cfg_isalarm', '库存报警', '1', 'smallint', '6'),
(15, 'cfg_isshow', '报表里是否显示详细信息', '1', 'smallint', '6'),
(16, 'cfg_record', '显示记录数', '10', 'smallint', '6'),
(17, 'cfg_way', '员工业务提成', '1', 'smallint', '6');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_dw`
--

CREATE TABLE `viooma_dw` (
  `id` smallint(6) NOT NULL auto_increment,
  `dwname` varchar(20) NOT NULL,
  `reid` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_dw`
--

INSERT INTO `viooma_dw` (`id`, `dwname`, `reid`) VALUES
(1, '吨', 0);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_flink`
--

CREATE TABLE `viooma_flink` (
  `ID` int(11) NOT NULL auto_increment,
  `sortrank` int(11) NOT NULL default '0',
  `url` varchar(100) NOT NULL default '',
  `webname` varchar(30) NOT NULL default '',
  `msg` varchar(250) NOT NULL default '',
  `email` varchar(100) NOT NULL default '',
  `logo` varchar(100) NOT NULL default '',
  `dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `typeid` int(11) NOT NULL default '0',
  `ischeck` smallint(6) NOT NULL default '1',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_flink`
--

INSERT INTO `viooma_flink` (`ID`, `sortrank`, `url`, `webname`, `msg`, `email`, `logo`, `dtime`, `typeid`, `ischeck`) VALUES
(1, 1, 'http://www.viooma.com', '进销存系统', '进销存系统--强大的PHP进销存系统', '', 'http://www.viooma.com/uploadfiles/flink.gif', '2008-08-19 11:31:29', 1, 2);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_group`
--

CREATE TABLE `viooma_group` (
  `id` smallint(6) NOT NULL auto_increment,
  `groupname` varchar(30) NOT NULL,
  `sub` float NOT NULL default '10',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_group`
--

INSERT INTO `viooma_group` (`id`, `groupname`, `sub`) VALUES
(1, '小组', 10);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_guest`
--

CREATE TABLE `viooma_guest` (
  `id` smallint(6) NOT NULL auto_increment,
  `g_name` varchar(10) NOT NULL,
  `g_sex` varchar(5) NOT NULL,
  `g_address` varchar(120) NOT NULL,
  `g_phone` varchar(15) NOT NULL,
  `g_qq` varchar(50) NOT NULL,
  `g_birthday` date NOT NULL default '0000-00-00',
  `g_card` varchar(50) NOT NULL,
  `g_group` smallint(6) NOT NULL,
  `g_people` varchar(20) NOT NULL,
  `g_dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_guest`
--

INSERT INTO `viooma_guest` (`id`, `g_name`, `g_sex`, `g_address`, `g_phone`, `g_qq`, `g_birthday`, `g_card`, `g_group`, `g_people`, `g_dtime`) VALUES
(1, '好会员', '男', '广州天河', '3213123123', '2131232321', '2008-08-01', '3213123123', 1, 'admin', '2010-01-07 05:07:28');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_gys`
--

CREATE TABLE `viooma_gys` (
  `id` smallint(6) NOT NULL auto_increment,
  `g_name` varchar(100) character set gb2312 NOT NULL,
  `g_address` varchar(120) character set gb2312 NOT NULL,
  `g_people` varchar(10) character set gb2312 NOT NULL,
  `g_phone` varchar(12) NOT NULL,
  `g_qq` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_gys`
--

INSERT INTO `viooma_gys` (`id`, `g_name`, `g_address`, `g_people`, `g_phone`, `g_qq`) VALUES
(1, '广州日常生活用品公司', '广州天河', '王三牛', '3213123123', '2131232321');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_kc`
--

CREATE TABLE `viooma_kc` (
  `id` smallint(6) NOT NULL auto_increment,
  `productid` varchar(15) NOT NULL,
  `number` int(11) NOT NULL,
  `labid` smallint(6) NOT NULL,
  `rdh` varchar(20) NOT NULL,
  `dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `viooma_kc`
--

INSERT INTO `viooma_kc` (`id`, `productid`, `number`, `labid`, `rdh`, `dtime`) VALUES
(1, '1262829020', 2, 1, 'Vin000001', '2010-01-07 01:51:44'),
(2, '1262828977', 2, 1, 'Vin000001', '2010-01-07 05:05:17'),
(3, '1262828648', 2, 1, 'Vin000002', '2010-01-07 05:08:28');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_kcbackgys`
--

CREATE TABLE `viooma_kcbackgys` (
  `id` smallint(6) NOT NULL auto_increment,
  `productid` varchar(15) NOT NULL,
  `number` int(11) NOT NULL,
  `labid` smallint(6) NOT NULL,
  `rdh` varchar(20) NOT NULL,
  `dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `viooma_kcbackgys`
--


-- --------------------------------------------------------

--
-- 表的结构 `viooma_lab`
--

CREATE TABLE `viooma_lab` (
  `id` smallint(6) NOT NULL auto_increment,
  `l_name` varchar(30) NOT NULL,
  `l_city` varchar(30) NOT NULL,
  `l_mang` varchar(10) NOT NULL,
  `l_default` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=2 ;

--
-- 导出表中的数据 `viooma_lab`
--

INSERT INTO `viooma_lab` (`id`, `l_name`, `l_city`, `l_mang`, `l_default`) VALUES
(1, '广州仓库', '广州', '王大牛', 1);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_mainkc`
--

CREATE TABLE `viooma_mainkc` (
  `id` smallint(6) NOT NULL auto_increment,
  `p_id` varchar(15) NOT NULL,
  `l_id` smallint(6) NOT NULL,
  `d_id` varchar(20) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `viooma_mainkc`
--

INSERT INTO `viooma_mainkc` (`id`, `p_id`, `l_id`, `d_id`, `number`) VALUES
(1, '1262829020', 1, '', 2),
(2, '1262828977', 1, '', 5),
(3, '1262828648', 1, '', 2);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_menu`
--

CREATE TABLE `viooma_menu` (
  `id` int(10) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `reid` int(10) NOT NULL,
  `rank` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=49 ;

--
-- 导出表中的数据 `viooma_menu`
--

INSERT INTO `viooma_menu` (`id`, `name`, `url`, `reid`, `rank`) VALUES
(1, '快捷操作菜单', '', 0, ''),
(9, '系统变量设置', 'system_basic.php', 1, ''),
(11, '产品入库', 'system_rk.php', 1, ''),
(12, '库存查询', 'system_kc.php', 1, ''),
(13, '产品销售前台', 'sale.php', 1, ''),
(14, '客户管理', 'system_guest.php', 1, ''),
(2, '系统设置', '', 0, ''),
(16, '系统变量设置', 'system_basic.php', 2, ''),
(17, '产品基本信息', 'system_basic_cp.php', 2, ''),
(18, '产品分类管理', 'system_class.php', 2, ''),
(19, '产品计量单位管理', 'system_dw.php', 2, ''),
(20, '供应商管理', 'system_gys.php', 2, ''),
(21, '员工管理', 'system_worker.php', 2, ''),
(22, '仓库管理', 'system_lab.php', 2, ''),
(3, '入库管理', '', 0, ''),
(23, '产品入库', 'system_rk.php', 3, ''),
(24, '入库记录查询', 'system_rk.php?action=seek', 3, ''),
(25, '退回供应商', 'system_gys_back.php', 3, ''),
(26, '退回供应商查询', 'system_gys_back.php?action=seek', 3, ''),
(4, '销售管理', '', 0, ''),
(27, '产品销售平台', 'sale.php', 4, ''),
(28, '销售记录查询', 'sale.php?action=seek', 4, ''),
(29, '客户退货管理', 'sale_back.php', 4, ''),
(30, '退货记录', 'sale_back.php?action=seek', 4, ''),
(5, '库存管理', '', 0, ''),
(32, '库存情况查询', 'system_kc.php', 5, ''),
(35, '库存缺货查询', 'system_kc_lost.php', 5, ''),
(6, '客户管理', '', 0, ''),
(36, '添加新客户', 'system_guest.php?action=new', 6, ''),
(37, '客户列表', 'system_guest.php', 6, ''),
(38, '客户分组', 'guest_group.php', 6, ''),
(7, '统计报表', '', 0, ''),
(39, '入库报表', 'report_rk.php', 7, ''),
(40, '销售报表', 'report_sale.php', 7, ''),
(41, '退回供应商报表', 'report_b_gys.php', 7, ''),
(42, '退货报表', 'report_s_back.php', 7, ''),
(43, '作废报表', 'report_none.php', 7, ''),
(44, '员工工资报表', 'report_worker.php', 7, ''),
(8, '财务管理', '', 0, ''),
(45, '帐户管理', 'bank.php', 8, ''),
(47, '手动添加帐务', 'add_money.php', 8, ''),
(48, '帐务查询', 'system_money.php', 8, '');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_recordline`
--

CREATE TABLE `viooma_recordline` (
  `id` int(11) NOT NULL auto_increment,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `userid` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=69 ;

--
-- 导出表中的数据 `viooma_recordline`
--

INSERT INTO `viooma_recordline` (`id`, `message`, `date`, `ip`, `userid`) VALUES
(1, '正常登入进销存系统！', '2010-01-06 20:49:44', '127.0.0.1', 'admin'),
(2, '正常登入进销存系统！', '2010-01-06 20:50:25', '127.0.0.1', 'admin'),
(3, '添加产品基本信息 成功', '2010-01-06 20:54:06', '127.0.0.1', 'admin'),
(4, '添加仓库成功', '2010-01-07 09:32:58', '127.0.0.1', 'admin'),
(5, '修改仓库广州仓库资料成功', '2010-01-07 09:33:02', '127.0.0.1', 'admin'),
(6, '添加职员王小牛成功', '2010-01-07 09:34:47', '127.0.0.1', 'admin'),
(7, '添加职员王哈牛成功', '2010-01-07 09:35:23', '127.0.0.1', 'admin'),
(8, '添加供应商广州日常生活用品公司成功', '2010-01-07 09:36:41', '127.0.0.1', 'admin'),
(9, '添加计量单位吨成功', '2010-01-07 09:36:50', '127.0.0.1', 'admin'),
(10, '修改基本单位吨成功', '2010-01-07 09:36:54', '127.0.0.1', 'admin'),
(11, '修改基本单位吨成功', '2010-01-07 09:36:58', '127.0.0.1', 'admin'),
(12, '修改基本单位吨成功', '2010-01-07 09:37:02', '127.0.0.1', 'admin'),
(13, '修改基本单位吨成功', '2010-01-07 09:37:06', '127.0.0.1', 'admin'),
(14, '修改基本单位吨成功', '2010-01-07 09:38:05', '127.0.0.1', 'admin'),
(15, '修改供应商广州日常生活用品公司成功', '2010-01-07 09:43:23', '127.0.0.1', 'admin'),
(16, '添加顶级分类日常用品成功', '2010-01-07 09:43:50', '127.0.0.1', 'admin'),
(17, '添加子分类洗发水成功', '2010-01-07 09:44:00', '127.0.0.1', 'admin'),
(18, '添加产品基本信息潘亭洗发水 成功', '2010-01-07 09:44:54', '127.0.0.1', 'admin'),
(19, '成功修改了系统配置文件config_base.php', '2010-01-07 09:49:14', '127.0.0.1', 'admin'),
(20, '添加产品基本信息潘亭洗发水人 成功', '2010-01-07 01:50:18', '127.0.0.1', 'admin'),
(21, '添加产品基本信息潘亭洗发水人他 成功', '2010-01-07 01:51:15', '127.0.0.1', 'admin'),
(22, '添加银行账户工商银行成功', '2010-01-07 01:52:38', '127.0.0.1', 'admin'),
(23, '手动添加账务成功', '2010-01-07 01:54:05', '127.0.0.1', 'admin'),
(24, '正常登入进销存系统！', '2010-01-07 02:14:31', '127.0.0.1', 'admin'),
(25, '正常登入进销存系统！', '2010-01-07 02:24:44', '127.0.0.1', 'admin'),
(26, '用户或密码错误被系统拒绝登陆！', '2010-01-07 02:24:56', '127.0.0.1', 'admin'),
(27, '正常登入进销存系统！', '2010-01-07 02:26:17', '127.0.0.1', 'admin'),
(28, '正常登入进销存系统！', '2010-01-07 02:54:45', '127.0.0.1', 'admin'),
(29, '正常登入进销存系统！', '2010-01-07 02:56:36', '127.0.0.1', 'admin'),
(30, '用户或密码错误被系统拒绝登陆！', '2010-01-07 03:17:39', '127.0.0.1', 'admin'),
(31, '正常登入进销存系统！', '2010-01-07 03:17:49', '127.0.0.1', 'admin'),
(32, '正常登入进销存系统！', '2010-01-07 03:20:16', '127.0.0.1', 'admin'),
(33, '正常登入进销存系统！', '2010-01-07 03:22:09', '127.0.0.1', 'admin'),
(34, '用户或密码错误被系统拒绝登陆！', '2010-01-07 04:18:25', '127.0.0.1', 'admin'),
(35, '正常登入进销存系统！', '2010-01-07 04:18:40', '127.0.0.1', 'admin'),
(36, '正常登入进销存系统！', '2010-01-07 04:23:19', '127.0.0.1', 'admin'),
(37, '正常登入进销存系统！', '2010-01-07 04:48:19', '127.0.0.1', 'admin'),
(38, '正常登入进销存系统！', '2010-01-07 04:54:45', '127.0.0.1', 'admin'),
(39, '正常登入进销存系统！', '2010-01-07 04:56:39', '127.0.0.1', 'admin'),
(40, '正常登入进销存系统！', '2010-01-07 04:57:24', '127.0.0.1', 'admin'),
(41, '正常登入进销存系统！', '2010-01-07 04:58:19', '127.0.0.1', 'admin'),
(42, '正常登入进销存系统！', '2010-01-07 04:58:53', '127.0.0.1', 'admin'),
(43, '正常登入进销存系统！', '2010-01-07 05:02:36', '127.0.0.1', 'admin'),
(44, '正常登入进销存系统！', '2010-01-07 05:04:25', '127.0.0.1', 'admin'),
(45, '退货单Vs000001成功保存', '2010-01-07 05:05:07', '127.0.0.1', 'admin'),
(46, '入库单Vin000001成功保存', '2010-01-07 05:05:21', '127.0.0.1', 'admin'),
(47, '添加会员分组小组成功', '2010-01-07 05:07:00', '127.0.0.1', 'admin'),
(48, '添加会员好会员成功', '2010-01-07 05:07:28', '127.0.0.1', 'admin'),
(49, '退货单Vs000002成功保存', '2010-01-07 05:07:40', '127.0.0.1', 'admin'),
(50, '入库单Vin000002成功保存', '2010-01-07 05:08:29', '127.0.0.1', 'admin'),
(51, '成功删除产品基本信息(ID为1)', '2010-01-07 05:09:02', '127.0.0.1', 'admin'),
(52, '成功删除产品基本信息(ID为2)', '2010-01-07 05:09:09', '127.0.0.1', 'admin'),
(53, '退货单Vl000001成功保存', '2010-01-07 05:09:32', '127.0.0.1', 'admin'),
(54, '退货单Vl000002成功保存', '2010-01-07 05:11:36', '127.0.0.1', 'admin'),
(55, '正常登入进销存系统！', '2010-01-07 05:27:50', '127.0.0.1', 'admin'),
(56, '正常登入进销存系统！', '2010-01-07 05:28:03', '127.0.0.1', 'admin'),
(57, '正常登入进销存系统！', '2010-01-07 05:30:17', '127.0.0.1', 'admin'),
(58, '正常登入进销存系统！', '2010-01-07 05:30:43', '127.0.0.1', 'admin'),
(59, '正常登入进销存系统！', '2010-01-07 05:32:10', '127.0.0.1', 'admin'),
(60, '正常登入进销存系统！', '2010-01-07 05:32:32', '127.0.0.1', 'admin'),
(61, '正常登入进销存系统！', '2010-01-07 05:34:21', '127.0.0.1', 'admin'),
(62, '正常登入进销存系统！', '2010-01-07 05:36:16', '127.0.0.1', 'admin'),
(63, '正常登入进销存系统！', '2010-01-07 05:40:06', '127.0.0.1', 'admin'),
(64, '正常登入进销存系统！', '2010-01-07 05:40:47', '127.0.0.1', 'admin'),
(65, '正常登入进销存系统！', '2010-01-07 05:44:06', '127.0.0.1', 'admin'),
(66, '正常登入进销存系统！', '2010-01-07 07:34:07', '127.0.0.1', 'admin'),
(67, '正常登入进销存系统！', '2010-01-07 07:50:40', '127.0.0.1', 'admin'),
(68, '正常登入进销存系统！', '2010-01-07 07:51:08', '127.0.0.1', 'admin');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_reportbackgys`
--

CREATE TABLE `viooma_reportbackgys` (
  `id` smallint(6) NOT NULL auto_increment,
  `r_dh` varchar(20) NOT NULL,
  `r_people` varchar(10) NOT NULL,
  `r_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_status` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk AUTO_INCREMENT=1 ;

--
-- 导出表中的数据 `viooma_reportbackgys`
--


-- --------------------------------------------------------

--
-- 表的结构 `viooma_reportrk`
--

CREATE TABLE `viooma_reportrk` (
  `id` smallint(6) NOT NULL auto_increment,
  `r_dh` varchar(20) NOT NULL,
  `r_people` varchar(10) NOT NULL,
  `r_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_status` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `viooma_reportrk`
--

INSERT INTO `viooma_reportrk` (`id`, `r_dh`, `r_people`, `r_date`, `r_status`) VALUES
(1, 'Vin000001', 'admin', '2010-01-07 05:05:13', 1),
(2, 'Vin000002', 'admin', '2010-01-07 05:08:22', 1);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_reportsale`
--

CREATE TABLE `viooma_reportsale` (
  `id` smallint(6) NOT NULL auto_increment,
  `r_dh` varchar(20) NOT NULL,
  `r_people` varchar(10) NOT NULL,
  `r_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_status` smallint(6) NOT NULL default '0',
  `r_adid` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `viooma_reportsale`
--

INSERT INTO `viooma_reportsale` (`id`, `r_dh`, `r_people`, `r_date`, `r_status`, `r_adid`) VALUES
(1, 'Vs000001', 'admin', '2010-01-07 05:04:58', 1, '王小牛'),
(2, 'Vs000002', 'admin', '2010-01-07 05:07:31', 1, '王小牛');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_reportsback`
--

CREATE TABLE `viooma_reportsback` (
  `id` smallint(6) NOT NULL auto_increment,
  `r_dh` varchar(20) NOT NULL,
  `r_people` varchar(10) NOT NULL,
  `r_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_status` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `viooma_reportsback`
--

INSERT INTO `viooma_reportsback` (`id`, `r_dh`, `r_people`, `r_date`, `r_status`) VALUES
(1, 'Vl000001', 'admin', '2010-01-07 05:09:24', 1),
(2, 'Vl000002', 'admin', '2010-01-07 05:11:30', 1);

-- --------------------------------------------------------

--
-- 表的结构 `viooma_sale`
--

CREATE TABLE `viooma_sale` (
  `id` smallint(6) NOT NULL auto_increment,
  `productid` varchar(15) NOT NULL,
  `number` int(11) NOT NULL,
  `rdh` varchar(20) NOT NULL,
  `dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `viooma_sale`
--

INSERT INTO `viooma_sale` (`id`, `productid`, `number`, `rdh`, `dtime`) VALUES
(1, '1262828648', 2, 'Vs000001', '2010-01-07 05:05:06'),
(2, '1262828977', 2, 'Vs000002', '2010-01-07 05:07:36'),
(3, '1262828977', 2, 'Vs000003', '2010-01-07 05:08:58');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_saleback`
--

CREATE TABLE `viooma_saleback` (
  `id` smallint(6) NOT NULL auto_increment,
  `productid` varchar(15) NOT NULL,
  `number` int(11) NOT NULL,
  `rdh` varchar(20) NOT NULL,
  `dtime` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_text` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `viooma_saleback`
--

INSERT INTO `viooma_saleback` (`id`, `productid`, `number`, `rdh`, `dtime`, `r_text`) VALUES
(1, '1262828977', 3, 'Vl000001', '2010-01-07 05:09:31', '潘亭洗发水人'),
(2, '1262828977', 2, 'Vl000002', '2010-01-07 05:11:36', '潘亭洗发水人');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_staff`
--

CREATE TABLE `viooma_staff` (
  `id` smallint(6) NOT NULL auto_increment,
  `s_name` varchar(10) NOT NULL,
  `s_address` varchar(120) NOT NULL,
  `s_phone` varchar(15) NOT NULL,
  `s_part` varchar(50) NOT NULL,
  `s_way` smallint(6) NOT NULL default '0',
  `s_money` float NOT NULL,
  `s_utype` smallint(6) NOT NULL,
  `s_duty` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=3 ;

--
-- 导出表中的数据 `viooma_staff`
--

INSERT INTO `viooma_staff` (`id`, `s_name`, `s_address`, `s_phone`, `s_part`, `s_way`, `s_money`, `s_utype`, `s_duty`) VALUES
(1, '王小牛', '广州天河区', '156230000.', '销售部', 0, 0, 10, '销售组长'),
(2, '王哈牛', '广州天河区', '156230000.', '仓库', 0, 0, 5, '库存组长');

-- --------------------------------------------------------

--
-- 表的结构 `viooma_usertype`
--

CREATE TABLE `viooma_usertype` (
  `rank` smallint(6) NOT NULL,
  `typename` varchar(30) NOT NULL,
  `system` smallint(6) NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

--
-- 导出表中的数据 `viooma_usertype`
--

INSERT INTO `viooma_usertype` (`rank`, `typename`, `system`, `content`) VALUES
(1, '超级管理员', 1, 'admin_AllowAll'),
(5, '仓库管理员', 1, 'c_ACClab'),
(10, '销售管理员', 1, 's_ACCsale'),
(20, '财务管理员', 1, 's_ACCmon');
