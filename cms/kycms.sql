/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : kycms

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2014-11-23 20:34:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ky_admin
-- ----------------------------
DROP TABLE IF EXISTS `ky_admin`;
CREATE TABLE `ky_admin` (
  `userid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `roleid` smallint(5) DEFAULT '0',
  `realname` varchar(50) NOT NULL DEFAULT '',
  `auth` text NOT NULL,
  `list_size` smallint(5) NOT NULL,
  `left_width` smallint(5) NOT NULL DEFAULT '150',
  PRIMARY KEY (`userid`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_admin
-- ----------------------------
INSERT INTO `ky_admin` VALUES ('1', 'admin', '33e53bc09baeba13bf91bee8dc4667b1', '1', '超级管理员', '', '10', '150');

-- ----------------------------
-- Table structure for ky_block
-- ----------------------------
DROP TABLE IF EXISTS `ky_block`;
CREATE TABLE `ky_block` (
  `id` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_block
-- ----------------------------
INSERT INTO `ky_block` VALUES ('1', '2', '幻灯图片1', 'http://demo.xiaocms.com/template/default/images/1.png');
INSERT INTO `ky_block` VALUES ('2', '2', '幻灯图片2', 'http://demo.xiaocms.com/template/default/images/2.png');
INSERT INTO `ky_block` VALUES ('3', '2', '幻灯图片3', 'http://demo.xiaocms.com/template/default/images/3.png');
INSERT INTO `ky_block` VALUES ('4', '3', '联系我们', '&lt;div class=&quot;contact&quot;&gt;\r\n	&lt;div class=&quot;item online&quot;&gt;\r\n		&lt;div class=&quot;title&quot;&gt;\r\n			在线联系：\r\n		&lt;/div&gt;\r\n		&lt;div style=&quot;text-align:center;&quot;&gt;\r\n			&lt;a&gt;&lt;img src=&quot;/template/default/images/qq.png&quot; /&gt;&lt;/a&gt; \r\n			&lt;div class=&quot;qq-tip&quot;&gt;\r\n				点击qq头像联系我\r\n			&lt;/div&gt;\r\n		&lt;/div&gt;\r\n	&lt;/div&gt;\r\n	&lt;div class=&quot;item mobile&quot;&gt;\r\n		&lt;div class=&quot;title&quot;&gt;\r\n			其他联系方式\r\n		&lt;/div&gt;\r\n		&lt;p&gt;\r\n			肖先生：18688939187\r\n		&lt;/p&gt;\r\n		&lt;p&gt;\r\n			吴先生：18688939187\r\n		&lt;/p&gt;\r\n	&lt;/div&gt;\r\n&lt;/div&gt;');
INSERT INTO `ky_block` VALUES ('5', '3', '首页公司简介', '&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/aboutus.png&quot; width=&quot;154&quot; height=&quot;83&quot; /&gt; 百度，全球最大的中文搜索引擎最大的中文网站。二零零零年一月创立于北京中关村。从最初的不足十人人发展至今，员工人数超过一万两千人。如今的百度，已成为中国最受欢迎、影响力最大的中文网站。百度拥有数千名研发工程师，这是中国乃至全球最为优秀的技术团队，这支队伍掌握着世界上最为先进的搜索引擎技术，使百度... &lt;a href=&quot;http://www.xiaocms.com/&quot;&gt;[更多&amp;gt;&amp;gt;]&lt;/a&gt;');
INSERT INTO `ky_block` VALUES ('7', '3', 'test', 'test test');

-- ----------------------------
-- Table structure for ky_category
-- ----------------------------
DROP TABLE IF EXISTS `ky_category`;
CREATE TABLE `ky_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(1) NOT NULL,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `child` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `childids` varchar(255) NOT NULL,
  `catname` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `seo_title` varchar(255) NOT NULL,
  `seo_keywords` varchar(255) NOT NULL,
  `seo_description` varchar(255) NOT NULL,
  `catdir` varchar(30) NOT NULL,
  `http` varchar(255) NOT NULL,
  `items` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ismenu` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ispost` smallint(2) NOT NULL,
  `verify` smallint(2) NOT NULL DEFAULT '0',
  `islook` smallint(2) NOT NULL,
  `listtpl` varchar(50) NOT NULL,
  `showtpl` varchar(50) NOT NULL,
  `pagetpl` varchar(50) NOT NULL,
  `pagesize` smallint(5) NOT NULL,
  PRIMARY KEY (`catid`),
  KEY `listorder` (`listorder`,`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_category
-- ----------------------------
INSERT INTO `ky_category` VALUES ('1', '2', '0', '0', '0', '', '关于我们', '', '&lt;table border=&quot;0&quot; align=&quot;left&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; class=&quot;ke-zeroborder&quot;&gt;\r	&lt;tbody&gt;\r		&lt;tr&gt;\r			&lt;td width=&quot;170&quot; height=&quot;190&quot; valign=&quot;top&quot;&gt;\r				&lt;img src=&quot;http://home.baidu.com/resource/r/home/management_robin.jpg&quot; width=&quot;150&quot; height=&quot;180&quot; class=&quot;pho&quot; /&gt; \r			&lt;/td&gt;\r		&lt;/tr&gt;\r	&lt;/tbody&gt;\r&lt;/table&gt;\r&lt;p&gt;\r	李彦宏，百度公司创始人、董事长兼首席执行官，全面负责百度公司的战略规划和运营管理。\r&lt;/p&gt;\r&lt;p&gt;\r	2000年1月，李彦宏从美国硅谷回到祖国创建了百度。经过十年的发展，李彦宏领导下的百度已经发展成为全球第二大独立搜索引擎和最大的中文搜索引擎，在中国拥有超过8成的市场份额。2005年，百度在美国纳斯达克成功上市，并成为首家进入纳斯达克成分股的中国公司。\r&lt;/p&gt;\r&lt;p&gt;\r	创立百度之前，李彦宏已经跻身全球最顶尖的搜索引擎工程师行列，其拥有的“超链分析”技术专利，是奠定整个现代搜索引擎发展趋势和方向的基础发明之一。目前百度拥有4000名全球顶尖的搜索引擎产品和技术工程师，并成为中国第一个拥有博士后工作站的互联网公司。百度的成功，也使中国成为美国、俄罗斯、和韩国之外，全球仅有的4个拥有搜索引擎核心技术的国家之一。2009年百度技术创新大会上，李彦宏发布了面向未来的框计算技术理念，进一步完善了中国互联网科学的理论体系，并将带动整个IT产业的技术进步。在满足国内中文搜索需求的同时，李彦宏还带领百度积极推进国际化进程。\r&lt;/p&gt;\r&lt;p&gt;\r	作为国内互联网行业的先行者和领导者，李彦宏曾经获得 “CCTV中国经济年度人物”、“改革开放30年30人”、“中国最具思想力企业家”等荣誉称号，美国《商业周刊》和《财富》等杂志，也多次将李彦宏评为“全球最佳商业领袖” 和“中国最具影响商界领袖”。李彦宏先生还分别获选美国《时代》周刊以及《福布斯》评选的 2010 年“全球最具影响力人物”。\r&lt;/p&gt;\r&lt;p&gt;\r	李彦宏1991年毕业于北京大学信息管理专业，随后赴美国布法罗纽约州立大学攻读计算机科学，并取得硕士学位。现兼任中国互联网协会副理事长，武汉大学客座教授。\r&lt;/p&gt;\r&lt;p&gt;\r	李彦宏个人大事记：&lt;br /&gt;\r1996年，发明“超链分析”技术并获美国专利；&lt;br /&gt;\r1999年底，携风险投资回国与徐勇先生共同创建百度；&lt;br /&gt;\r2001年，被评选为“中国十大创业新锐”；&lt;br /&gt;\r2002年，2003年荣获首届、第二届“IT十大风云人物”称号；&lt;br /&gt;\r2005年，荣获第十二届“东盟青年奖”； 并荣获“CCTV2005中国经济年度人物”；&lt;br /&gt;\r2006年，当选美国《商业周刊》2006年全球“最佳商业领袖”；&lt;br /&gt;\r2007年，当选艾瑞新经济最佳人物奖；&lt;br /&gt;\r2008年6月，担任2008年北京奥运会火炬手；&lt;br /&gt;\r2008年12月，当选中国经济体制改革研究会评出的“中国改革开放30年经济人物”；&lt;br /&gt;\r2009年12月，获评“2009第一财经•中国企业社会责任杰出人物奖”；&lt;br /&gt;\r2010年4月，入选《时代》杂志2010年全球最具影响力100人物榜单；&lt;br /&gt;\r2010年8月，获“纳斯达克全球杰出企业家”荣誉；&lt;br /&gt;\r2010年10月，荣膺2010年度十大气候公益企业家 ；&lt;br /&gt;\r2010年11月，上榜福布斯2010全球最具影响力人物。&lt;br /&gt;\r2010年11月，被美国《财富》杂志评为2010年度全球商业人士第6名，成为第一位进入该榜单前10名的中国人。\r&lt;/p&gt;', '', '', '', 'about', '', '0', '0', '1', '0', '0', '0', '', '', 'page.html', '10');
INSERT INTO `ky_category` VALUES ('21', '1', '2', '0', '0', '', '矿用金属原材料', '', '', '', '', '', 'kuangyongjinshuyuancailiao', '', '0', '2', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '10');
INSERT INTO `ky_category` VALUES ('20', '1', '2', '0', '0', '', '矿山运输工具', '', '', '', '', '', 'kuangshanyunshugongju', '', '5', '3', '1', '0', '0', '0', 'list_product.html', 'show_product.html', 'page.html', '10');
INSERT INTO `ky_category` VALUES ('19', '1', '2', '0', '0', '', '矿用支护工具', '', '', '', '', '', 'kuangyongzhihugongju', '', '2', '4', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '10');
INSERT INTO `ky_category` VALUES ('13', '2', '0', '0', '0', '', '联系我们', '', '&lt;p&gt;\r\n	&lt;span style=&quot;line-height:1.5;&quot;&gt;涟源凯越&lt;/span&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;矿山设备经销批发零售总公司&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	地　址&lt;span&gt;：&lt;/span&gt;北京市海淀区上地十街10号\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	邮　编&lt;span&gt;：&lt;/span&gt;100085\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	总　机： (+86 10) 5992 8888\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	传　真： (+86 10) 5992 0000\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;iframe src=&quot;/core/img/kindeditor/plugins/baidumap/index.html?center=116.428308%2C39.919095&amp;amp;zoom=13&amp;amp;width=558&amp;amp;height=360&amp;amp;markers=116.428308%2C39.919095&amp;amp;markerStyles=l%2CA&quot; frameborder=&quot;0&quot; style=&quot;width:560px;height:362px;&quot;&gt;\r\n	&lt;/iframe&gt;\r\n&lt;/p&gt;', '', '', '', 'contact', '', '0', '1', '0', '0', '0', '0', '', '', 'page.html', '10');

-- ----------------------------
-- Table structure for ky_content
-- ----------------------------
DROP TABLE IF EXISTS `ky_content`;
CREATE TABLE `ky_content` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `catid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `modelid` smallint(5) NOT NULL,
  `title` varchar(80) NOT NULL DEFAULT '',
  `thumb` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `hits` smallint(5) unsigned NOT NULL DEFAULT '0',
  `username` char(20) NOT NULL,
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`,`listorder`,`time`),
  KEY `time` (`catid`,`time`),
  KEY `status` (`catid`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_content
-- ----------------------------
INSERT INTO `ky_content` VALUES ('45', '20', '2', '绞车', '/data/upload/image/201411/fc8776bdaa4534c405d9b151f23cc11f.jpg', '绞车', '绞车', '0', '1', '2', 'admin', '1416729438');
INSERT INTO `ky_content` VALUES ('39', '19', '2', 'U型支架', '/data/upload/image/201411/7f0b4db6957f965ba220d4b0de6f2fb8.jpg', 'U型支架.jpg', 'U型支架.jpg', '0', '1', '0', 'admin', '1416728262');
INSERT INTO `ky_content` VALUES ('40', '19', '2', '工字钢支架', '/data/upload/image/201411/3eb9a23d2506acb6cf408830a3c29709.jpg', '工字钢支架', '工字钢支架', '0', '1', '6', 'admin', '1416728316');
INSERT INTO `ky_content` VALUES ('41', '20', '2', '推车器', '/data/upload/image/201411/44bdfd15e00822f5df4788ab66dcdec4.jpg', '推车器', '推车器', '0', '1', '0', 'admin', '1416728929');
INSERT INTO `ky_content` VALUES ('42', '20', '2', '阻车器', '/data/upload/image/201411/0c747302db60fb35aa0bfe48771b0168.jpg', '阻车器', '阻车器', '0', '1', '0', 'admin', '1416729129');
INSERT INTO `ky_content` VALUES ('43', '20', '2', '矿车', '/data/upload/image/201411/098b37b13c065f902f7d9b84dcf8a1f6.jpg', '矿车', '矿车', '0', '1', '0', 'admin', '1416729273');
INSERT INTO `ky_content` VALUES ('44', '20', '2', '轻轨', '/data/upload/image/201411/132dab0eb80cb31c611d0a0974404ea3.jpg', '轻轨', '轻轨', '0', '1', '0', 'admin', '1416729334');

-- ----------------------------
-- Table structure for ky_content_news
-- ----------------------------
DROP TABLE IF EXISTS `ky_content_news`;
CREATE TABLE `ky_content_news` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_content_news
-- ----------------------------
INSERT INTO `ky_content_news` VALUES ('22', '6', '5555');
INSERT INTO `ky_content_news` VALUES ('23', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_news` VALUES ('24', '6', '发发发发发发发发发发发发发反复反复反复反复反复反复反复方法');
INSERT INTO `ky_content_news` VALUES ('25', '16', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');

-- ----------------------------
-- Table structure for ky_content_product
-- ----------------------------
DROP TABLE IF EXISTS `ky_content_product`;
CREATE TABLE `ky_content_product` (
  `id` mediumint(8) NOT NULL,
  `catid` smallint(5) NOT NULL,
  `content` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `catid` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_content_product
-- ----------------------------
INSERT INTO `ky_content_product` VALUES ('39', '19', '');
INSERT INTO `ky_content_product` VALUES ('40', '19', '&lt;p&gt;\r\n	&lt;img src=&quot;/data/upload/image/201411/3eb9a23d2506acb6cf408830a3c29709.jpg&quot; alt=&quot;&quot; /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	可以在产品中添加内容\r\n&lt;/p&gt;');
INSERT INTO `ky_content_product` VALUES ('41', '20', '&lt;img src=&quot;/data/upload/image/201411/44bdfd15e00822f5df4788ab66dcdec4.jpg&quot; alt=&quot;&quot; /&gt;');
INSERT INTO `ky_content_product` VALUES ('42', '20', '');
INSERT INTO `ky_content_product` VALUES ('43', '20', '矿车');
INSERT INTO `ky_content_product` VALUES ('44', '20', '轻轨');
INSERT INTO `ky_content_product` VALUES ('45', '20', '');

-- ----------------------------
-- Table structure for ky_form_comment
-- ----------------------------
DROP TABLE IF EXISTS `ky_form_comment`;
CREATE TABLE `ky_form_comment` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `pinglunneirong` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_form_comment
-- ----------------------------

-- ----------------------------
-- Table structure for ky_form_gestbook
-- ----------------------------
DROP TABLE IF EXISTS `ky_form_gestbook`;
CREATE TABLE `ky_form_gestbook` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL,
  `userid` mediumint(8) NOT NULL,
  `username` char(20) NOT NULL,
  `listorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip` char(20) DEFAULT NULL,
  `nindexingming` varchar(255) DEFAULT NULL,
  `lianxiQQ` varchar(255) DEFAULT NULL,
  `liuyanneirong` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listorder` (`listorder`),
  KEY `status` (`status`),
  KEY `time` (`time`),
  KEY `userid` (`userid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_form_gestbook
-- ----------------------------

-- ----------------------------
-- Table structure for ky_member
-- ----------------------------
DROP TABLE IF EXISTS `ky_member`;
CREATE TABLE `ky_member` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL DEFAULT '',
  `password` char(32) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT '',
  `modelid` smallint(5) NOT NULL,
  `regdate` int(10) unsigned NOT NULL DEFAULT '0',
  `regip` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_member
-- ----------------------------

-- ----------------------------
-- Table structure for ky_member_geren
-- ----------------------------
DROP TABLE IF EXISTS `ky_member_geren`;
CREATE TABLE `ky_member_geren` (
  `id` mediumint(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_member_geren
-- ----------------------------

-- ----------------------------
-- Table structure for ky_model
-- ----------------------------
DROP TABLE IF EXISTS `ky_model`;
CREATE TABLE `ky_model` (
  `modelid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` tinyint(3) NOT NULL,
  `modelname` char(30) NOT NULL,
  `tablename` char(20) NOT NULL,
  `listtpl` varchar(30) NOT NULL,
  `showtpl` varchar(30) NOT NULL,
  `joinid` smallint(5) DEFAULT NULL,
  `setting` text,
  PRIMARY KEY (`modelid`),
  KEY `typeid` (`typeid`),
  KEY `joinid` (`joinid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_model
-- ----------------------------
INSERT INTO `ky_model` VALUES ('1', '1', '文章模型', 'content_news', 'list_news.html', 'show_news.html', '0', 'a:1:{s:7:\"default\";a:6:{s:5:\"title\";a:2:{s:4:\"name\";s:6:\"标题\";s:4:\"show\";s:1:\"1\";}s:8:\"keywords\";a:2:{s:4:\"name\";s:9:\"关键字\";s:4:\"show\";s:1:\"1\";}s:5:\"thumb\";a:2:{s:4:\"name\";s:9:\"缩略图\";s:4:\"show\";s:1:\"1\";}s:11:\"description\";a:2:{s:4:\"name\";s:6:\"描述\";s:4:\"show\";s:1:\"1\";}s:4:\"time\";a:2:{s:4:\"name\";s:12:\"发布时间\";s:4:\"show\";s:1:\"1\";}s:4:\"hits\";a:2:{s:4:\"name\";s:9:\"阅读数\";s:4:\"show\";s:1:\"1\";}}}');
INSERT INTO `ky_model` VALUES ('2', '1', '产品模型', 'content_product', 'list_product.html', 'show_product.html', null, 'a:1:{s:7:\"default\";a:6:{s:5:\"title\";a:2:{s:4:\"name\";s:6:\"标题\";s:4:\"show\";s:1:\"1\";}s:8:\"keywords\";a:2:{s:4:\"name\";s:9:\"关键字\";s:4:\"show\";s:1:\"1\";}s:5:\"thumb\";a:2:{s:4:\"name\";s:9:\"缩略图\";s:4:\"show\";s:1:\"1\";}s:11:\"description\";a:2:{s:4:\"name\";s:6:\"描述\";s:4:\"show\";s:1:\"1\";}s:4:\"time\";a:2:{s:4:\"name\";s:12:\"发布时间\";s:4:\"show\";s:1:\"1\";}s:4:\"hits\";a:2:{s:4:\"name\";s:9:\"阅读数\";s:4:\"show\";s:1:\"1\";}}}');
INSERT INTO `ky_model` VALUES ('3', '3', '在线留言', 'form_gestbook', 'list_gestbook.html', 'form.html', null, 'a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"0\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:3:{i:0;s:13:\"nindexingming\";i:1;s:8:\"lianxiQQ\";i:2;s:13:\"liuyanneirong\";}s:10:\"membershow\";a:3:{i:0;s:13:\"nindexingming\";i:1;s:8:\"lianxiQQ\";i:2;s:13:\"liuyanneirong\";}}}');
INSERT INTO `ky_model` VALUES ('4', '3', '文章评论', 'form_comment', 'list_comment.html', 'form.html', '1', 'a:1:{s:4:\"form\";a:8:{s:4:\"post\";s:1:\"0\";s:3:\"num\";s:1:\"0\";s:4:\"time\";s:0:\"\";s:5:\"check\";s:1:\"0\";s:4:\"code\";s:1:\"0\";s:6:\"member\";s:1:\"0\";s:4:\"show\";a:1:{i:0;s:14:\"pinglunneirong\";}s:10:\"membershow\";a:1:{i:0;s:14:\"pinglunneirong\";}}}');
INSERT INTO `ky_model` VALUES ('5', '2', '个人', 'member_geren', 'list_geren.html', 'show_geren.html', null, null);

-- ----------------------------
-- Table structure for ky_model_field
-- ----------------------------
DROP TABLE IF EXISTS `ky_model_field`;
CREATE TABLE `ky_model_field` (
  `fieldid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `modelid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `isshow` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `tips` text NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `errortips` varchar(255) NOT NULL,
  `formtype` varchar(20) NOT NULL,
  `setting` mediumtext NOT NULL,
  `listorder` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `disabled` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldid`),
  KEY `modelid` (`modelid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_model_field
-- ----------------------------
INSERT INTO `ky_model_field` VALUES ('1', '1', 'content', '内容', '1', '', '', '', 'editor', 'a:4:{s:7:\"toolbar\";s:1:\"1\";s:5:\"width\";s:3:\"700\";s:6:\"height\";s:3:\"450\";s:12:\"defaultvalue\";s:0:\"\";}', '0', '0');
INSERT INTO `ky_model_field` VALUES ('2', '2', 'content', '内容', '1', '', '', '', 'editor', 'a:5:{s:7:\"toolbar\";s:1:\"2\";s:5:\"items\";s:256:\"\'source\',\'|\',\'forecolor\',\'bold\',\'italic\',\'underline\',\'lineheight\',\'|\',\'fontname\',\'fontsize\',\'code\',\'plainpaste\',\'wordpaste\',\'|\',\'image\',\'multiimage\',\'flash\',\'media\',\'insertfile\',\'link\',\'unlink\',\'|\',\'justifyleft\',\'justifycenter\',\'justifyright\',\'justifyfull\'\";s:5:\"width\";s:3:\"700\";s:6:\"height\";s:3:\"450\";s:12:\"defaultvalue\";s:190:\"编辑器支持自定义啦，赶快去内容模型》产品模型》字段管理》编辑器里面看看吧&lt;br&gt;如需更多字段，请大家自己在字段管理处自行添加吧。\";}', '0', '0');
INSERT INTO `ky_model_field` VALUES ('3', '3', 'nindexingming', '您的姓名', '1', '', '', '', 'input', 'a:2:{s:4:\"size\";s:3:\"150\";s:12:\"defaultvalue\";s:0:\"\";}', '0', '0');
INSERT INTO `ky_model_field` VALUES ('4', '3', 'lianxiQQ', '联系QQ', '1', '', '/^[0-9]{5,20}$/', '', 'input', 'a:2:{s:4:\"size\";s:3:\"150\";s:12:\"defaultvalue\";s:0:\"\";}', '0', '0');
INSERT INTO `ky_model_field` VALUES ('5', '3', 'liuyanneirong', '留言内容', '1', '', '1', '留言内容不能为空', 'textarea', 'a:3:{s:5:\"width\";s:3:\"400\";s:6:\"height\";s:2:\"90\";s:12:\"defaultvalue\";s:0:\"\";}', '0', '0');
INSERT INTO `ky_model_field` VALUES ('6', '4', 'pinglunneirong', '评论内容', '1', '', '1', '评论内容不能为空', 'textarea', 'a:3:{s:5:\"width\";s:3:\"400\";s:6:\"height\";s:2:\"90\";s:12:\"defaultvalue\";s:0:\"\";}', '0', '0');
