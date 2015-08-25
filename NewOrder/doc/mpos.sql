-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 05 月 11 日 15:48
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mpos`
--

-- --------------------------------------------------------

--
-- 表的结构 `mpos_fitem`
--

CREATE TABLE `mpos_fitem` (
  `item_no` char(16) NOT NULL COMMENT '菜货品编号',
  `en_item_name` char(20) NOT NULL COMMENT '菜英文名',
  `lv_item_name` char(20) NOT NULL COMMENT '菜lv名',
  `category_no` char(4) NOT NULL COMMENT '菜类型编号',
  `en_cate_name` char(20) NOT NULL COMMENT '菜类型英文名',
  `lv_cate_name` char(20) NOT NULL COMMENT '菜类型lv名',
  `price` decimal(12,2) NOT NULL COMMENT '价格',
  UNIQUE KEY `ITEMNO` (`item_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `mpos_fitem`
--

INSERT INTO `mpos_fitem` (`item_no`, `en_item_name`, `lv_item_name`, `category_no`, `en_cate_name`, `lv_cate_name`, `price`) VALUES
('1', 'Kombinasjonsretter N', 'Nr.1)Kombinasjonsret', '0101', 'Kombinasjo Retter', 'Kombinasjo Retter', '209.00'),
('10', 'No.10)Peking Soup', 'Nr.10)PekingSuppe', '0103', 'Supper', 'Supper', '69.00'),
('101', 'Nr.101)Kombinasjonsr', 'Nr.101)Kombinasjonsr', '0101', 'Kombinasjo Retter', 'Kombinasjo Retter', '239.00'),
('1012', 'Nr.1012)NorskeJuleta', 'Nr.1012)NorskeJuleta', '0120', 'Juletallerken', 'Juletallerken', '269.00'),
('1013', 'Nr.1013)KinesiskeJul', 'Nr.1013)KinesiskeJul', '0120', 'Juletallerken', 'Juletallerken', '269.00'),
('1014', 'Nr.1014)SvineribbeTa', 'Nr.1014)SvineribbeTa', '0120', 'Juletallerken', 'Juletallerken', '219.00'),
('1015', 'Nr.1015)Pinnekj鴗tTa', 'Nr.1015)Pinnekj鴗tTa', '0120', 'Juletallerken', 'Juletallerken', '289.00'),
('1016', 'Nr.1016)Riskrem', 'Nr.1016)Riskrem', '0113', 'Dessert', 'Dessert', '55.00'),
('102', 'No.102)Buffet (Adu', 'Nr.102)Buffet (voks', '0117', 'S鴑dags Buffet', 'Sunday`s Buffet', '229.00'),
('103', 'Nr.103)Buffet (Child', 'Nr.103)Buffet (Barn)', '0117', 'S鴑dags Buffet', 'Sunday`s Buffet', '115.00'),
('104', 'Nr.104)Buffet Pensjo', 'Nr.104)Buffet (Pensj', '0117', 'S鴑dags Buffet', 'Sunday`s Buffet', '198.00'),
('11', 'Nr.11)Ton yum kun su', 'Nr.11)Ton yum kun su', '0103', 'Supper', 'Supper', '89.00'),
('110', 'No.110)sea specialty', 'Nr.110)Delikatessesu', '0103', 'Supper', 'Supper', '89.00'),
('111', 'No.111)Fried Noodle', 'Nr.111)Stekt Noodle', '0114', 'Lunsj', 'Lunsj', '89.00'),
('1111', 'Happy Hour Stekt Noo', 'Nr.1111)HappyMSt.Noo', '0119', 'Happy Hour/Dagens', 'Happy Hour/Dagens', '69.00'),
('1112', 'Happy Hour Biff Chop', 'Nr.1112)HappyM.BiffC', '0119', 'Happy Hour/Dagens', 'Happy Hour/Dagens', '69.00'),
('1119', 'Happy Hour Innb.Kyll', 'Nr.1119)HappyM.In.Ky', '0119', 'Happy Hour/Dagens', 'Happy Hour/Dagens', '69.00'),
('112', 'No.112)Beef Chopsuey', 'Nr.112)Biff Chopsuey', '0114', 'Lunsj', 'Lunsj', '89.00'),
('1120', 'Happy Hour Surs鴗 Sv', 'Nr.1120)HappyM.SurSv', '0119', 'Happy Hour/Dagens', 'Happy Hour/Dagens', '69.00'),
('1122', 'Happy Hour Stekt Ris', 'Nr.1122)HappyM.St.Ri', '0119', 'Happy Hour/Dagens', 'Happy Hour/Dagens', '69.00'),
('113', 'No.113)Beef with Kur', 'Nr.113)Biff i Karris', '0114', 'Lunsj', 'Lunsj', '89.00'),
('114', 'No.114)Biff Sez Chue', 'Nr.114)Biff Sez Chue', '0114', 'Lunsj', 'Lunsj', '89.00'),
('115', 'No.115)Beef in Peppe', 'Nr.115)Biff i Pepper', '0114', 'Lunsj', 'Lunsj', '89.00'),
('116', 'No.116)Chicken Chops', 'Nr.116)Kylling Chops', '0114', 'Lunsj', 'Lunsj', '89.00'),
('117', 'No.117)Chicken i Cur', 'Nr.117)Kylling i Kar', '0114', 'Lunsj', 'Lunsj', '89.00'),
('118', 'No.118)Chicken Sez C', 'Nr.118)Kylling Sez C', '0114', 'Lunsj', 'Lunsj', '89.00'),
('119', 'No.119)Fried Chicken', 'Nr.119)Innbakt Kylli', '0114', 'Lunsj', 'Lunsj', '89.00'),
('12', 'No.12)Fried Kingshri', 'Nr.12)Innbakt Konger', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '209.00'),
('120', 'No.120)Sweet & Sour', 'Nr.120)Surs鴗 Svinef', '0114', 'Lunsj', 'Lunsj', '89.00'),
('121', 'No.121)Pork Fillet i', 'Nr.121)Svinefilet i', '0114', 'Lunsj', 'Lunsj', '89.00'),
('122', 'No.122)Fried Rice (L', 'Nr.122)Stekt Ris (Lu', '0114', 'Lunsj', 'Lunsj', '89.00'),
('123', 'No.123)Noodle Soup (', 'Nr.123)Noodles Suppe', '0114', 'Lunsj', 'Lunsj', '89.00'),
('124', 'No.124)Chicken Salad', 'Nr.124)Kylling Salat', '0114', 'Lunsj', 'Lunsj', '89.00'),
('125', 'No.125)Sushi mix (Lu', 'Nr.125)Sushi mix (Lu', '0114', 'Lunsj', 'Lunsj', '89.00'),
('126', 'No.126)Chicken Teriy', 'Nr.126)Kylling Teriy', '0114', 'Lunsj', 'Lunsj', '89.00'),
('13', 'No.13)Kingprawns wit', 'Nr.13)Kongereker med', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '209.00'),
('1391', 'Brus 0.5L Tilbud', 'Brus 0.5L Tilbud', '0501', 'Mineralvann', 'Mineralvann', '15.00'),
('14', 'No.14)Kingprawns in', 'Nr.14)Kongerekr i Ka', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '209.00'),
('15', 'No.15)Fried Sea Spec', 'Nr.15)Innb.HavetsDel', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '209.00'),
('155', 'Happy Meal/P鴏se+Bru', 'Nr.155)HappyMeal/P鴏', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '69.00'),
('156', 'Happy Meal 1/4 Kylli', 'Nr.156)HappyMealKyll', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '69.00'),
('157', 'Happy Hour Hamburger', 'Nr.157)HappyHourHamb', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '69.00'),
('1581', 'Happy Hour Innb.Kyll', 'Nr.1581)HappyM.Inn.K', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '69.00'),
('1582', 'Happy Hour Stekt Ris', 'Nr.1582)HappyMSt.Ris', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '69.00'),
('16', 'No.16)Sea Specialty', 'Nr.16)Havets Delikat', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '219.00'),
('17', 'No.17)Kingprawns Sez', 'Nr.17)Kongereker Sez', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '209.00'),
('18', 'No.18)Fried wolf-fis', 'Nr.18)Innbakte Stein', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '169.00'),
('19', 'No.19)Wolf-fish Chop', 'Nr.19)Steinbitfilet', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '169.00'),
('2', 'No.2)Combination(2)', 'Nr.2)Kombinasjon(2)', '0101', 'Kombinasjo Retter', 'Kombinasjo Retter', '229.00'),
('20', 'No.20)Fried Squid ri', 'Nr.20)Innbakte Akkar', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '149.00'),
('21', 'No.21)Fried Codfish', 'Nr.21)Innbakt Torske', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '179.00'),
('22', 'No.22)Lobsters Sez C', 'Nr.22)Helhummer Sez', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '289.00'),
('221', 'No.221)Mateus(Halvt?', 'Nr.221)Mateus(Halvt?', '0302', 'Rosevin', 'Rosevin', '226.00'),
('222', 'No.222)', 'Nr.222)', '', '', '', '118.00'),
('223', 'No.223)', 'Nr.223)', '', '', '', '226.00'),
('225', 'No.225)Cabernet  1/1', 'Nr.225)Cabernet  1/1', '0302', 'Rosevin', 'Rosevin', '226.00'),
('226', 'No.226)Cabernet 1/2F', 'Nr.226)Cabernet 1/2F', '0302', 'Rosevin', 'Rosevin', '118.00'),
('23', 'Nr.23)Beef with Bamb', 'Nr.23)Biff med Bambu', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('231', 'No.231)Freivent(Span', 'Nr.231)Freivent(Span', '0304', 'Champagne', 'Champagne', '348.00'),
('233', 'No.233)Veuve Cliquot', 'Nr.233)Veuve Cliquot', '0304', 'Champagne', 'Champagne', '860.00'),
('24', 'No.24)Beef Chopsuey', 'Nr.24)Biff Chopsuey', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('243', 'No.243)Jung,s Weissl', 'Nr.243)Jung,s Weissl', '0801', 'Alkoholfrie', 'Alkoholfrie', '178.00'),
('244', 'No.244)Jung,s Weissl', 'Nr.244)Jung,s Weissl', '0801', 'Alkoholfrie', 'Alkoholfrie', '97.00'),
('25', 'No.25)Beef med Black', 'Nr.25)Biff med Svart', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('255', 'Nr.255)Juice', 'Nr.255)Juice', '0501', 'Mineralvann', 'Mineralvann', '25.00'),
('26', 'No.26)Beef in Curry', 'Nr.26)Biff i Karrisa', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('27', 'No.27)Beef in Satesa', 'Nr.27)Biff i Satesau', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('28', 'No.28)Beef with Broc', 'Nr.28)Biff med Brokk', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('29', 'Biff m/Tomat og anna', 'Nr.29)Biff m/Tomat', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('3', 'No.3)Combination(3)', 'Nr.3)Kombinasjon(3)', '0101', 'Kombinasjo Retter', 'Kombinasjo Retter', '249.00'),
('30', 'No.30)Beef in Pepper', 'Nr.30)Biff i Peppers', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('301', 'No.301)L鴌ten linie', 'Nr.301)L鴌ten linie', '0401', 'Brennevin', 'Brennevin', '60.00'),
('302', 'No.301B)Akevitt 2CL', 'Nr.301B)Akevitt 2CL', '0401', 'Brennevin', 'Brennevin', '30.00'),
('303', 'No.303)Dawson 4CL', 'Nr.303)Dawson 4CL', '0401', 'Brennevin', 'Brennevin', '60.00'),
('304', 'No.303B)Dawson 2CL', 'Nr.303B)Dawson 2CL', '0401', 'Brennevin', 'Brennevin', '30.00'),
('305', 'No.305)Johnnie 4CL', 'Nr.305)Johnnie 4CL', '0401', 'Brennevin', 'Brennevin', '68.00'),
('306', 'No.305B)Johnnie 2CL', 'Nr.305B)Johnnie 2CL', '0401', 'Brennevin', 'Brennevin', '34.00'),
('31', 'No.31)Beef Sez Chuen', 'Nr.31)Biff Sez Chuen', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('311', 'No.311)Cognac 4CL', 'Nr.311)Cognac 4CL', '0401', 'Brennevin', 'Brennevin', '66.00'),
('312', 'No.312)Cognac 2CL', 'Nr.312)Cognac 2CL', '0401', 'Brennevin', 'Brennevin', '33.00'),
('313', 'No.313)Larsen 4CL', 'Nr.313)Larsen 4CL', '0401', 'Brennevin', 'Brennevin', '70.00'),
('313B', 'No.313B)Larsen 2CL', 'Nr.313B)Larsen 2CL', '0401', 'Brennevin', 'Brennevin', '35.00'),
('315', 'No.315)Bache 4CL', 'Nr.315)Bache 4CL', '0401', 'Brennevin', 'Brennevin', '68.00'),
('315B', 'No.315B)Bache 2CL', 'Nr.315B)Bache 2CL', '0401', 'Brennevin', 'Brennevin', '34.00'),
('317', 'No.317)Hennessy 4CL', 'Nr.317)Hennessy 4CL', '0401', 'Brennevin', 'Brennevin', '88.00'),
('317B', 'No.317B)Hennessy 2CL', 'Nr.317B)Hennessy 2CL', '0401', 'Brennevin', 'Brennevin', '44.00'),
('319', 'No.319)Bonaparte 4CL', 'Nr.319)Bonaparte 4CL', '0401', 'Brennevin', 'Brennevin', '66.00'),
('319B', 'No.319B)Bonapart.2CL', 'Nr.319B)Bonapart.2CL', '0401', 'Brennevin', 'Brennevin', '33.00'),
('32', 'Nr.32)Hong Kong Beef', 'Nr.32)Indrefilet av', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '219.00'),
('321', 'No.321)Martell V.4CL', 'Nr.321)Martell V.4CL', '0401', 'Brennevin', 'Brennevin', '88.00'),
('321B', 'No.321B)Martel.V.2CL', 'Nr.321B)Martel.V.2CL', '0401', 'Brennevin', 'Brennevin', '44.00'),
('323', 'No.323)Hennes.XO 4CL', 'Nr.323)Hennes.XO 4CL', '0401', 'Brennevin', 'Brennevin', '198.00'),
('323B', 'No.323B)Hennes.XO 2C', 'Nr.323B)Hennes.XO 2C', '0401', 'Brennevin', 'Brennevin', '99.00'),
('325', 'No.325)Drambuie 4CL', 'Nr.325)Drambuie 4CL', '0401', 'Brennevin', 'Brennevin', '66.00'),
('325B', 'No.325B)Drambuie 2CL', 'Nr.325B)Drambuie 2CL', '0401', 'Brennevin', 'Brennevin', '33.00'),
('327', 'No.327)Cointre. 4CL', 'Nr.327)Cointre. 4CL', '0401', 'Brennevin', 'Brennevin', '66.00'),
('327B', 'No.327B)Cointre. 4CL', 'Nr.327B)Cointre. 4CL', '0401', 'Brennevin', 'Brennevin', '33.00'),
('329', 'No.329)St.Hallv. 4CL', 'Nr.329)St.Hallv. 4CL', '0401', 'Brennevin', 'Brennevin', '58.00'),
('329B', 'No.329B)St.Hallv.2CL', 'Nr.329B)St.Hallv.2CL', '0401', 'Brennevin', 'Brennevin', '29.00'),
('33', 'No.33)Sweet & Sour P', 'Nr.33)Surs鴗 Svinefi', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '149.00'),
('331', 'No.331)TiaMaria 4CL', 'Nr.331)TiaMaria 4CL', '0401', 'Brennevin', 'Brennevin', '58.00'),
('331B', 'No.331B)TiaMaria 2CL', 'Nr.331B)TiaMaria 2CL', '0401', 'Brennevin', 'Brennevin', '29.00'),
('333', 'NO.333)Grand M. 4CL', 'Nr.333)Grand M. 4CL', '0401', 'Brennevin', 'Brennevin', '66.00'),
('333B', 'No.333B)Grand M. 2CL', 'Nr.333B)Grand M. 2CL', '0401', 'Brennevin', 'Brennevin', '33.00'),
('335', 'No.335)Jaegerme. 4CL', 'Nr.335)Jaegerme. 4CL', '0401', 'Brennevin', 'Brennevin', '64.00'),
('335B', 'No.335B)J鎔ermeister', 'Nr.335B)J鎔ermeister', '0401', 'Brennevin', 'Brennevin', '32.00'),
('339', 'No.339)Smirnoff 4CL', 'Nr.339)Smirnoff 4CL', '0401', 'Brennevin', 'Brennevin', '56.00'),
('339B', 'No.339B)Smirnoff 2CL', 'Nr.339B)Smirnoff 2CL', '0401', 'Brennevin', 'Brennevin', '28.00'),
('34', 'No.34)Lamb fillet wi', 'Nr.34)Lammefilet med', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '169.00'),
('341', 'No.341)Absolut C.4CL', 'Nr.341)Absolut Citro', '0401', 'Brennevin', 'Brennevin', '60.00'),
('341B', 'No.341B)AbsolutC.2CL', 'Nr.341B)AbsolutC.2CL', '0401', 'Brennevin', 'Brennevin', '30.00'),
('343', 'No.343)Absolut K.4CL', 'Nr.343)Absolut K.4CL', '0401', 'Brennevin', 'Brennevin', '60.00'),
('343B', 'No.343B)AbsolutK.2CL', 'Nr.343B)AbsolutK.2CL', '0401', 'Brennevin', 'Brennevin', '30.00'),
('345', 'No.345)Finlandia.4CL', 'Nr.345)Finlandia.4CL', '0401', 'Brennevin', 'Brennevin', '56.00'),
('345B', 'No.345B)Finlandia.2C', 'Nr.345B)Finlandia.2C', '0401', 'Brennevin', 'Brennevin', '28.00'),
('35', 'No.35)Three Small co', 'Nr.35)Tre Sm錼etter', '0118', 'Tre Sm錼etter', 'Three Small Things', '199.00'),
('350', 'Clausthaler 0.33L', 'Clausthaler 0.33L', '0201', 'Pils', 'Pils', '33.00'),
('351', 'No.351)Irish Coffe', 'Nr.351)Irish Coffe', '0401', 'Brennevin', 'Brennevin', '78.00'),
('352', 'No.352)Hot Shot', 'Nr.352)Hot Shot', '0401', 'Brennevin', 'Brennevin', '38.00'),
('353', 'No.353)Dry Martini', 'Nr.353)Dry Martini', '0401', 'Brennevin', 'Brennevin', '65.00'),
('354', 'No.354)Whit Lady', 'Nr.354)Whit Lady', '0401', 'Brennevin', 'Brennevin', '65.00'),
('355', 'No.355)Black Russian', 'Nr.355)Black Russian', '0401', 'Brennevin', 'Brennevin', '65.00'),
('356', 'No.356)Summer Sky', 'Nr.356)Summer Sky', '0401', 'Brennevin', 'Brennevin', '50.00'),
('358', 'No.358)Olsen Driver', 'Nr.358)Olsen Driver', '0401', 'Brennevin', 'Brennevin', '50.00'),
('36', 'No.36) Peking Duck', 'Nr.36)Peking And', '0107', 'And', 'And', '259.00'),
('361', 'No.361)Bristol Cream', 'Nr.361)Bristol Cream', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '42.00'),
('362', 'Bristol Cream 8CL', 'Bristol Cream 8CL', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '84.00'),
('363', 'No.)Cinzano Bianco.4', 'Nr.)Cinzano Bianco.4', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '42.00'),
('364', 'No.364)Cinzano Bianc', 'Nr.364)Cinzano Bianc', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '84.00'),
('365', 'No.365)Campari Bitte', 'Nr.365)Campari Bitte', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '42.00'),
('366', 'No.366)Campari Bitte', 'Nr.366)Campari Bitte', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '84.00'),
('367', 'No.367)WarnicksAsvoc', 'Nr.367)WarnicksAdvoc', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '42.00'),
('368', 'WarnicksAdvocaat 8CL', 'WarnicksAdvocaat 8CL', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '84.00'),
('369', 'No.369)Sake.4CL', 'Nr.369)Sake.4CL', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '48.00'),
('37', 'No.37)Peking Duck w/', 'Nr.37)Peking And m/G', '0107', 'And', 'And', '209.00'),
('370', 'No.370)Sake.8CL', 'Nr.370)Sake.8CL', '0303', 'Apertiff og Likoor', 'Apertiff og Likoor', '96.00'),
('38', 'No.38)Crispy Skinned', 'Nr.38)Spr鴖tekt And', '0107', 'And', 'And', '209.00'),
('381', 'No.381)Beer 0.5L', 'Nr.381)Pils 0.5L', '0201', 'Pils', 'Pils', '67.00'),
('382', 'No.382)Beer 0.33L', 'Nr.382)Pils 0.33L', '0201', 'Pils', 'Pils', '47.00'),
('383', 'No.383)Tsingtao Beer', 'Nr.383)Tsingtao 鴏', '0201', 'Pils', 'Pils', '57.00'),
('384', 'Ringnes 0.5L', 'Ringnes 0.5L', '0201', 'Pils', 'Pils', '57.00'),
('385', 'No.385)Pear cider', 'Nr.385)P鎟ecider', '0202', 'Cider', 'Cider', '55.00'),
('386', 'No.386)Apple cider', 'Nr.386)Eplecider', '0202', 'Cider', 'Cider', '55.00'),
('387', 'No.387)Lemon Cider', 'Nr.387)Limecider', '0202', 'Cider', 'Cider', '55.00'),
('388', 'lett ol Clausthaler', 'lett ol Clausthaler', '0201', 'Pils', 'Pils', '35.00'),
('389', 'No.389)Coca Cola 0.2', 'Nr.389)Coca Cola 0.2', '0501', 'Mineralvann', 'Mineralvann', '22.00'),
('39', 'No.39)Duck with Bamb', 'Nr.39)And med Bambus', '0107', 'And', 'And', '209.00'),
('390', 'Cola 0.33L', 'Cala 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('391', 'Cola 0.5L', 'Cola 0.5L', '0501', 'Mineralvann', 'Mineralvann', '37.00'),
('392', 'No.392)Coffe', 'Nr.392)Kaffe', '0601', 'Kaffe / Te', 'Caffe / Tee', '29.00'),
('393', 'No.393)Espresso', 'Nr.393)Espresso', '0601', 'Kaffe / Te', 'Caffe / Tee', '27.00'),
('394', 'No.394)Espresso doub', 'Nr.394)Espresso dobb', '0601', 'Kaffe / Te', 'Caffe / Tee', '33.00'),
('395', 'No.395)Americano', 'Nr.395)Americano', '0601', 'Kaffe / Te', 'Caffe / Tee', '27.00'),
('396', 'No.396)Cappuccino', 'Nr.396)Cappuccino', '0601', 'Kaffe / Te', 'Caffe / Tee', '33.00'),
('397', 'No.397)Cafe au lait', 'Nr.397)Cafe au lait', '0601', 'Kaffe / Te', 'Caffe / Tee', '33.00'),
('398', 'No.398)Cafe latte', 'Nr.398)Cafe latte', '0601', 'Kaffe / Te', 'Caffe / Tee', '33.00'),
('4', 'No.4)Combination(4)', 'Nr.4)Kombinasjon(4)', '0101', 'Kombinasjo Retter', 'Kombinasjo Retter', '249.00'),
('40', 'No.40)Fried Chicken', 'Nr.40)Spr鴖tekt Kyll', '0106', 'Kylling', 'Kylling', '149.00'),
('400', 'No.400)Solo 0.2L (gl', 'Nr.400)Solo 0.2L (gl', '0501', 'Mineralvann', 'Mineralvann', '22.00'),
('401', 'No.401)Solo 0.33L (b', 'Nr.401)Solo 0.33L (f', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('402', 'Solo 0.5L', 'Solo 0.5L', '0501', 'Mineralvann', 'Mineralvann', '37.00'),
('403', 'Fanta 0.33L', 'Fanta 0.33L', '0501', 'Mineralvann', 'Mineralvann', '31.00'),
('404', 'Fanta 0.5L', 'Fanta 0.5L', '0501', 'Mineralvann', 'Mineralvann', '37.00'),
('405', 'Cola light 0.33L', 'Cola light 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('406', 'Cola light 0.5L', 'Cola light 0.5L', '0501', 'Mineralvann', 'Mineralvann', '37.00'),
('407', 'Farris bl?0.33L', 'Farris bl?0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('408', 'Farris bl?0.5L', 'Farris bl?0.5L', '0501', 'Mineralvann', 'Mineralvann', '37.00'),
('409', 'Farris gr鴑n 0.33L', 'Farris gr鴑n 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('41', 'No.41)Chicken Chopsu', 'Nr.41)Kylling Chopsu', '0106', 'Kylling', 'Kylling', '149.00'),
('410', 'Farris gul 0.33L', 'Farris gul 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('411', 'Applesinjuice 0.33L', 'Applesinjuice 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('412', 'Eplemost 0.33L', 'Eplemost 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('413', 'Sprite Zero 0.33L', 'Sprite Zero 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('414', 'No.414)Tea (Chinese)', 'Nr.414)Te (Kinesisk)', '0601', 'Kaffe / Te', 'Caffe / Tee', '29.00'),
('415', 'Pepsi', 'Pepsi 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('416', 'Pepsimax 0.33L', 'Pepsimax 0.33L', '0501', 'Mineralvann', 'Mineralvann', '33.00'),
('42', 'No.42)Chicken in Cur', 'Nr.42)Kylling i Karr', '0106', 'Kylling', 'Kylling', '149.00'),
('420', 'Vann', 'Vann', '0501', 'Mineralvann', 'Mineralvann', '0.00'),
('422', 'No.422)Fried Codfish', 'Nr.422)Stekt Torskef', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '209.00'),
('424', 'No.424)Fried Heilbut', 'Nr.424)Stekt Kveite', '0104', 'Havets Delikatesser', 'Havets Delikatesser', '229.00'),
('43', 'No.43)Chicken w/Cash', 'Nr.43)Kylling m/Cash', '0106', 'Kylling', 'Kylling', '159.00'),
('431', 'No.431)Hong Kong Cho', 'Nr.431)Hong Kong Cho', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '169.00'),
('432', 'No.432)Peking Chopsu', 'Nr.432)Peking Chopsu', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '199.00'),
('433', 'Nr.433)Mix kj鴗t i p', 'Nr.433)Mix kj鴗t i p', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '169.00'),
('44', 'No.44)Fried Chicken', 'Nr.44)Innbakt Kyllin', '0106', 'Kylling', 'Kylling', '149.00'),
('45', 'No.45)Chicken w/Blac', 'Nr.45)Kylling m/Svar', '0106', 'Kylling', 'Kylling', '149.00'),
('450', 'Mat', 'Mat', '0111', 'Diverse Retter', 'Diverse Retter', '0.00'),
('451', 'No.451)Chicken Sez C', 'Nr.451)Kylling Sez C', '0106', 'Kylling', 'Kylling', '149.00'),
('452', 'Nr.452)Kylling i pep', 'Nr.452)Kylling i pep', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '149.00'),
('46', 'No.46)Vegetarian-Cho', 'Nr.46)Vegetare-Chops', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '129.00'),
('47', 'No.47)Fried Rice wit', 'Nr.47)Stekt Ris med', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '129.00'),
('471', 'No.471)Fried Rice w/', 'Nr.471)Stekt Ris m/I', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '149.00'),
('472', 'No.472)Fried Rice w/', 'Nr.472)Stekt Ris m/I', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '159.00'),
('48', 'No.48)Spaghetti w/Ch', 'Nr.48)Spagetti m/Kyl', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '149.00'),
('49', 'No.49)Spaghetti w/Be', 'Nr.49)Spagetti m/Bif', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '149.00'),
('492', 'No.492)Fried Rice w/', 'Nr.492)Stekt Ris m/B', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '139.00'),
('5', 'No.5)Spring roll', 'Nr.5)V錼rull', '0102', 'Forretter', 'Forretter', '69.00'),
('501', 'No.501)Mini Spring r', 'Nr.501)Mini V錼rull', '0102', 'Forretter', 'Forretter', '75.00'),
('502', 'No.502)Chicken Sprin', 'Nr.502)V錼rull med K', '0102', 'Forretter', 'Forretter', '69.00'),
('504', 'No.504)Foto Maki 4b', 'Nr.504)Foto Maki 4b', '0116', 'Japanske Retter', 'Japanske Retter', '75.00'),
('505', 'No.505)California Ma', 'Nr.505)California Ma', '0116', 'Japanske Retter', 'Japanske Retter', '65.00'),
('506', 'No.506)Ebi Nigiri 2b', 'Nr.506)Ebi Nigiri 2b', '0116', 'Japanske Retter', 'Japanske Retter', '65.00'),
('507', 'No.507)Laks Nigiri 2', 'Nr.507)Laks Nigiri 2', '0116', 'Japanske Retter', 'Japanske Retter', '55.00'),
('508', 'No.508)Shake Maki 6b', 'Nr.508)Shake Maki 6b', '0116', 'Japanske Retter', 'Japanske Retter', '59.00'),
('509', 'No.509)Assortert Sus', 'Nr.509)Assortert Sus', '0116', 'Japanske Retter', 'Japanske Retter', '159.00'),
('51', 'Nr.51)Pepperstek', 'Nr.51)Pepperstek', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '209.00'),
('511', 'No.511)Chicken Teriy', 'Nr.511)Kylling Teriy', '0116', 'Japanske Retter', 'Japanske Retter', '149.00'),
('512', 'Biff Teriyaki', 'Nr.512)Biff Teriyaki', '0116', 'Japanske Retter', 'Japanske Retter', '149.00'),
('53', 'No.53)1/2 Fried Chic', 'Nr.53)1/2 stekt kyll', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '139.00'),
('54', 'No.54)Winerschnitzel', 'Nr.54)Winerschnitze', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '139.00'),
('543', 'Nr.543)Entrecote', 'Nr.543)Entrecote', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '189.00'),
('546', 'Nr.546)Biffsandder', 'Nr.546)Biffsandder', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '169.00'),
('547', 'No.547)Hamburger m/C', 'Nr.547)Hamburger m/C', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '99.00'),
('55', 'No.55)Child Menu Sau', 'Nr.55)Barne Meny P鴏', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '79.00'),
('555', 'No.555)Tobakk', 'Nr.555)Tobakk', '0701', 'Tobakk', 'Tobakk', '80.00'),
('56', 'No.56)Child Menu Chi', 'Nr.56)Barnemeny Kyll', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '89.00'),
('57', 'No.57)Child Menu Ham', 'Nr.57)Barnemeny Hamb', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '89.00'),
('58', 'No.58)Chips', 'Nr.58)Pommes Frites', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '35.00'),
('581', 'Nr.581) innbakte kyl', 'Nr.581) innbakte kyl', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '99.00'),
('582', 'No.582)Fried Rice', 'Nr.582)Stekt Ris', '0112', 'Happy Hour Barnemeny', 'Happy Hour Barnemeny', '99.00'),
('59', 'No.59)Fried Banana', 'Nr.59)Fritystekt Ban', '0113', 'Dessert', 'Dessert', '69.00'),
('6', 'No.6)Fried Wanton', 'Nr.6)Stekt Wanton', '0102', 'Forretter', 'Forretter', '75.00'),
('601', 'No.601)Noddle Soup w', 'Nr.601)Noddlesuppe m', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '129.00'),
('603', 'No.603)Fried Noddles', 'Nr.603)Stekt Noodles', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '139.00'),
('604', 'No.604)Singapore Fri', 'Nr.604)Singapore Ste', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '149.00'),
('606', 'No.606)Hong Kong Fri', 'Nr.606)Hong Kong Ste', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '209.00'),
('60747', 'Sauvignon Touraine 1', 'Sauvignon Touraine 1', '0305', 'Hvitvin', 'Hvitvin', '269.00'),
('60871', 'Tinto Crianza 1/1FL', 'Tinto Crianza 1/1FL', '0301', 'R鴇vin', 'R鴇vin', '299.00'),
('60994', 'Husets R鴇vin 1/1FL', 'Husets R鴇vin 1/1FL', '0301', 'R鴇vin', 'R鴇vin', '249.00'),
('60995', 'Husets R鴇vin 1/2FL', 'Husets R鴇vin 1/2FL', '0301', 'R鴇vin', 'R鴇vin', '129.00'),
('60996', 'Husets R鴇vin 15CL', 'Husets R鴇vin 15CL', '0301', 'R鴇vin', 'R鴇vin', '69.00'),
('61052', 'Rioja Ivendi 1/1FL', 'Rioja Ivendi 1/1FL', '0301', 'R鴇vin', 'R鴇vin', '289.00'),
('61063', 'Sangiovese Di Puglia', 'Sangiovese Di Puglia', '0301', 'R鴇vin', 'R鴇vin', '229.00'),
('61074', 'No.61074)Chardooay D', 'Nr.61074)Chardooay D', '0305', 'Hvitvin', 'Hvitvin', '249.00'),
('611', 'No.611)Thai Curry Be', 'Nr.611)Thailandsk Ka', '0115', 'Thailandsk Retter', 'Thailandsk Retter', '159.00'),
('61119', 'Liebraumilch 1/1FL', 'Liebraumilch 1/1FL', '0305', 'Hvitvin', 'Hvitvin', '209.00'),
('61131', 'Valpolicella Classic', 'Valpolicella Classic', '0301', 'R鴇vin', 'R鴇vin', '269.00'),
('612', 'No.612)Thai Curry Ch', 'Nr.612)Thailandsk Ka', '0115', 'Thailandsk Retter', 'Thailandsk Retter', '159.00'),
('61210', 'No.61210)1/1FL.Huset', 'Nr.61210)1/1FL.Huset', '0305', 'Hvitvin', 'Hvitvin', '249.00'),
('61211', 'Husets Hvitvin 1/2FL', 'Husets Hvitvin 1/2FL', '0305', 'Hvitvin', 'Hvitvin', '129.00'),
('61212', 'Husets Hvitvin 15CL', 'Husets Hvitvin 15CL', '0305', 'Hvitvin', 'Hvitvin', '69.00'),
('613', 'No.613)Thai Beef Ten', 'Nr.613)Thailandsk in', '0115', 'Thailandsk Retter', 'Thailandsk Retter', '219.00'),
('614', 'No.614)Lamb fillet w', 'Nr.614)Lammefilet m/', '0115', 'Thailandsk Retter', 'Thailandsk Retter', '179.00'),
('61401', 'Sovae Classico,Ca De', 'Sovae Classico,Ca De', '0305', 'Hvitvin', 'Hvitvin', '289.00'),
('61557', 'Juan De Merry Navara', 'Juan De Merry Navara', '0301', 'R鴇vin', 'R鴇vin', '209.00'),
('61568', 'Rioja Baron de Ivend', 'Rioja Baron de Ivend', '0301', 'R鴇vin', 'R鴇vin', '299.00'),
('616', 'No.616)Thai Style Du', 'Nr.616)Thailandsk An', '0115', 'Thailandsk Retter', 'Thailandsk Retter', '219.00'),
('61849', 'Chablis Domaine de l', 'Chablis Domaine de l', '0305', 'Hvitvin', 'Hvitvin', '369.00'),
('61883', 'Chotes Du Rhone 1/1F', 'Chotes Du Rhone 1/1F', '0301', 'R鴇vin', 'R鴇vin', '269.00'),
('61928', 'Nr.61928)Chianti Ant', 'Nr.61928)Chianti Ant', '0301', 'R鴇vin', 'R鴇vin', '289.00'),
('61940', 'Domaine De Calet Vdp', 'Domaine De Calet Vdp', '0301', 'R鴇vin', 'R鴇vin', '269.00'),
('61962', 'Brbera Del Piemo 1/1', 'Brbera Del Piemo 1/1', '0301', 'R鴇vin', 'R鴇vin', '269.00'),
('61973', 'Riesling 1/1FL', 'Riesling 1/1FL', '0305', 'Hvitvin', 'Hvitvin', '269.00'),
('62', 'No.62)Banana Split', 'Nr.62)Banana Split', '0113', 'Dessert', 'Dessert', '85.00'),
('62053', 'No.62053)McPherson S', 'Nr.62053)McPherson S', '0301', 'R鴇vin', 'R鴇vin', '249.00'),
('62389', 'No.62389)Liebfraumil', 'Nr.62389)Liebfraumil', '0305', 'Hvitvin', 'Hvitvin', '229.00'),
('63', 'Nr.63)Chinese Fruit', 'Nr.63)Kinesiske Fruk', '0113', 'Dessert', 'Dessert', '85.00'),
('64', 'No.64)Fantasy', 'Nr.64)Fantasy', '0113', 'Dessert', 'Dessert', '89.00'),
('65', 'No.65)Snow Mann / Ki', 'Nr.65)Sn?Mann / Bar', '0113', 'Dessert', 'Dessert', '39.00'),
('650', 'No.650)Apple cake wi', 'Nr.650)Eplekake med', '0113', 'Dessert', 'Dessert', '79.00'),
('7', 'No.7)shrimp coctail', 'Nr.7)Rekecoctail', '0102', 'Forretter', 'Forretter', '89.00'),
('700', 'No.700)Coffe (lunch)', 'Nr.700)Kaffe (lunsj)', '0601', 'Kaffe / Te', 'Caffe / Tee', '15.00'),
('701', 'No.701)Chicken fille', 'Nr.701)Kyllingfilet', '0102', 'Forretter', 'Forretter', '89.00'),
('702', 'No.702)Fried kingpra', 'Nr.702)Innbakt konge', '0102', 'Forretter', 'Forretter', '109.00'),
('705', 'No.705)Fried Sur-mai', 'Nr.705)Spr鴖tekt Sui', '0102', 'Forretter', 'Forretter', '89.00'),
('707', 'No.707)Fried Scallop', 'Nr.707)Frityrstekte', '0102', 'Forretter', 'Forretter', '79.00'),
('71', 'Nr.71)ThiChiMenyHK', 'Nr.71)ThiChiMenyHK', '0118', 'Tre Sm錼etter', 'Three Small Things', '189.00'),
('711', 'Nr.711)Mix kj鴗t Sez', 'Nr.711)Mix kj鴗t Sez', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '169.00'),
('72', 'Nr.72)ThiChiMenyAK', 'Nr.72)ThiChiMenyAK', '0118', 'Tre Sm錼etter', 'Three Small Things', '179.00'),
('721', 'Nr.721)ThiChiMeny Ky', 'Nr.721)ThiChiMeny Ky', '0118', 'Tre Sm錼etter', 'Three Small Things', '179.00'),
('73', 'Nr.73)ThiChiMenyGLJ', 'Nr.73)ThiChiMenyGLJ', '0118', 'Tre Sm錼etter', 'Three Small Things', '179.00'),
('730', 'Stekt Svineribb', 'Nr.730)StektSvinerib', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '169.00'),
('732', 'Nr.732)SvinefiletCho', 'Nr.732)SvinefiletCho', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '139.00'),
('733', 'No.733)Pork fillet i', 'Nr.733)Svinefilet i', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '139.00'),
('734', 'No.734)Pork fillet S', 'Nr.734)Svinefilet Se', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '139.00'),
('735', 'No.735)Pork fillet w', 'Nr.735)Svinefilet m/', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '139.00'),
('736', 'Nr.736)SvinefiletI k', 'Nr.736)SvinefiletI k', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '139.00'),
('737', 'Mr.737)Mix kj鴗t i k', 'Mr.737)Mix kj鴗t i k', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '169.00'),
('741', 'Three Small Thi', 'Nr.741)Tre Sm錼etter', '0118', 'Tre Sm錼etter', 'Three Small Things', '219.00'),
('742', 'No.742)Three Small c', 'Nr.742)Tre Sm錼etter', '0118', 'Tre Sm錼etter', 'Three Small Things', '219.00'),
('743', 'No.743)Three small c', 'Nr.743)Tre sm?rette', '0118', 'Tre Sm錼etter', 'Three Small Things', '199.00'),
('745', 'Nr.745)Tre Sm錼etter', 'Nr.745)Tre Sm錼etter', '0118', 'Tre Sm錼etter', 'Three Small Things', '219.00'),
('750', 'Nr.750)Lammefilet i', 'Nr.750)Lammefilet i', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '169.00'),
('751', 'No.751)lamb fillet S', 'Nr.751)lammefilet Se', '0105', 'Biff/Svine/Lam', 'Biff/Svine/Lam', '169.00'),
('752', 'No.752)Beefburger w/', 'Nr.752)Biffburger w/', '0110', 'InternasjonaleRetter', 'InternasjonaleRetter', '149.00'),
('753', 'No.753)Peppersteak i', 'Nr.753)Pepperstek i', '0108', 'Kinesiske Retter', 'Kinesiske Retter', '209.00'),
('8', 'No.8) Wanton Soup', 'Nr.8) Wanton Suppe', '0103', 'Supper', 'Supper', '89.00'),
('830', 'Nr.830)Stekt Ris', 'Nr.830)Stekt Ris', '0111', 'Diverse Retter', 'Diverse Retter', '39.00'),
('831', 'Nr.831)Stek Poteter', 'Nr.831)Stek Poteter', '0111', 'Diverse Retter', 'Diverse Retter', '39.00'),
('832', 'No.832)Boiled Potato', 'Nr.832)Kokt Potet', '0111', 'Diverse Retter', 'Diverse Retter', '35.00'),
('833', 'No.833)Chips', 'Nr.833)Pommes Frites', '0111', 'Diverse Retter', 'Diverse Retter', '35.00'),
('834', 'No.834)Garlic bread', 'Nr.834)Hvitl鴎 Br鴇', '0111', 'Diverse Retter', 'Diverse Retter', '39.00'),
('835', 'No.835)Pepper sauce', 'Nr.835)Peppersaus', '0111', 'Diverse Retter', 'Diverse Retter', '25.00'),
('836', 'No.836)Bearnaisesaus', 'Nr.836)Bearnaisesaus', '0111', 'Diverse Retter', 'Diverse Retter', '25.00'),
('837', 'Nr.837)Curry sauce', 'Nr.837)Karrisaus', '0111', 'Diverse Retter', 'Diverse Retter', '25.00'),
('838', 'Chopsuey Sauce', 'Chopsuey Saus', '0111', 'Diverse Retter', 'Diverse Retter', '25.00'),
('839', 'No.839)Sweet & Sour', 'Nr.839)Surs鴗 Saus', '0111', 'Diverse Retter', 'Diverse Retter', '25.00'),
('850', 'No.850)Malaysian Bee', 'Nr.850)Malaysiske Bi', '0109', 'Malaysiske Retter', 'Malaysiske Retter', '159.00'),
('851', 'No.851)Malaysian Chi', 'Nr.851)Malaysian kyl', '0109', 'Malaysiske Retter', 'Malaysiske Retter', '159.00'),
('852', 'No.852)Malaysian Por', 'Nr.852)Malaysiske Sv', '0109', 'Malaysiske Retter', 'Malaysiske Retter', '139.00'),
('853', 'No.853) Malaysian la', 'Nr.853) Malaysiske L', '0109', 'Malaysiske Retter', 'Malaysiske Retter', '179.00'),
('854', 'Malaysian Meats Curr', 'Nr.854)MalaysiskeMix', '0109', 'Malaysiske Retter', 'Malaysiske Retter', '179.00'),
('88', 'Kr.', 'Kr.', '0111', 'Diverse Retter', 'Diverse Retter', '0.00'),
('9', 'No.9)Chicken Soup', 'Nr.9)Kylling Suppe', '0103', 'Supper', 'Supper', '69.00');

-- --------------------------------------------------------

--
-- 表的结构 `mpos_remark`
--

CREATE TABLE `mpos_remark` (
  `group_no` char(2) NOT NULL,
  `en_group_name` char(10) NOT NULL,
  `lv_group_name` char(10) NOT NULL,
  `seq_group` int(4) NOT NULL,
  `rmk_no` char(10) NOT NULL,
  `en_rmk_name` char(20) NOT NULL,
  `lv_rmk_name` char(20) NOT NULL,
  `seq_rmk` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 导出表中的数据 `mpos_remark`
--

INSERT INTO `mpos_remark` (`group_no`, `en_group_name`, `lv_group_name`, `seq_group`, `rmk_no`, `en_rmk_name`, `lv_rmk_name`, `seq_rmk`) VALUES
('01', ' Vegetable', '蔬菜', 1, '01001', 'radish', '萝卜', 1),
('01', ' Vegetable', '蔬菜', 1, '01002', 'fistulosum', '葱', 2);

-- --------------------------------------------------------

--
-- 表的结构 `mpos_remark_order`
--

CREATE TABLE `mpos_remark_order` (
  `order_line` int(10) NOT NULL auto_increment,
  `staffno` char(10) NOT NULL COMMENT '操作员编号',
  `customize` char(10) NOT NULL COMMENT '桌号',
  `site_no` varchar(2) NOT NULL COMMENT '座号',
  `item_no` varchar(16) NOT NULL COMMENT '菜编号',
  `input_time` char(20) NOT NULL COMMENT '提交时间',
  `rmk_name` char(20) NOT NULL COMMENT '酸菜名字',
  `action_lv` int(10) NOT NULL COMMENT '动作等级3~0',
  `rmk_no` int(10) NOT NULL COMMENT '配菜编号',
  PRIMARY KEY  (`order_line`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `mpos_remark_order`
--

INSERT INTO `mpos_remark_order` (`order_line`, `staffno`, `customize`, `site_no`, `item_no`, `input_time`, `rmk_name`, `action_lv`, `rmk_no`) VALUES
(1, 'test', '1', '01', '1', '2010-05-11 23:25:35', '葱', 0, 1002),
(2, 'test', '1', '01', '1', '2010-05-11 23:25:35', '萝卜', 0, 1001),
(3, 'test', '1', '02', '502', '2010-05-11 23:25:35', '萝卜', 0, 1001);

-- --------------------------------------------------------

--
-- 表的结构 `mpos_sendorder`
--

CREATE TABLE `mpos_sendorder` (
  `order_line` int(10) NOT NULL auto_increment,
  `staffno` char(10) NOT NULL COMMENT '操作员账号',
  `customize` char(10) NOT NULL COMMENT '桌号',
  `site_no` char(2) NOT NULL COMMENT '座位号',
  `item_no` char(16) NOT NULL COMMENT '菜货品编号',
  `qty` decimal(8,4) NOT NULL COMMENT '数量',
  `input_time` char(20) NOT NULL COMMENT '提交时间',
  PRIMARY KEY  (`order_line`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 导出表中的数据 `mpos_sendorder`
--

INSERT INTO `mpos_sendorder` (`order_line`, `staffno`, `customize`, `site_no`, `item_no`, `qty`, `input_time`) VALUES
(1, 'test', '1', '01', '1', '1.0000', '2010-05-11 23:25:35'),
(2, 'test', '1', '01', '101', '1.0000', '2010-05-11 23:25:35'),
(3, 'test', '1', '02', '501', '1.0000', '2010-05-11 23:25:35'),
(4, 'test', '1', '02', '502', '1.0000', '2010-05-11 23:25:35');

-- --------------------------------------------------------

--
-- 表的结构 `mpos_user`
--

CREATE TABLE `mpos_user` (
  `id` int(10) NOT NULL auto_increment,
  `username` char(20) NOT NULL COMMENT '账号',
  `password` char(50) NOT NULL COMMENT '密码',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `mpos_user`
--

INSERT INTO `mpos_user` (`id`, `username`, `password`) VALUES
(1, 'test', '202cb962ac59075b964b07152d234b70'),
(2, 'user', 'e10adc3949ba59abbe56e057f20f883e'),
(3, '123', '202cb962ac59075b964b07152d234b70');
