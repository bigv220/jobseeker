/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50132
Source Host           : localhost:3306
Source Database       : etonn_jingjobs

Target Server Type    : MYSQL
Target Server Version : 50132
File Encoding         : 65001

Date: 2013-08-28 14:08:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admin`
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` int(8) NOT NULL AUTO_INCREMENT,
  `group_id` int(4) DEFAULT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `lastlogon` int(10) DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', null, 'admin', '7fef6171469e80d32c0559f88b377245', 'admin@admin.com', '1377669499', '1', 'Aret', 'Sevan', 'active');
INSERT INTO `admin` VALUES ('2', null, 'administrator', '7d0775da8d9e5afe42ece23f3db13151', 'admin@test.com', '1323228082', '1', 'administrator', 'sino', 'active');
INSERT INTO `admin` VALUES ('213', null, 'gaofang', 'c0fc0ca0bb8755c2b3ff49e67162527a', 'sales@qdkidmart.com', '0', '1', '高方', '男', 'active');

-- ----------------------------
-- Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `aid` int(8) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `cid` int(4) DEFAULT NULL COMMENT 'category',
  `uid` int(8) DEFAULT NULL,
  `order` int(8) DEFAULT '0',
  `lang` varchar(2) DEFAULT NULL,
  `url` varchar(64) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `descrip` varchar(255) DEFAULT NULL,
  `content` text,
  `date` int(10) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('1', 'page', '0', '1', '0', 'en', 'company-profile-index', 'COMPANY PROFILE(index)', 'test', 'QINGDAO KIDMART INTERNATIONAL TRADING CO.LTD is located in the Qingdao,Shandong, which is a beautiful seaside city in the eastern of China, our main product line is plastic toddler furniture&nbsp;<img src=\"/etonn/qdkidmart/attached/image/20120325/20120325143508_55417.png\" style=\"margin:5px 10px 0px 0px;\" alt=\"\" align=\"left\" width=\"117\" height=\"135\" />which include plastic bed, plastic table, plastic chair etc., we also could supply the others plastic products such as plastic cup, plastic bottle, plastic plate and so on. Over the past years, rely on the excellent product quality and the integrity service tenet, our products have sold to several regions including America, Europe and Southeast Asia etc., and have got very good reputation.<br />\nWe have the full capability to produce the different kinds of plastic products, we also could produce the customized products according to the customer requirement.&nbsp;<br />\n\"Quality first, partners satisfactory\" is our constantly pursuing goal, we will continue to provide our customers and partners with best quality products and services.<br />\n<br />\n<br />', '1335430022');
INSERT INTO `article` VALUES ('171', 'page', null, null, '0', 'en', 'company-profile', 'COMPANY PROFILE', null, '<span style=\"font-family:Arial;\">QINGDAO KIDMART INTERNATIONAL TRADING CO.LTD is located in the Qingdao, Shandong, which is a beautiful seaside city in the eastern of China, </span><span style=\"font-family:Arial;font-size:9pt;\"><span style=\"font-family:Arial;\">our main product line is plastic toddler furniture which include plastic bed, plastic table, plastic chair etc., we also could supply the others plastic products such as plastic cup, plastic bottle, plastic plate and so on. Over the past years, rely on the excellent product quality and the integrity service tenet, our products have sold to several regions including America, Europe and Southeast Asia etc.and have got very good reputation. </span><br />\n<br />\n</span><span style=\"font-family:Arial;font-size:9pt;\"><span style=\"font-family:Arial;\">We have the full capability to produce the different kinds of plastic products, we also could produce the customized products according to the customer requirement.</span><br />\n</span><br />\n<span style=\"font-family:Arial;\"> \"Quality first, partners satisfactory\" is our constantly pursuing goal, we will continue to provide our customers and partners with best quality products and services.</span><br />\n<img style=\"margin:5px 10px 0px 0px;\" alt=\"\" align=\"left\" src=\"/etonn/qdkidmart/attached/image/20120325/20120325143508_55417.png\" width=\"117\" height=\"135\" />', '1335428415');
INSERT INTO `article` VALUES ('161', 'news', '106', null, '0', 'cn', null, '新闻1', null, '新闻1新闻1<br />\r\n新闻1新闻1<br />\r\n新闻1新闻1<br />', '1329408000');
INSERT INTO `article` VALUES ('162', 'news', '106', null, '0', 'cn', null, '新闻2', null, '新闻2<br />\r\n新闻2<br />\r\n新闻2<br />', '1329408000');
INSERT INTO `article` VALUES ('163', 'news', '106', null, '0', 'cn', null, '新闻3', null, '新闻3<br />\r\n新闻3<br />\r\n新闻3<br />', '1329408000');
INSERT INTO `article` VALUES ('164', 'news', '106', null, '0', 'cn', null, '新闻4', null, '新闻4<br />\r\n新闻4<br />\r\n新闻4<br />', '1329408000');
INSERT INTO `article` VALUES ('165', 'news', '106', null, '0', 'cn', null, '新闻5', null, '新闻5<br />\r\n新闻5<br />\r\n新闻5<br />', '1329408000');
INSERT INTO `article` VALUES ('166', 'news', '106', null, '0', 'en', null, 'News1', null, 'News1<br />\r\nNews1<br />\r\nNews1<br />', '1329408000');
INSERT INTO `article` VALUES ('167', 'news', '106', null, '0', 'en', null, 'News2', null, 'News2', '1329408000');
INSERT INTO `article` VALUES ('168', 'news', '106', null, '0', 'en', null, 'News3', null, 'News3', '1329408000');
INSERT INTO `article` VALUES ('169', 'news', '106', null, '0', 'en', null, 'News4', null, 'News4', '1329408000');
INSERT INTO `article` VALUES ('170', 'news', '106', null, '0', 'en', null, 'News5', null, 'News5', '1329408000');
INSERT INTO `article` VALUES ('30', 'page', '0', null, '0', 'en', 'production-base-index', 'PRODUCTION BASE(index)', null, 'The production base is also located in Qingdao.&nbsp;<br />\nThe total area is 50,000 square meters and the plant area is 35,000 square meters. We have more than 300 employees, including more than 30 managements and more than 20 technicians.&nbsp;The production equipments include blow molding machines,&nbsp;the injection&nbsp;molding machines,&nbsp;<img src=\"/etonn/qdkidmart/attached/image/20120325/20120325144700_48295.png\" align=\"left\" alt=\"\" style=\"border-style:initial;border-color:initial;margin-top:5px;margin-right:10px;margin-bottom:0px;margin-left:0px;\" />the blister machines, the rivet machines, the punching machines, the semi-automatic sewing machines and so on. We have the enough capability to produce the customized products.<br />\n<div>\n	<span class=\"Apple-style-span\" style=\"white-space:normal;\"><br />\n</span>\n</div>', '1332658461');
INSERT INTO `article` VALUES ('42', 'page', '0', null, '0', 'cn', 'production-base-index', '生产基地(首页)', null, '生产基地也位于青岛，占地总面积50000平方米，厂房面积35000平方米，现有员工300余名，其中管理人员30余名，专业技术人员20余名。生产设备包含有中空吹塑机，注塑机，吸塑机，铆钉机，冲床，半自动缝纫机等，可以承接各种规格的客户定制产品。<br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120325/20120325144700_48295.png\" width=\"123\" height=\"94\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<div style=\"white-space:nowrap;\">\n	<span class=\"Apple-style-span\" style=\"white-space:normal;\"></span> \n</div>', '1332659288');
INSERT INTO `article` VALUES ('175', 'page', null, null, '0', 'cn', 'production-base', '生产基地', null, '生产基地也位于青岛，占地总面积50000平方米，厂房面积35000平方米，现有员工300余名，其中管理人员30余名，专业技术人员20余名。生产设备包含有中空吹塑机，注塑机，吸塑机，铆钉机，冲床，半自动缝纫机等，可以承接各种规格的客户定制产品。<br />\n<div style=\"white-space:nowrap;\">\n	<br />\n工厂<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105251_51097.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105303_53354.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n吹塑<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105335_17599.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n缝纫<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105350_18011.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105407_13457.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n吸塑<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105430_97750.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105451_27278.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n注塑<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105509_94992.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105529_13359.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105538_56485.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n铆钉冲压<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105602_45419.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105621_99906.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105628_24447.jpg\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />\n<br />\n<br />\n</div>', '1332898444');
INSERT INTO `article` VALUES ('43', 'page', '0', null, '0', 'cn', 'contact', '联系我们', null, '<p>\n	<span>Address：<br />\nRoom 2603, Xingang Building, No.8 Yancheng Road, Qingdao, China 266071<br />\n<br />\nTel: 86 532 83880131&nbsp;&nbsp;&nbsp;<br />\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;86 18678911895<br />\n<br />\nEmail: sales@qdkidmart.com<br />\n<br />\nHttp: www.qdkidmart.com</span> \n</p>\n<br />', '1335231899');
INSERT INTO `article` VALUES ('176', 'page', null, null, '0', 'cn', 'quality', '产品品质', null, '我们已经通过了ISO9001:2008认证，同时获得了许多客户的审查认可，每年近百万台的出口量就是对于我们产品品质的最大认可。<br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110000_35504.jpg\" width=\"330\" height=\"232\" alt=\"\" />&nbsp;&nbsp;<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110008_23502.jpg\" width=\"330\" height=\"232\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110017_54170.jpg\" width=\"330\" height=\"460\" alt=\"\" />&nbsp;&nbsp;<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110026_42783.jpg\" width=\"330\" height=\"469\" alt=\"\" /><br />\n<br />\n<br />', '1332925896');
INSERT INTO `article` VALUES ('159', 'page', null, null, '0', 'en', 'quality', 'QUALITY', null, 'We have passed the ISO9001:2008 and also got the strict audit approval from major customers, around million of export quantity annually is showing the good quality of our products.<br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110000_35504.jpg\" width=\"330\" height=\"232\" alt=\"\" />&nbsp;&nbsp;<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110008_23502.jpg\" width=\"330\" height=\"232\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110017_54170.jpg\" width=\"330\" height=\"460\" alt=\"\" />&nbsp;&nbsp;<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323110026_42783.jpg\" width=\"330\" height=\"469\" alt=\"\" /><br />\n<br />\n<br />', '1332925844');
INSERT INTO `article` VALUES ('173', 'page', null, null, '0', 'en', 'contact', 'Contact Us', null, 'Address：<br />\nRoom 2603, Xingang Building, No.8 Yancheng Road, Qingdao, China 266071<br />\n<br />\nTel: 86 532&nbsp;83880131&nbsp;&nbsp;&nbsp;<br />\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 86 18678911895<br />\n<br />\nEmail: sales@qdkidmart.com<br />\n<br />\nHttp: www.qdkidmart.com<br />\n<br />', '1335231855');
INSERT INTO `article` VALUES ('160', 'page', null, null, '0', 'cn', 'company-profile', '公司简介', null, '青岛凯德玛国际贸易有限公司坐落于美丽的海滨城市山东青岛，公司主营塑料儿童制品的出口。多年来，凭借优良的产品质量和诚信为本的服务宗旨，产品远销欧美、东南亚等区域，受到海外客户的一致认可，目前我们生产的产品在欧美主流的儿童用品销售渠道如TOYSRUS, WALMART, SEARS, TARGET, KMART等均有销售。<br />\n<br />\n“质量第一、合作伙伴满意”是我们不断追求的目标，我们将一如既往的提供给我们的合作伙伴和客户最真诚的服务和最可靠的产品。&nbsp;<br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120325/20120325143508_55417.png\" alt=\"\" style=\"border-style:initial;border-color:initial;\" /><br />', '1332659270');
INSERT INTO `article` VALUES ('172', 'page', null, null, '0', 'en', 'production-base', 'PRODUCTION BASE', null, 'The production base is also located in Qingdao. The total area is 50,000 square meters and the plant area is 35,000 square meters. We have more than 300 employees, including more than 30 managements and more than 20 technicians. The production equipments include blow molding machines, the injection molding machines, the blister machines, the rivet machines, the punching machines, the semi-automatic sewing machines and so on. We have the enough capability to produce the customized products.<br />\n<br />\n工厂<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105251_51097.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105303_53354.jpg\" alt=\"\" /><br />\n<br />\n吹塑<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105335_17599.jpg\" alt=\"\" /><br />\n<br />\n缝纫<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105350_18011.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105407_13457.jpg\" alt=\"\" /><br />\n<br />\n吸塑<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105430_97750.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105451_27278.jpg\" alt=\"\" /><br />\n<br />\n注塑<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105509_94992.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105529_13359.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105538_56485.jpg\" alt=\"\" /><br />\n<br />\n铆钉冲压<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105602_45419.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105621_99906.jpg\" alt=\"\" /><br />\n<br />\n<img src=\"/etonn/qdkidmart/attached/image/20120323/20120323105628_24447.jpg\" alt=\"\" /><br />\n<br />\n<br />', '1332898425');
INSERT INTO `article` VALUES ('174', 'page', null, null, '0', 'cn', 'company-profile-index', '公司简介(首页)', null, '青岛凯德玛国际贸易有限公司坐落于美丽的海滨城市山东青岛，公司主营塑料儿童制品的出口。多年来，凭借优良的产品质量和诚信为本的服务宗旨，产品远销欧美、东南亚等区域，受到海外客户的一致认可，<img src=\"/etonn/qdkidmart/attached/image/20120325/20120325143508_55417.png\" align=\"left\" alt=\"\" style=\"border-style:initial;border-color:initial;margin-top:5px;margin-right:10px;margin-bottom:0px;margin-left:0px;\" />目前我们生产的产品在欧美主流的儿童用品销售渠道如TOYSRUS, WALMART, SEARS, TARGET, KMART等均有销售。<br />\n<br />\n“质量第一、合作伙伴满意”是我们不断追求的目标，我们将一如既往的提供给我们的合作伙伴和客户最真诚的服务和最可靠的产品。<br />\n<br />', '1332659250');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `cid` int(8) NOT NULL AUTO_INCREMENT,
  `pid` int(8) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `descrip` varchar(64) DEFAULT NULL,
  `cat_url` varchar(64) DEFAULT NULL,
  `sort_order` int(4) DEFAULT NULL,
  `model` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', '0', '------新闻------', null, 'news', '50', '');
INSERT INTO `category` VALUES ('106', '1', '企业新闻', null, 'company-news', '50', null);
INSERT INTO `category` VALUES ('2', '0', '------图片------', null, 'photo', '50', null);
INSERT INTO `category` VALUES ('109', '2', 'Canopy Bed 帐篷儿童床', null, 'canopy-bed', '50', null);
INSERT INTO `category` VALUES ('110', '2', 'Table&Chairs 儿童桌椅', null, 'table-chairs', '50', null);
INSERT INTO `category` VALUES ('111', '2', 'Toddler Bed 常规儿童床', null, 'toddler-bed', '50', null);

-- ----------------------------
-- Table structure for `company`
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `description` text NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `is_phone_public` tinyint(4) NOT NULL COMMENT 'Allow Jobseekers to see your phone number',
  `jingchat` varchar(100) NOT NULL,
  `is_allow_jingchat_contact` tinyint(4) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `wechat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------

-- ----------------------------
-- Table structure for `company_industry`
-- ----------------------------
DROP TABLE IF EXISTS `company_industry`;
CREATE TABLE `company_industry` (
  `company_id` int(11) NOT NULL,
  `industry` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_industry
-- ----------------------------

-- ----------------------------
-- Table structure for `company_social`
-- ----------------------------
DROP TABLE IF EXISTS `company_social`;
CREATE TABLE `company_social` (
  `company_id` int(20) NOT NULL,
  `social_type` varchar(100) DEFAULT NULL,
  `social_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company_social
-- ----------------------------

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `cid` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `key` varchar(32) NOT NULL,
  `value` text,
  `descrip` varchar(128) DEFAULT NULL,
  `category` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'Site name', 'site_name', 'jingjobs.com', '网站的名称', 'global');
INSERT INTO `config` VALUES ('2', 'Theme', 'front_theme', 'default', 'Site Theme', 'hide');
INSERT INTO `config` VALUES ('3', 'Admin Theme', 'admin_theme', 'admin', 'Admin Theme', 'hide');
INSERT INTO `config` VALUES ('4', 'Keyword', 'keyword', 'jingjobs.com', '网站关键字', 'global');
INSERT INTO `config` VALUES ('5', 'Site Description', 'description', 'jingjobs.com', '网站描述', 'global');
INSERT INTO `config` VALUES ('6', 'Language', 'language', 'en,cn', 'Site language', 'hide');

-- ----------------------------
-- Table structure for `job`
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `job_name` varchar(100) NOT NULL COMMENT 'Job Name',
  `location` varchar(100) DEFAULT NULL,
  `employment_length` tinyint(4) DEFAULT NULL COMMENT 'Length of employment (Short Term..)',
  `employment_type` tinyint(4) DEFAULT NULL COMMENT 'Type of employment (Full..)',
  `industry` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `salary_range` varchar(30) DEFAULT NULL,
  `experience` tinyint(4) DEFAULT NULL COMMENT 'Year of experience (1 year, etc..)',
  `language` varchar(50) DEFAULT NULL COMMENT 'Required languages for this Job',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` bigint(20) NOT NULL,
  `first_name` varchar(50) NOT NULL COMMENT 'First Name',
  `last_name` varchar(50) NOT NULL COMMENT 'Last Name',
  `country` varchar(50) DEFAULT NULL COMMENT 'Country',
  `city` varchar(50) DEFAULT NULL COMMENT 'City',
  `city_id` int(11) DEFAULT NULL,
  `profile_pic` varchar(100) DEFAULT NULL COMMENT 'Profile Picture',
  `birthday` date DEFAULT NULL COMMENT 'Birthday',
  `is_private` tinyint(4) NOT NULL COMMENT 'Whether keep info private',
  `email` varchar(50) DEFAULT NULL COMMENT 'Email Address',
  `phone` varchar(30) DEFAULT NULL COMMENT 'PHone Number (include area code)',
  `is_allow_phone` tinyint(4) DEFAULT NULL COMMENT 'Allow employers to contact you by phone',
  `jingchat_username` varchar(100) DEFAULT NULL COMMENT 'Username for Jing Chat',
  `is_allow_online_msg` tinyint(4) DEFAULT NULL COMMENT 'Allow employees to contact you through online message',
  `personal_website` varchar(100) DEFAULT NULL COMMENT 'Personal website',
  `twitter` varchar(100) DEFAULT NULL COMMENT 'Twitter username',
  `linkedin` varchar(100) DEFAULT NULL COMMENT 'Linkedin Username',
  `wechat` varchar(100) DEFAULT NULL COMMENT 'WeChat ID',
  `employment_length` tinyint(4) DEFAULT NULL COMMENT 'Perffered length of employment',
  `employment_type` tinyint(4) DEFAULT NULL COMMENT 'Perferred type of employment',
  `is_visa_assistance` tinyint(4) DEFAULT NULL COMMENT 'Require Visa assistance from employer',
  `is_accomodation_assistance` tinyint(4) DEFAULT NULL COMMENT 'Accomodation assistance from employer',
  `availability` tinyint(4) DEFAULT NULL COMMENT 'Availiability time',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for `user_education`
-- ----------------------------
DROP TABLE IF EXISTS `user_education`;
CREATE TABLE `user_education` (
  `uid` bigint(20) NOT NULL,
  `school_name` varchar(50) DEFAULT NULL,
  `attend_date_from` date DEFAULT NULL,
  `attend_date_to` date DEFAULT NULL,
  `degree` varchar(50) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL,
  `achievements` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_education
-- ----------------------------

-- ----------------------------
-- Table structure for `user_language`
-- ----------------------------
DROP TABLE IF EXISTS `user_language`;
CREATE TABLE `user_language` (
  `uid` bigint(20) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_language
-- ----------------------------

-- ----------------------------
-- Table structure for `user_personal_skills`
-- ----------------------------
DROP TABLE IF EXISTS `user_personal_skills`;
CREATE TABLE `user_personal_skills` (
  `uid` bigint(20) NOT NULL,
  `personal_skill` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_personal_skills
-- ----------------------------

-- ----------------------------
-- Table structure for `user_professional_skills`
-- ----------------------------
DROP TABLE IF EXISTS `user_professional_skills`;
CREATE TABLE `user_professional_skills` (
  `uid` bigint(20) NOT NULL,
  `professional_skill` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_professional_skills
-- ----------------------------

-- ----------------------------
-- Table structure for `user_seeking_industry`
-- ----------------------------
DROP TABLE IF EXISTS `user_seeking_industry`;
CREATE TABLE `user_seeking_industry` (
  `uid` bigint(20) NOT NULL,
  `industry` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_seeking_industry
-- ----------------------------

-- ----------------------------
-- Table structure for `user_social`
-- ----------------------------
DROP TABLE IF EXISTS `user_social`;
CREATE TABLE `user_social` (
  `uid` bigint(20) NOT NULL,
  `social_type` varchar(100) DEFAULT NULL,
  `social_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_social
-- ----------------------------

-- ----------------------------
-- Table structure for `user_work_history`
-- ----------------------------
DROP TABLE IF EXISTS `user_work_history`;
CREATE TABLE `user_work_history` (
  `uid` bigint(20) NOT NULL,
  `introduce` varchar(350) DEFAULT NULL,
  `company_name` varchar(50) NOT NULL,
  `period_time_from` smallint(6) NOT NULL,
  `period_time_to` smallint(6) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` varchar(350) DEFAULT NULL,
  `work_examples_url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_work_history
-- ----------------------------
