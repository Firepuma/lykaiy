/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : kycms

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2014-11-05 23:01:23
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
INSERT INTO `ky_block` VALUES ('4', '3', '联系我们', '&lt;p&gt;\r	&lt;span style=&quot;line-height:1.5;&quot;&gt;百度技术有限责任公司&lt;/span&gt;\r&lt;/p&gt;\r&lt;p&gt;\r	地　址&lt;span&gt;：&lt;/span&gt;北京市海淀区上地十街10号\r&lt;/p&gt;\r&lt;p&gt;\r	邮　编&lt;span&gt;：&lt;/span&gt;100085\r&lt;/p&gt;\r&lt;p&gt;\r	总　机： (+86 10) 5992 8888\r&lt;/p&gt;\r&lt;p&gt;\r	传　真： (+86 10) 5992 0000\r&lt;/p&gt;');
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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_category
-- ----------------------------
INSERT INTO `ky_category` VALUES ('1', '2', '0', '0', '0', '', '关于我们', '', '&lt;table border=&quot;0&quot; align=&quot;left&quot; cellpadding=&quot;0&quot; cellspacing=&quot;0&quot; class=&quot;ke-zeroborder&quot;&gt;\r	&lt;tbody&gt;\r		&lt;tr&gt;\r			&lt;td width=&quot;170&quot; height=&quot;190&quot; valign=&quot;top&quot;&gt;\r				&lt;img src=&quot;http://home.baidu.com/resource/r/home/management_robin.jpg&quot; width=&quot;150&quot; height=&quot;180&quot; class=&quot;pho&quot; /&gt; \r			&lt;/td&gt;\r		&lt;/tr&gt;\r	&lt;/tbody&gt;\r&lt;/table&gt;\r&lt;p&gt;\r	李彦宏，百度公司创始人、董事长兼首席执行官，全面负责百度公司的战略规划和运营管理。\r&lt;/p&gt;\r&lt;p&gt;\r	2000年1月，李彦宏从美国硅谷回到祖国创建了百度。经过十年的发展，李彦宏领导下的百度已经发展成为全球第二大独立搜索引擎和最大的中文搜索引擎，在中国拥有超过8成的市场份额。2005年，百度在美国纳斯达克成功上市，并成为首家进入纳斯达克成分股的中国公司。\r&lt;/p&gt;\r&lt;p&gt;\r	创立百度之前，李彦宏已经跻身全球最顶尖的搜索引擎工程师行列，其拥有的“超链分析”技术专利，是奠定整个现代搜索引擎发展趋势和方向的基础发明之一。目前百度拥有4000名全球顶尖的搜索引擎产品和技术工程师，并成为中国第一个拥有博士后工作站的互联网公司。百度的成功，也使中国成为美国、俄罗斯、和韩国之外，全球仅有的4个拥有搜索引擎核心技术的国家之一。2009年百度技术创新大会上，李彦宏发布了面向未来的框计算技术理念，进一步完善了中国互联网科学的理论体系，并将带动整个IT产业的技术进步。在满足国内中文搜索需求的同时，李彦宏还带领百度积极推进国际化进程。\r&lt;/p&gt;\r&lt;p&gt;\r	作为国内互联网行业的先行者和领导者，李彦宏曾经获得 “CCTV中国经济年度人物”、“改革开放30年30人”、“中国最具思想力企业家”等荣誉称号，美国《商业周刊》和《财富》等杂志，也多次将李彦宏评为“全球最佳商业领袖” 和“中国最具影响商界领袖”。李彦宏先生还分别获选美国《时代》周刊以及《福布斯》评选的 2010 年“全球最具影响力人物”。\r&lt;/p&gt;\r&lt;p&gt;\r	李彦宏1991年毕业于北京大学信息管理专业，随后赴美国布法罗纽约州立大学攻读计算机科学，并取得硕士学位。现兼任中国互联网协会副理事长，武汉大学客座教授。\r&lt;/p&gt;\r&lt;p&gt;\r	李彦宏个人大事记：&lt;br /&gt;\r1996年，发明“超链分析”技术并获美国专利；&lt;br /&gt;\r1999年底，携风险投资回国与徐勇先生共同创建百度；&lt;br /&gt;\r2001年，被评选为“中国十大创业新锐”；&lt;br /&gt;\r2002年，2003年荣获首届、第二届“IT十大风云人物”称号；&lt;br /&gt;\r2005年，荣获第十二届“东盟青年奖”； 并荣获“CCTV2005中国经济年度人物”；&lt;br /&gt;\r2006年，当选美国《商业周刊》2006年全球“最佳商业领袖”；&lt;br /&gt;\r2007年，当选艾瑞新经济最佳人物奖；&lt;br /&gt;\r2008年6月，担任2008年北京奥运会火炬手；&lt;br /&gt;\r2008年12月，当选中国经济体制改革研究会评出的“中国改革开放30年经济人物”；&lt;br /&gt;\r2009年12月，获评“2009第一财经•中国企业社会责任杰出人物奖”；&lt;br /&gt;\r2010年4月，入选《时代》杂志2010年全球最具影响力100人物榜单；&lt;br /&gt;\r2010年8月，获“纳斯达克全球杰出企业家”荣誉；&lt;br /&gt;\r2010年10月，荣膺2010年度十大气候公益企业家 ；&lt;br /&gt;\r2010年11月，上榜福布斯2010全球最具影响力人物。&lt;br /&gt;\r2010年11月，被美国《财富》杂志评为2010年度全球商业人士第6名，成为第一位进入该榜单前10名的中国人。\r&lt;/p&gt;', '', '', '', 'about', '', '0', '0', '1', '0', '0', '0', '', '', 'page.html', '10');
INSERT INTO `ky_category` VALUES ('2', '2', '0', '0', '1', '3,4,', '新闻资讯', '', '', '', '', '', 'news', '', '21', '2', '1', '0', '0', '0', '', '', 'category_news.html', '10');
INSERT INTO `ky_category` VALUES ('3', '1', '1', '2', '0', '', '公司新闻', '', '', '', '', '', 'gongsixinwen', '', '9', '2', '1', '0', '0', '0', 'list_news.html', 'show_news.html', '', '10');
INSERT INTO `ky_category` VALUES ('4', '1', '1', '2', '0', '', '行业新闻', '', '', '', '', '', 'xingyexinwen', '', '12', '2', '1', '0', '0', '0', 'list_news.html', 'show_news.html', '', '10');
INSERT INTO `ky_category` VALUES ('5', '1', '2', '0', '1', '6,7,8,', '矿山设备', '', '', '', '', '', 'product', '', '13', '3', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '9');
INSERT INTO `ky_category` VALUES ('6', '1', '2', '5', '0', '', '矿用支护', '', '', '', '', '', 'chanpinxilieyi', '', '11', '0', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '9');
INSERT INTO `ky_category` VALUES ('7', '1', '2', '5', '0', '', '矿用运输', '', '', '', '', '', 'chanpinxilieer', '', '2', '0', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '9');
INSERT INTO `ky_category` VALUES ('8', '1', '2', '5', '0', '', '矿用材料', '', '', '', '', '', 'chanpinxiliesan', '', '0', '0', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '9');
INSERT INTO `ky_category` VALUES ('17', '1', '2', '0', '0', '', '原材料', '', '', '', '', '', 'yuancailiao', '', '0', '3', '1', '0', '0', '0', 'list_product.html', 'show_product.html', '', '10');
INSERT INTO `ky_category` VALUES ('13', '2', '0', '0', '0', '', '联系我们', '', '&lt;p&gt;\r\n	官方网站：&lt;a href=&quot;http://www.xiaocms.com&quot; target=&quot;_blank&quot;&gt;http://www.xiaocms.com&lt;/a&gt; \r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	百度技术有限责任公司\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	地　址&lt;span&gt;：&lt;/span&gt;北京市海淀区上地十街10号\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	邮　编&lt;span&gt;：&lt;/span&gt;100085\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	总　机： (+86 10) 5992 8888\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	传　真： (+86 10) 5992 0000\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;iframe src=&quot;/core/img/kindeditor/plugins/baidumap/index.html?center=116.428308%2C39.919095&amp;zoom=13&amp;width=558&amp;height=360&amp;markers=116.428308%2C39.919095&amp;markerStyles=l%2CA&quot; frameborder=&quot;0&quot; style=&quot;width:560px;height:362px;&quot;&gt;\r\n	&lt;/iframe&gt;\r\n&lt;/p&gt;', '', '', '', 'contact', '', '0', '1', '1', '0', '0', '0', '', '', 'page.html', '10');
INSERT INTO `ky_category` VALUES ('18', '1', '2', '0', '0', '', '机械加工', '', '', '', '', '', 'jixiejiagong', '', '0', '3', '1', '0', '0', '0', 'list_product.html', 'show_product.html', 'page.html', '10');

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
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ky_content
-- ----------------------------
INSERT INTO `ky_content` VALUES ('1', '4', '1', '揭秘国内卖港版苹果为何比香港还便宜？', '', '', '如果买苹果手机或iPad，传统渠道我们会从苹果官网、京东类电商，以及电信运营商等等渠道购买。但由于中国税率问题，往往正规渠道购买的苹果设备售价不菲。相比从香港、美国（免税州）购买免税的苹果产品贵不少，因此...', '0', '1', '0', 'admin', '1392971593');
INSERT INTO `ky_content` VALUES ('2', '4', '1', '揭秘国内卖港版苹果为何比香港还便宜？', '', '', '如果买苹果手机或iPad，传统渠道我们会从苹果官网、京东类电商，以及电信运营商等等渠道购买。但由于中国税率问题，往往正规渠道购买的苹果设备售价不菲。相比从香港、美国（免税州）购买免税的苹果产品贵不少，因此...', '0', '1', '0', 'admin', '1392971594');
INSERT INTO `ky_content` VALUES ('3', '4', '1', 'XP系统即将停止服务 2亿中国用户何去何从？', '', '', '有数据显示，我国XP系统市场份额高达70%，个人用户安装和使用该操作系统的计算机将近2亿台。4月8日，微软将正式停止对WindowsXP的服务支持。记者随机选择使用电脑办公的近30名受访者进行调查后发现，超过八成的受访...', '0', '1', '0', 'admin', '1392971627');
INSERT INTO `ky_content` VALUES ('4', '4', '1', '中国彩电代名词“厦华彩电”即将停产', '', '', '位于亚热带的厦门连日来遭遇了这个冬天的最冷天气，厦华电子公司许多员工尤其是老员工，他们的心情也与这个阴冷的天气一样。在厦门已走过30年历程的厦华电子公司即将停产，员工们也要结束自己的厦华工作生涯了。据了...', '0', '1', '0', 'admin', '1392971654');
INSERT INTO `ky_content` VALUES ('5', '4', '1', 'Android之父称当初三星看不上Android', '', '', '如果按照今天的标准来看，在2005年市面上还没有智能手机，而运营商不仅能够决定手机中的应用程序，甚至还能够控制使用手机进行搜索时的搜索结果。与此同时，市面上的手机运行的操作系统几乎都不一样，适用于诺基亚手...', '0', '1', '0', 'admin', '1392971695');
INSERT INTO `ky_content` VALUES ('6', '4', '1', 'Office Online 网页版Office正式更名', '', '', '微软的AmandaLefebvre表示：“用户们说，把Apps包含在名称中会令人感觉困惑。”先前OfficeWebApps这个名称让很多用户误以为是需要安装的应用，而不是线上Office概念。新品牌的定义实际上并没有为这款产品加入什么新...', '0', '1', '0', 'admin', '1392971728');
INSERT INTO `ky_content` VALUES ('7', '4', '1', '拥有一台就够了 全模式联想Miix 2 10评测', '', '', '在这样多元化的时代中，处于变化与创新顶端的并不是苹果、三星等国际品牌，而是联想。从超极本时代的多模变形的YOGA超极本，到去年年底的变形YOGA平板，再到二合一平板Miix2，都走在时代的前沿。二合一的平板笔记本...', '0', '1', '0', 'admin', '1392971795');
INSERT INTO `ky_content` VALUES ('8', '4', '1', '双显卡散热咋解决?拆万元旗舰本找答案', '', '', '雷神品牌产品上市一个多月的时间里，迅速吸引了大批用户的关注。被神舟战神洗礼了一年多的高性价比游戏本市场，随着雷神的出现，也拥有了更多的选择空间。虽然雷神也是由蓝天提供模具而推出的产品，但是在一些细节方...', '0', '1', '0', 'admin', '1392971830');
INSERT INTO `ky_content` VALUES ('9', '4', '1', '2014年度旗舰 索尼新品85吋电视全解析', '', '', '年复一年，索尼旗舰级电视产品总能成为全球发烧级用户的讨论焦点，无论是工业设计、画质表现还是实际体验，索尼旗舰级电视无疑都是业界的标杆，索尼产品工业设计的天赋无需多说，业内最强的画质表现才是人们讨论的核...', '0', '1', '0', 'admin', '1392971862');
INSERT INTO `ky_content` VALUES ('10', '4', '1', 'Intel总裁: 和苹果正内测可穿戴设备', '', '', '去年五月上任的Intel新总裁BrianKrzanich，在周三参加了着名网站Reddit的“随便问吧（AskMeAnything）”问答活动。热情的网友们问了他许多问题。其中就有人问到，Intel和苹果公司现在的关系怎么样；Mac电脑使用Intel...', '0', '1', '0', 'admin', '1392971908');
INSERT INTO `ky_content` VALUES ('11', '4', '1', '2014年笔记本电脑面板短缺或高达2000万块', '', '', '2月20日消息，据台湾媒体Digitimes研究，由于三星显示器不断将生产重点从笔记本电脑面板转移到AMOLED面板，这将增加台湾面板厂如友达在2014年的笔记本电脑面板订单。大多数面板制造商，包括大陆厂商，主要集中在中小...', '0', '1', '0', 'admin', '1392971937');
INSERT INTO `ky_content` VALUES ('12', '4', '1', '今明两年或将出现用IMAX机器拍摄的中国电影', '', '', '随着IMAX影院在全国的迅猛发展，IMAX集团正在试图让更多中国电影IMAX化。IMAX首席执行官(CEO)理查德·格尔福特(RichardGelfond)日前在接受采访时表示，目前正在推动中国导演直接用IMAX机器拍摄电影，“已经有一些导...', '0', '1', '0', 'admin', '1392972013');
INSERT INTO `ky_content` VALUES ('13', '3', '1', '迅雷路由配置/功能/价格曝光：要火的节奏', '', '', '在极路由、小米、360、百度、华为等厂商纷纷进军智能路由器之后，迅雷也终于忍不住了，在今年初宣布进军智能路由器市场。而迅雷内部人士则表示迅雷路由将定位高性能，硬件配置十分发烧，不输小米路由器。而且迅雷在...', '0', '1', '0', 'admin', '1392972121');
INSERT INTO `ky_content` VALUES ('14', '3', '1', 'PC不死：仍然引领科技创新大潮', '', '', '网易数码2月19日消息，随着智能手机、平板电脑和可穿戴设备的蓬勃发展，关于“PC将死”的说法又开始甚嚣尘上，那么PC真的已经走到创新乏力、穷途末路的地步了么？答案当然是否定的。在许多科技媒体看来，PC的死期已...', '0', '1', '0', 'admin', '1392972166');
INSERT INTO `ky_content` VALUES ('15', '3', '1', '手机健康应用和可穿戴健康的区别在哪儿？', '', '', '继三星将SHealth健康管理服务集成到所有Galaxy系列旗舰机型之后，苹果和微软也开始有了新动作。前者将在iOS8中内置Healthbook和WatchUtility两款软件，除了可以通过手机内置传感器监测健康状态之外，还可以使用智能...', '0', '1', '0', 'admin', '1392972188');
INSERT INTO `ky_content` VALUES ('16', '3', '1', '处理器提升显著 评海尔T400便携笔记本', '', '', 'T400，这个型号在电脑产品中经常见到，其中最有名的就要属ThinkPadT400了。不过，在海尔笔记本电脑产品线上，也有型号为T400的产品，而且它的定位与ThinkPad完全不同。面向家庭用户的海尔T400除了具备不错的综合性能...', '0', '1', '1', 'admin', '1392972243');
INSERT INTO `ky_content` VALUES ('17', '3', '1', '英特尔2014规划图曝光 移动市场依旧是重点', '', '', '英特尔作为全球最大的芯片制造商，它的动向往往影响着整个产业的发展。那么2014年英特尔的重点会是什么呢？近日VR-Zone公布了一张英特尔2014年芯片方面的规划图，下面就让笔者带大家来看一看。2014年，英特尔首先将...', '0', '1', '0', 'admin', '1392972288');
INSERT INTO `ky_content` VALUES ('18', '3', '1', '可穿戴智能设备的未来：留下智能，摆脱设备', '', '', '最近我使用了一款Picooc的智能秤，之所以称为智能秤，是因为通过它不只能得到自己的体重数据，还能了解自己的BMI（即身体质量指数）以及多项身体指标，根据你的身体数据系统会有针对性地给出运动和饮食建议。正如智...', '0', '1', '0', 'admin', '1392972322');
INSERT INTO `ky_content` VALUES ('19', '3', '1', '专家详解网购新规热点：7天无理由退货怎么退', '', '', '记者在淘宝网高级搜索中发现，全网符合全新商品检索条件的商品为34247万件，而加入七天退换保障条件的宝贝仅有12281.24万件。不少店铺仍在首页挂出类似“尺码色差等不属于质量问题不予退换”的免责声明，看似温馨提...', '0', '1', '2', 'admin', '1392972444');
INSERT INTO `ky_content` VALUES ('20', '3', '1', '从PC走向多元市场 AMD高管Lisa Su看涨APU走势', '', '', '网易科技讯2月21日消息，正是由于一年多以前开始的复兴计划，AMD并没有随着PC市场的下滑而进入困境，相反，AMD通过嵌入式、游戏主机、数据中心等领域的业务发展反哺PC，再次通过KaveriAPU走回PC市场。AMD高级副总裁...', '0', '1', '3', 'admin', '1392972494');
INSERT INTO `ky_content` VALUES ('21', '3', '1', 'XiaoCMS X1 企业建站版 正式发布', 'http://demo.xiaocms.com/template/default/images/benchi.jpg', '', '官方网站：http://www.xiaocms.com\r如果您有任何问题或者建议欢迎联系我们', '0', '2', '2', 'admin', '1392975675');
INSERT INTO `ky_content` VALUES ('27', '6', '2', '案例展示', 'http://demo.xiaocms.com/template/default/images/bigmacbook.jpg', '', '', '0', '1', '1', 'admin', '1392974354');
INSERT INTO `ky_content` VALUES ('24', '6', '2', '案例展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974257');
INSERT INTO `ky_content` VALUES ('26', '6', '2', '案例展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974339');
INSERT INTO `ky_content` VALUES ('28', '6', '2', '案例展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '1', 'admin', '1392974364');
INSERT INTO `ky_content` VALUES ('29', '6', '2', '案例展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '1', 'admin', '1392974386');
INSERT INTO `ky_content` VALUES ('30', '7', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974404');
INSERT INTO `ky_content` VALUES ('31', '7', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '1', 'admin', '1392974410');
INSERT INTO `ky_content` VALUES ('32', '6', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974422');
INSERT INTO `ky_content` VALUES ('33', '6', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974430');
INSERT INTO `ky_content` VALUES ('34', '6', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974439');
INSERT INTO `ky_content` VALUES ('35', '6', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '0', 'admin', '1392974450');
INSERT INTO `ky_content` VALUES ('36', '6', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '1', 'admin', '1392974463');
INSERT INTO `ky_content` VALUES ('37', '6', '2', '产品展示', 'http://demo.xiaocms.com/template/default/images/macbook.jpg', '', '', '0', '1', '4', 'admin', '1392974470');

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
INSERT INTO `ky_content_news` VALUES ('1', '4', '如果买苹果手机或iPad，传统渠道我们会从苹果官网、京东类电商，以及电信运营商等等渠道购买。但由于中国税率问题，往往正规渠道购买的苹果设备售价不菲。相比从香港、美国（免税州）购买免税的苹果产品贵不少，因此身边有朋友出国，总会有人求带各类苹果设备。那么到底能省多少钱呢？&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r以iPad Air为例，目前苹果中国官网白色WiFi-32GB容量版报价是4288元，而苹果香港免税价格为4688港币，折合人民币（2月21日汇率）为3681元。差价多达600元，此外港版的苹果设备在国内也是可以保修的，系统切换到简体中文后完全无差别，性价比非常高，因此不少人选择在香港购买苹果设备。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r回到主题，中关村目前白色WiFi-32GB容量版iPad Air报价多少钱呢？小编咨询到的价格是3700元左右，也有3680元，几乎和港版售价一致。此外，如苹果iPhone5s，白色版的16GB港版价格是5588港币，折合人民币是4388元，而中关村报价为4300元，甚至低于港版免税价。问题来了，我们都知道港版苹果之所以便宜是因为免税，但这些中关村的渠道商们卖港版苹果为何还会低于免税价，他们不赚钱了吗？答案当然是否定的。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('2', '4', '如果买苹果手机或iPad，传统渠道我们会从苹果官网、京东类电商，以及电信运营商等等渠道购买。但由于中国税率问题，往往正规渠道购买的苹果设备售价不菲。相比从香港、美国（免税州）购买免税的苹果产品贵不少，因此身边有朋友出国，总会有人求带各类苹果设备。那么到底能省多少钱呢？&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r以iPad Air为例，目前苹果中国官网白色WiFi-32GB容量版报价是4288元，而苹果香港免税价格为4688港币，折合人民币（2月21日汇率）为3681元。差价多达600元，此外港版的苹果设备在国内也是可以保修的，系统切换到简体中文后完全无差别，性价比非常高，因此不少人选择在香港购买苹果设备。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r回到主题，中关村目前白色WiFi-32GB容量版iPad Air报价多少钱呢？小编咨询到的价格是3700元左右，也有3680元，几乎和港版售价一致。此外，如苹果iPhone5s，白色版的16GB港版价格是5588港币，折合人民币是4388元，而中关村报价为4300元，甚至低于港版免税价。问题来了，我们都知道港版苹果之所以便宜是因为免税，但这些中关村的渠道商们卖港版苹果为何还会低于免税价，他们不赚钱了吗？答案当然是否定的。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('3', '4', '有数据显示，我国XP系统市场份额高达70%，个人用户安装和使用该操作系统的计算机将近2亿台。4月8日，微软将正式停止对Windows XP的服务支持。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r记者随机选择使用电脑办公的近30名受访者进行调查后发现，超过八成的受访者在公司或家中使用的电脑是XP系统，但仅有不到３成的受访者知道该系统将被停止技术服务的消息。在得知此消息后，部分用户表示将更换为Windows 7或更高级别的操作系统，一部分用户则选择“坚守”。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r在北京一家事业单位工作的张先生说，“我已经使用XP系统很多年了，用不惯其他系统，微软只是对XP系统停止服务，但系统还是可以使用的，当年的Windows 2000停止服务后也用了不少年呢。”&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r张先生的想法比较具有代表性，但也有用户是因为电脑配置较低，无法更换系统。在重庆某民营企业工作的高志华告诉记者，自己的电脑年代久远，无法运行更高级的操作系统，除非更换电脑，这是一笔不小的开销，只能先用着ＸＰ系统，以后再做打算。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r同时，得知“XP系统将停止服务”的消息后，用户们普遍对电脑使用的安全问题表示担忧。多名受访用户担忧：“多装几个杀毒软件，及时更新、定时杀毒会不会降低安全风险？网上热传的‘未升级电脑可能会在10分钟内被病毒感染’的说法是不是真的？”&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('4', '4', '位于亚热带的厦门连日来遭遇了这个冬天的最冷天气，厦华电子公司许多员工尤其是老员工，他们的心情也与这个阴冷的天气一样。在厦门已走过30年历程的厦华电子公司即将停产，员工们也要结束自己的厦华工作生涯了。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r据了解，根据厦华资产重组的一揽子方案，公司要在2014年6月30日前，完成资产、负债、人员的清理工作。作为以液晶电视、等离子电视、数字高清晰度电视为主的彩电制造商，厦华可以说曾经是“彩电”的代名词。根据厦华电子之前发布的股权转让公告，厦华今后不再生产电视，或将转型医疗设备相关行业。至于厦华新的接手方是否继续使用厦华这个品牌，目前无法下定论。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r也许一个“换频”，曾经的彩色厦华就要成为黑白的厦华了。在这一历史性时刻，让我们走近厦华这一厦门老品牌。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('5', '4', '如果按照今天的标准来看，在2005年市面上还没有智能手机，而运营商不仅能够决定手机中的应用程序，甚至还能够控制使用手机进行搜索时的搜索结果。与此同时，市面上的手机运行的操作系统几乎都不一样，适用于诺基亚手机的应用程序通常是无法安装到三星或者是摩托罗拉的手机中的。而应用程序的不兼容性也使开发者对手机平台敬而远之，不过还是有一部分的开发者致力于为不同手机开发应用程序，一款应用程序通常需要为不同的手机写一百多个版本，工作量可谓非常之大。&lt;br /&gt;\r&lt;br /&gt;\r而这一切正在慢慢地发生改变。工程师Andy Rubin在一个数码相机系统的基础上开始了创建一个适用于智能手机的操作系统的工作，这便就是Android的前身。Andy Rubin此前是一名供职于著名光学设备制造商卡尔蔡司的机器人工程师，随后投身于手持设备操作系统的研究工作。凭借着丰富的经验，Andy Rubin也得到了另外一些工程师的支持，这也是他为什么能在2003年正式推出Android计划的原因。不过由于缺乏大公司的支持，仅仅经过了一年的研究之后，Android计划在资金和人手方面都出现了严重短缺。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r于是，Andy Rubin打算将Android计划挂牌出售以此来换取研究经费，而大多数人恐怕都不知道的是第一个有机会买下Android的公司并不是谷歌而是三星。在被谷歌买下之前，Android团队的一行八人曾飞赴韩国首尔，与当时最大的手机制造商三星进行洽谈。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('6', '4', '微软的Amanda Lefebvre表示：“用户们说，把Apps包含在名称中会令人感觉困惑。”先前Office Web Apps这个名称让很多用户误以为是需要安装的应用，而不是线上Office概念。新品牌的定义实际上并没有为这款产品加入什么新特性，只不过是要让用户了解，这是微软Office软件的线上版本。&lt;br /&gt;\r&lt;br /&gt;\r很多用户其实根本不知道微软有web版Word、Excel和PowerPoint，这跟他们本身也不熟悉SkyDrive（现在叫OneDrive）当然也有关系。微软始终在努力与谷歌的Google Drive云服务作斗争。于是Office.com这个网站首页也优先放上web版Office选择，首页以磁贴形式展示都有哪些可用的服务和线上应用。首页提供的服务选择实际还包括了Outlook.com和OneDrive等，可让用户方便切换于微软云服务间。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r编辑评论：微软还在推行Word、PowerPoint和Excel Online的模板系统，用户可更为方便地从数百可用模板中挑选想要的。今天微软对Office Online所做的改进其实非常之小，但对微软的web版Office而言确实有着不小的意义。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('7', '4', '在这样多元化的时代中，处于变化与创新顶端的并不是苹果、三星等国际品牌，而是联想。从超极本时代的多模变形的YOGA超极本，到去年年底的变形YOGA平板，再到二合一平板Miix 2，都走在时代的前沿。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r二合一的平板笔记本让传统的笔记本在体积和重量上大幅下降，而功能性方面丝毫没有缩减。联想最初发布的Miix 2 8因其小巧却功能齐全广受用户青睐，但其8英寸的小屏幕确实让一部分用户无法适应，因而在年初的CES消费电子展上，联想再次推出Miix 2 10，引发了更多用户的购买欲望。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r在配置方面Miix 2 10分为64GB和128GB版，都配备了Intel Bay Trail Z3470处理器，eMMC规格的存储器，全高清级别的全高清IPS显示面板，在接口方面新增了到了三个USB接口（一个Micro USB接口和两个常规USB接口），增加了JBL认证的扬声器。遗憾的是，内存方面依然为双通道2GB，在性能和操作体验上依然是一个瓶颈。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r拥有一台就够了 全模式Miix 2 10评测&lt;br /&gt;\r&lt;br /&gt;\rMiix 2 10采用了与Miix 2 8完全不同的外观设计，机身采用了楔形的设计，在搭配键盘底座之后，机身前方略收 ，而且屏幕的前边缘会多出底座一部分，联想巧妙的使用了弧线设计，让用户在视觉上会有很轻薄的感觉。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('8', '4', '雷神品牌产品上市一个多月的时间里，迅速吸引了大批用户的关注。被神舟战神洗礼了一年多的高性价比游戏本市场，随着雷神的出现，也拥有了更多的选择空间。虽然雷神也是由蓝天提供模具而推出的产品，但是在一些细节方面却与战神有着比较明显的不同之处。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r年前我们在雷神新品上市之前推出了一款P370SM雷神笔记本电脑的评测，因为这款机器配置了非常优秀的硬件，所以也吸引了很多用户的关注，而我们在雷神的首发产品中，也并没有看到这款产品的出现。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r不过，这并不妨碍我们对这款产品做进一步的了解。毕竟在电脑厂商眼里，有些产品是推出来卖的，而有些产品则是为了塑造品牌才诞生的，P370SM或许就是这样的产品吧，因为它代表了雷神所能达到的“最佳状态”。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('9', '4', '年复一年，索尼旗舰级电视产品总能成为全球发烧级用户的讨论焦点，无论是工业设计、画质表现还是实际体验，索尼旗舰级电视无疑都是业界的标杆，索尼产品工业设计的天赋无需多说，业内最强的画质表现才是人们讨论的核心所在。2014年，索尼旗舰级电视已经闪亮登场，我们一起来初步体验这款顶级产品的极致魅力，看看它是否有足够的实力引起您的重视。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r索尼2014年度旗舰电视产品为XBR-85X950B（海外部分地区型号为KD-85X9505），是一款85英寸超高清UHD电视（分辨率为3840×2160）产品，也许有读者认为85英寸和主流用户没太大的区别，实际上还是有关系的，因为该系列还有65英寸版本，具体型号为XBR-65X950B，这个版本无论是规格还是屏幕尺寸都与时下高端电视机市场十分吻合，极具诱惑力。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('10', '4', '去年五月上任的Intel新总裁Brian Krzanich，在周三参加了着名网站Reddit的“随便问吧（Ask Me Anything）”问答活动。热情的网友们问了他许多问题。其中就有人问到，Intel和苹果公司现在的关系怎么样；Mac电脑使用Intel的处理器也有差不多十年了，两家公司关系有没有发生什么变化。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rBrian Krzanich回答：“毫无疑问，自从苹果公司开始使用我们的技术以来，我们一直和苹果公司保持非常密切的关系。双方日后还会进一步深入合作。”&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rBrian Krzanich说，Intel一直都会和任何客户建立紧密关系。在他上任以前，Intel前总裁Paul Otellini就建议道，最终顾客的成功，也就是Intel的成功。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r苹果公司和Intel关系并不是一帆风顺的。Paul Otellini去年卸任的时候，回忆当初Intel是有机会向初代iPhone提供处理器的，但是他个人反对。结果苹果公司转向三星，Intel错失巨额订单。现在业界风向已经变化，预计苹果公司为了摆脱三星，会和Intel重修旧好让Intel代工iPhone和iPad的处理器。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('11', '4', '2月20日消息，据台湾媒体Digitimes研究，由于三星显示器不断将生产重点从笔记本电脑面板转移到AMOLED面板，这将增加台湾面板厂如友达在2014年的笔记本电脑面板订单。&lt;br /&gt;\r&lt;br /&gt;\r大多数面板制造商，包括大陆厂商，主要集中在中小尺寸面板生产，用于智能手机和平板电脑。基于这种趋势，市场观察家认为，2014年笔记本电脑面板的短缺可能高达2000万块，将为市场上其他面板制造商带来新业务机会。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r因此，Digitimes研究预计，友达将成为这些发展厂商的先驱之一，很可能是LG Display最大的竞争对手。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('12', '4', '随着IMAX影院在全国的迅猛发展，IMAX集团正在试图让更多中国电影IMAX化。IMAX首席执行官(CEO)理查德·格尔福特 (Richard Gelfond)日前在接受采访时表示，目前正在推动中国导演直接用IMAX机器拍摄电影，“已经有一些导演表示出了这样的意向，预计今明两年将出现用IMAX机器直接拍摄的中国IMAX电影。”&lt;br /&gt;\r&lt;p&gt;\r	&lt;br /&gt;\r&lt;/p&gt;\r&lt;p&gt;\r	&lt;br /&gt;\r&lt;/p&gt;\r创始于加拿大、在美国上市的IMAX公司市值近20亿美元，主做IMAX电影和影院。理查德·格尔福特说到。传统来说，IMAX电影以好莱坞制作居多，由于中国市场越来越重要，除了向中国引进更多IMAX版的好莱坞电影外，推广中国本土电影IMAX化是公司这一阶段最核心的方向。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r“既放映美国IMAX大片，也要放映更多的中国制作的IMAX大片。”格尔福特表示。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r格尔福特称，一方面将鼓励更多的制片方将适合的中国作品直接进行IMAX转制，即将普通胶片或数码摄影机拍摄的影片，经过电脑处理提升质量和色彩，转为可供大屏幕播放的IMAX影片。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r目前大部分好莱坞影片公司选择IMAX转制模式，如《阿凡达》、《环太平洋》、《地心引力》等。国内IMAX荧幕上中国电影的身影也开始越来越多。2011年底，徐克拍摄的《龙门飞甲》、冯小刚的《唐山大地震》，乃至《建党伟业》均有IMAX版，且票房表现不俗。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r另一种就是上述提到的直接用IMAX摄像机拍摄电影，目前后者在中国还未有先例。尽管格尔福特对在中国推广直接用IMAX摄像机拍电影的前景表示乐观，但租用IMAX专用摄像机拍摄会为单部影片增加几百万美元的成本，目前只有包括《变形金刚》等为数不多的影片直接使用过其摄像机。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r除了电影转制、拍摄外，IMAX大部分收入来自于影院。格尔福特看好中国市场，称2013年中国市场的电影票房收入总体增长超过30%，是电影业无可争议的高增长市场。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r格尔福特还告诉21世纪经济报道记者，IMAX公司在华已有130个影院，不及美国IMAX影院数量的一半，但目前中国签约在建的影院高达300个，占全球在建影院的一半，届时中国将超越美国成为IMAX影院最多的国家。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rIMAX公司最大的院线合作伙伴是万达集团。2012年万达作价26亿美元收购美国排名第二的院线公司AMC之前，AMC和万达院线公司分列IMAX全球第一和第三大客户。两者合并之后，自然成为这家科技电影公司最重要的客户，贡献了其超过12%的收入。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('13', '3', '在极路由、小米、360、百度、华为等厂商纷纷进军智能路由器之后，迅雷也终于忍不住了，在今年初宣布进军智能路由器市场。而迅雷内部人士则表示迅雷路由将定位高性能，硬件配置十分发烧，不输小米路由器。而且迅雷在下载方面还拥有得天独厚的优势，将为用户打造下载神器。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r迅雷方面在今天传出消息称迅雷路由器“水晶版”内测预约即将开放，与此同时它的配置、功能以及相关价格也被曝光了出来。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r迅雷将自家的路由器定义为“高性能路由器+高清下载机+高速网络移动硬盘”，但第一代产品并不会内置硬盘，而是提供一个USB 3.0接口来外接移动硬盘使用，用户可通过迅雷路由器向外接硬盘下载视频，另外还能够将本地数据保存至外接的移动硬盘中。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r软件方面，迅雷表示将会不断的为这款路由器增加新的功能，而且是自动升级。每周或者每个月都会有新版本的固件供用户升级。另外用户还能通过手机或者PC远程控制迅雷路由器发起下载，同时可以通过本地网络来共享下载的视频。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r具体配置方面，迅雷路由器将采用来自博通的芯片，理论上应该也是小米路由采用BCM470x系列，支持802.11ac规范以及2.4GHz/5GHz双频Wi-Fi，总带宽为1.2Gbps。同时迅雷路由还会提供千兆有线网络接口，这对内网PC用户来说确实十分给力。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r关于价格，迅雷路由负责人段晖表示其售价绝对不会超过350元，但究竟是多少还要等待公测结束之后再行公布。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('14', '3', '网易数码2月19日消息，随着智能手机、平板电脑和可穿戴设备的蓬勃发展，关于“PC将死”的说法又开始甚嚣尘上，那么PC真的已经走到创新乏力、穷途末路的地步了么？答案当然是否定的。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r在许多科技媒体看来，PC的死期已经不远，但客观地说，相对于年轻人无比喜欢的智能手机、平板电脑、可穿戴设备、4K显示器和游戏主机来说，PC仍然在目前的科技创新大潮中扮演“领导者”的角色，而所谓的“PC将死”也不过是杞人忧天罢了。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r下面我们就一起来对“PC替代品”的创新能力来进行一下大致的分析，看看它们究竟是不是PC的对手。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('15', '3', '继三星将S Health健康管理服务集成到所有Galaxy系列旗舰机型之后，苹果和微软也开始有了新动作。前者将在iOS 8中内置Healthbook和Watch Utility两款软件，除了可以通过手机内置传感器监测健康状态之外，还可以使用智能手表中搭载的感应器判断不同时间的运动消耗。与前者的“快马加鞭”不同，微软则只在Windows Phone应用商店上架了Bing Health的Beta版本，同样可以帮你制定健康计划，分析食物热量。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r在此之前，例如Jawbone Up、Fitbit Force等国内外初创公司都把目光瞄准了“软硬结合”的方向——即通过硬件识别记录，软件同步显示的方式来达到监测的目的。而在iOS和Android平台上也涌现出了不少可以摆脱硬件佩戴束缚的第三方软件，只需要通过手机中的感应器、GPS定位以及算法便可实现监测效果。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r为了区别两种监测方式在生活场景中的不同之处，我选择同时使用Jawbone Up2与乐动力进行了体验对比。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('16', '3', 'T400，这个型号在电脑产品中经常见到，其中最有名的就要属ThinkPad T400了。不过，在海尔笔记本电脑产品线上，也有型号为T400的产品，而且它的定位与ThinkPad完全不同。面向家庭用户的海尔T400除了具备不错的综合性能之外，最大的特点就是采用了纤薄化的设计，虽然不如超极本产品那么纤薄，但是在普通笔记本电脑中，它的纤薄化设计有目共睹。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r我们在去年11月份的时候对海尔T400的一款产品进行了评测，而今天这款产品与之前产品相比，除了在处理器方面有所提升之外，其它方面均无明显变化，只是在一些细节方面的配色上有所不同，因此我们今天的评测主要是针对处理器性能进行的，而关于外观设计以及细节部分，我们则直接引用了之前的评测内容，就不再多加赘述了。&lt;br /&gt;\r&lt;br /&gt;\r海尔T400的整体外观设计比较简约，顶盖部分采用了黑色金属拉丝工艺面板，C面则采用了银色配色，整体的金属质感比较鲜明，虽然设计上并没有什么亮点，但能看出这是一款追求实用性的产品。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r此外，海尔T400在处理器的选择上采用了低电压版本，因此整体的功耗相对较低，续航时间也有所保障，而配备的GT 745M独显可以说是移动级独显中的中端显卡，应对一般的网络游戏毫无压力，再加上其较轻的重量，因此这款产品很适合出差时游戏娱乐使用。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r接下来，我们就从处理器性能入手，跟大家一起来聊聊这款海尔T400究竟有哪些特别之处吧。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('17', '3', '英特尔作为全球最大的芯片制造商，它的动向往往影响着整个产业的发展。那么2014年英特尔的重点会是什么呢？近日VR-Zone公布了一张英特尔2014年芯片方面的规划图，下面就让笔者带大家来看一看。&lt;br /&gt;\r&lt;br /&gt;\r2014年，英特尔首先将会在服务器领域有所动作。至强Xeon E7-8800/4800/2800 v2 以及 至强Xeon E5-4600 v2系列处理器将会到来。前者为Ivy Bridge-EX，拥有最多15核心，而后者则属于Ivy Bridge-EP 4S。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r英特尔2014规划图曝光 移动市场依旧是重点&lt;br /&gt;\rXeon&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r根据之前的资料显示，Xeon E7 v2应该会继续划分为E7-8800 v2、E7-4800 v2、E7-2800 v2等三个子系列，分别面向多路、四路、双路系统，主打服务器集群和数据中心。E7 v2系列最多有15个核心，缓存容量为37.5MB，并支持HT超线程，总线程数为30个。此外，它还支持VT-x、VT-d以及VT-c虚拟化技术，支持Turbo Boost 2.0加速、TET信任执行技术(Trusted Execution technology)，还有Intel的Secure Key安全密钥及OS Guard系统守卫等安全技术。E7 V2将有95W、105W、130W、155W几个版本，包含6核、10核、12核、15核等型号。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r支持E7 v2的芯片组是C602J，每个插槽支持四条C102/C104可扩展内存缓冲器，每个缓冲器支持3条DDR3-1600内存，因此每个处理器最大支持的内存可达24条。此外，Xeon E7 v2支持3路QPI总线，并有32条PCI-E 3.0通道。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r此外，同月在MWC 2014上，英特尔还会为我们带来Android平板所使用的64位Bay Trail-T，以及智能手机所用的Merrifield系列处理器，当然，两者采用的均为Silvermont架构。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('18', '3', '最近我使用了一款Picooc的智能秤，之所以称为智能秤，是因为通过它不只能得到自己的体重数据，还能了解自己的BMI（即身体质量指数）以及多项身体指标，根据你的身体数据系统会有针对性地给出运动和饮食建议。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r正如智能手环一样，我相信长时间使用后，其数据的累积和变化会对人的身体健康状况产生巨大的价值。但在使用过程中，我也遇到了困惑，最典型的便是我需要每天都站在秤上测试，这看似不应该是个问题，但是对于一款应该为生活带来便利的智能设备来说，它却给我带来了不便——我每天需要想着测试，需要站在上面一会儿，如果中途我一段时间出差了或者由于忙乱忘了测试，那么我就获取不到信息了。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r为什么本来应该为我的生活带来便利的智能设备，却需要花费我不少精力，以至于给我带来了一些不便呢？这真是一个悖论。科技的使命是解放人类，而非奴役人类，可现在我们却越来越被科技所奴役，智能手机让我们一刻不离屏幕，可穿戴智能设备让我们越来越“臃肿”，云服务让我们越来越没有隐私。可是科技就真的不能让人越来越轻松吗？&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r就可穿戴智能设备来说，它已经越来越成为我们的负担了。拥有钢铁侠那样的装备当然让人向往，可你并不真的想穿着它上班、吃饭、约会甚至睡觉吧？可现在的可穿戴智能设备却恨不得我们这样，比如智能手环。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r在我看来，可穿戴智能设备是人类美好向往的结果，但它不应该成为人类的负担，因此现在的形态绝不是它的最终形态，可穿戴智能设备的发展应该是从无到无限多再到无限少的过程。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r第一阶段：无&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r对于可穿戴设备的创造其实源于人类的本能和美好向往，数百万年的进化并没有将人类塑造成一个完美的物种，他们视力有限，听力有限，智力同样有限，他们无法完整地了解过去，也无法准确地预测未来。在古老的人类眼中，完美的人类应该像天上的神那样有千里眼、顺风耳，手脚可以无限变长变短（十八罗汉），并且应该像玉帝那样无所不知，掌握着人类的过去和未来。这些能力正像可穿戴智能设备一样是有限的人类组织和器官的延伸。这一点在西方表现为上帝和他的圣经体系。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r在民间，人类对于此的向往在东西方分别表现为民间高人用看手相和看水晶球的方式预测人类的未来。当你来到一个卜卦者面前，他会根据你的手相预测你的未来运势，它包括你的身体状况、职业状况和婚姻状况等等。这一点正是可穿戴智能设备的核心价值——通过数据预测一个人未来状况（现在主要表现为身体状况）的表现。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('19', '3', '记者在淘宝网高级搜索中发现，全网符合全新商品检索条件的商品为34247万件，而加入七天退换保障条件的宝贝仅有12281.24万件。不少店铺仍在首页挂出类似“尺码色差等不属于质量问题不予退换”的免责声明，看似温馨提示，实为霸王条款，强制限定商品退换条件，公然损害消费者合法权益。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r某淘宝卖家就在店内声明：“本店非七天无理由退货店铺，非质量问题不退换，请觉得‘不是自己想要的感觉’或者‘费尽心思绞尽脑汁使劲想找点理由退货’以及‘只是想买来试试衣服，不是很喜欢就想退’的挑剔姑娘请绕道。”这类商铺将买家“后悔权”强制剥夺，与新规要求大相径庭。(据新华社电)&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r新修订的《消费者权益保护法》将于3月15日正式施行。国家工商行政管理总局日前公布了《网络交易管理办法》(以下简称《办法》)，对消费者的网购“后悔权”在部门规章层面给予保障。对不少热衷网购的消费者来说，“7天无理由退货”的规定让网购少了后顾之忧。但同时，对于哪些商品适用7天无理由退货，需要满足什么条件，无理由退货能否执行，消费者还有不少疑问。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r判定商品“完好”的标准是什么？&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r《办法》第十六条规定，网络商品经营者销售商品，消费者有权自收到商品之日起七日内退货，且无需说明理由，但有四种商品除外：消费者定做的，鲜活易腐的，在线下载或者消费者拆封的音像制品、计算机软件等数字化商品，以及交付的报纸、期刊。除了这四类商品之外，其他根据商品性质并经消费者在购买时确认不宜退货的商品，不适用无理由退货。消费者退货的商品应当完好。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r“完好”的标准是什么呢？商品的包装损坏了，衣服的吊牌剪掉了，这样的商品能不能无理由退货？&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r中国人民大学法学院教授杨立新认为，“消费者退货的商品应当完好”就是说，符合无理由退货条件情况下，消费者应当保持退货商品本身完好无损。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r“商品完好的标准应以是否影响二次销售为依据。”阿里巴巴集团法务副总裁俞思瑛说，在实际销售过程中，退换货都是商家与消费者自由决定的。“退换货本身就是经营者和消费者之间的自愿行为，他们对货品本身的认定，通常情况下纠纷很少。”&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r有专家表示，法规实施的一个障碍就是货退回去后什么情况下不影响二次销售，如试穿过的衣服有香水残留怎么办？怎么界定不影响二次销售，仍需在实践中细化。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r中国消费者协会法律与理论研究部主任陈剑认为，“在实践中，部分商家提出要求包装完好。这和商品完好是两个概念，商品本身是完好的，商品附带的附件也是齐全的，这些应该是它的要件所在，至于包装是不是拆封了，不应该包含在其中。因此，拆包装不能叫‘商品不完好’，也是符合7天无理由退货条件的。”&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r另外，商品完好还涉及哪个环节完好。比如，商品在消费者手里完好，但在退货过程中由于快递或者物流的原因，商品出现了损毁，应该由谁来负责？全国人大常委会法工委民法室主任贾东明认为，如果商品是在物流运输过程中出现损毁，则应该由物流承担责任，7天无理由退货所强调的商品完好，应是指商品在消费者这一环节保持完好。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('20', '3', '网易科技讯 2月21日消息，正是由于一年多以前开始的复兴计划，AMD并没有随着PC市场的下滑而进入困境，相反，AMD通过嵌入式、游戏主机、数据中心等领域的业务发展反哺PC，再次通过Kaveri APU走回PC市场。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rAMD高级副总裁兼全球事业部总经理Lisa Su正是这一场复兴的的重要推手。2012年1月加入AMD之前，Lisa Su曾在飞思卡尔担任高级副总裁兼网络与多媒体部总经理。之后，在AMD，她主要推动AMD产品端到端业务执行，包括战略制定、产品定义以及业务规划等工作。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rLisa Su日前在到访北京时对外表示，AMD有非常强的基础性知识产权（IP），而这个优势可以被应用到PC、游戏主机、嵌入式应用、服务器等领域。这个观点本身才是AMD业务走向多元市场的真相。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r2014年，AMD的重要产品Kaveri APU发布。这款产品相对上一代在性能、计算能力和图形等领域都有大幅改进。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rLisa Su表示，Kaveri的需求非常强劲，桌面Kaveri正在通过渠道市场进行销售，在中国AMD非常重视DIY市场，随后还将推出笔记本这个领域的应用。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\rLisa Su强调，游戏是我们在显卡和图形这个领域非常重要的市场，也是我们重要的差异化的领域。在这个领域，我们推出了一项名为Mantle的技术创新，由此我们可以从游戏主机一直到笔记本和PC的游戏都实现非常好的性能，而且能够使软件的开发得到更大的助力。而且我们跟很多的软件开发商的合作伙伴都进行深入密切的合作，他们也对这个技术和产品表示了强烈的兴趣，我们列出了非常领先的新的游戏的产品，但事实上现在有20多个游戏产品都在使用我们这个新的技术。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;\r从Lisa Su展示的PPT中我们可以看出，Mantle版的植物大战僵尸：花园战争3D版正在开发中。&lt;br /&gt;\r&lt;br /&gt;\r&lt;br /&gt;');
INSERT INTO `ky_content_news` VALUES ('21', '3', '&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;line-height:1.5;font-size:18px;&quot;&gt;XiaoCMS X1 企业建站版 正式发布&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;line-height:1.5;font-size:18px;&quot;&gt;免费 简单易用 程序小巧&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;font-size:18px;&quot;&gt;官方网站：http://www.xiaocms.com&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;font-size:18px;&quot;&gt;如果您有任何问题或者建议欢迎联系我们&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;font-size:18px;&quot;&gt;同时我们推出有x2 和x3产品系列&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;font-size:18px;&quot;&gt;x1 企业建站版 （针对企业建站 小型内容的网站，比如博客 等要求较小的小型网站）&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;font-size:18px;&quot;&gt;x2 站群seo版本 （针对垃圾站的站群程序，内容自动生成等各种特性）&lt;/span&gt; \r&lt;/p&gt;\r&lt;p style=&quot;text-align:left;&quot;&gt;\r	&lt;span style=&quot;font-size:18px;&quot;&gt;x3 （高端大气上档次的内容管理系统，适合大中型的网站）&lt;/span&gt; \r&lt;/p&gt;');
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
INSERT INTO `ky_content_product` VALUES ('26', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('27', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('28', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('29', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('30', '7', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('31', '7', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('32', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('33', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('34', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('35', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('36', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');
INSERT INTO `ky_content_product` VALUES ('37', '6', '&lt;div style=&quot;text-align:center;&quot;&gt;\r	&lt;img src=&quot;http://demo.xiaocms.com/template/default/images/bigmacbook.jpg&quot; alt=&quot;&quot; /&gt;&lt;span style=&quot;line-height:1.5;&quot;&gt;&lt;/span&gt;\r&lt;/div&gt;');

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
