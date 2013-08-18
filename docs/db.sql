-- phpMyAdmin SQL Dump
-- version 3.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2013 at 07:54 PM
-- Server version: 5.1.32
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `etonn_jobseeker`
--

-- --------------------------------------------------------

--
-- Table structure for table `etonn_article`
--

CREATE TABLE IF NOT EXISTS `etonn_article` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=188 ;

--
-- Dumping data for table `etonn_article`
--

INSERT INTO `etonn_article` (`aid`, `type`, `cid`, `uid`, `order`, `lang`, `url`, `title`, `descrip`, `content`, `date`) VALUES
(161, 'news', 106, NULL, 0, 'cn', NULL, '新闻1', NULL, '新闻1新闻1<br />\r\n新闻1新闻1<br />\r\n新闻1新闻1<br />', 1329408000),
(162, 'news', 106, NULL, 0, 'cn', NULL, '新闻2', NULL, '新闻2<br />\r\n新闻2<br />\r\n新闻2<br />', 1329408000),
(163, 'news', 106, NULL, 0, 'cn', NULL, '新闻3', NULL, '新闻3<br />\r\n新闻3<br />\r\n新闻3<br />', 1329408000),
(164, 'news', 106, NULL, 0, 'cn', NULL, '新闻4', NULL, '新闻4<br />\r\n新闻4<br />\r\n新闻4<br />', 1329408000),
(165, 'news', 106, NULL, 0, 'cn', NULL, '新闻5', NULL, '新闻5<br />\r\n新闻5<br />\r\n新闻5<br />', 1348848000),
(166, 'news', 106, NULL, 0, 'en', NULL, 'News1', NULL, 'News1<br />\r\nNews1<br />\r\nNews1<br />', 1329408000),
(167, 'news', 106, NULL, 0, 'en', NULL, 'News2', NULL, 'News2', 1329408000),
(168, 'news', 106, NULL, 0, 'en', NULL, 'News3', NULL, 'News3', 1329408000),
(169, 'news', 106, NULL, 0, 'en', NULL, 'News4', NULL, 'News4', 1329408000),
(170, 'news', 106, NULL, 0, 'en', NULL, 'News5', NULL, 'News5', 1329408000),
(43, 'page', 0, NULL, 0, 'cn', 'contact', '联系我们', NULL, '<p>\r\n	<span>青岛德润凯化工有限公司<br />\r\nwww.durakeychem.com<br />\r\n地址：青岛市崂山区深圳路222号天泰金融广场C座203室<br />\r\n电话：0532-89093718<br />\r\n传真：0532-80687050<br />\r\n</span> \r\n</p>\r\n<br />', 1369561220),
(183, 'block', NULL, NULL, 0, 'cn', 'block-index2', '首页公司简介', NULL, '公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介<br />\r\n<span>公司简介&nbsp;公司简介&nbsp;公司简介&nbsp;公司简介</span></span></span></span></span></span></span><strong><br />\r\n</strong>', 1369567741),
(184, 'block', NULL, NULL, 0, 'cn', 'block-index3', '首页合作伙伴', NULL, '<img src="http://www.shnomics.com/imageRepository/6cfde3e2-018b-48e8-8bf0-183482047cb2.png" alt="" /><br />', 1369568946),
(185, 'block', NULL, NULL, 0, 'en', 'block-index1', '首页中间图片', NULL, '<span style="color:#202020;font-family:Arial, Tahoma, Verdana;line-height:normal;background-color:#FFFFFF;"><span style="color:#202020;font-family:Arial, Tahoma, Verdana;line-height:normal;background-color:#FFFFFF;">首页中间图片</span></span>', 1369569062),
(186, 'block', NULL, NULL, 0, 'en', 'block-index2', '首页公司简介', NULL, '<span style="color:#202020;font-family:Arial, Tahoma, Verdana;line-height:normal;background-color:#FFFFFF;">首页公司简介</span>', 1369569038),
(187, 'block', NULL, NULL, 0, 'en', 'block-index3', '首页合作伙伴', NULL, '<span style="color:#202020;font-family:Arial, Tahoma, Verdana;line-height:normal;background-color:#FFFFFF;">首页合作伙伴</span>', 1369569051),
(173, 'page', NULL, NULL, 0, 'en', 'contact', 'Contact Us', NULL, '青岛德润凯化工有限公司<br />\r\nwww.durakeychem.com<br />\r\n地址：青岛市崂山区深圳路222号天泰金融广场C座203室<br />\r\n电话：0532-89093718<br />\r\n传真：0532-80687050<br />\r\n<br />', 1369561234),
(182, 'news', 112, NULL, 0, 'cn', NULL, '产品展示', NULL, '产品展示', 1369497600),
(180, 'page', NULL, NULL, 0, 'cn', 'download', '下载中心', NULL, '下载中心', 1369561082),
(181, 'page', NULL, NULL, 0, 'en', 'download', 'download', NULL, 'download', 1369561092),
(178, 'page', NULL, NULL, 0, 'cn', 'about', '关于我们', NULL, '关于我们', 1369560839),
(179, 'page', NULL, NULL, 0, 'en', 'about', 'about us', NULL, 'about us', 1369560860),
(177, 'block', NULL, NULL, 0, 'cn', 'block-index1', '首页中间图片', NULL, '<img src="http://www.shnomics.com/imageRepository/e0cd5b8d-5e11-47a0-86ed-7d6e97352f17.jpg" width="309" height="144" alt="" /><img src="http://www.shnomics.com/imageRepository/50c463cd-b7c3-4485-b14b-3d611a583e15.jpg" width="309" height="144" alt="" /><img src="http://www.shnomics.com/imageRepository/6f4bd3ef-4317-4028-a656-9d84bd51a596.jpg" width="309" height="144" alt="" />', 1369567693);

-- --------------------------------------------------------

--
-- Table structure for table `etonn_category`
--

CREATE TABLE IF NOT EXISTS `etonn_category` (
  `cid` int(8) NOT NULL AUTO_INCREMENT,
  `pid` int(8) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL,
  `descrip` varchar(64) DEFAULT NULL,
  `cat_url` varchar(64) DEFAULT NULL,
  `sort_order` int(4) DEFAULT NULL,
  `model` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `etonn_category`
--

INSERT INTO `etonn_category` (`cid`, `pid`, `name`, `descrip`, `cat_url`, `sort_order`, `model`) VALUES
(1, 0, '------新闻------', NULL, 'news', 50, ''),
(106, 1, '企业新闻', NULL, 'company-news', 50, NULL),
(2, 0, '------产品------', NULL, 'product', 50, NULL),
(109, 2, 'Canopy Bed 帐篷儿童床', NULL, 'canopy-bed', 50, NULL),
(110, 2, 'Table&Chairs 儿童桌椅', NULL, 'table-chairs', 50, NULL),
(111, 2, 'Toddler Bed 常规儿童床', NULL, 'toddler-bed', 50, NULL),
(112, 1, '企业产品', NULL, 'company-products', 50, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `etonn_comment`
--

CREATE TABLE IF NOT EXISTS `etonn_comment` (
  `cid` int(8) NOT NULL,
  `aid` int(8) NOT NULL,
  `date` int(10) DEFAULT NULL,
  `uid` int(8) DEFAULT NULL,
  `content` text,
  `author_name` varchar(100) DEFAULT NULL,
  `author_email` varchar(100) DEFAULT NULL,
  `anthor_phone` varchar(64) DEFAULT NULL,
  `author_ip` varchar(64) DEFAULT NULL,
  `pid` int(8) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etonn_comment`
--

INSERT INTO `etonn_comment` (`cid`, `aid`, `date`, `uid`, `content`, `author_name`, `author_email`, `anthor_phone`, `author_ip`, `pid`) VALUES
(1, 100, 0, NULL, '第一个留言问题', '留言作者', 'test@test.com', NULL, '0', 0),
(2, 100, 0, NULL, '第一个留言的回答', '回答作者', 'test2@123.com', NULL, '0', 1),
(3, 100, 0, NULL, '第二个留言的问题', '第二个问题的作者', 'admin@test.com', NULL, '0', 0),
(4, 100, 0, NULL, '第二个留言的回答', '第二个问题回答的作者', 'zhang@gmail.com', NULL, '0', 3),
(5, 100, 0, NULL, '第三个问题没有人回答', '第三个问题作者', 'no_answer@163.com', NULL, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `etonn_config`
--

CREATE TABLE IF NOT EXISTS `etonn_config` (
  `cid` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `key` varchar(32) NOT NULL,
  `value` text,
  `descrip` varchar(128) DEFAULT NULL,
  `category` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `etonn_config`
--

INSERT INTO `etonn_config` (`cid`, `name`, `key`, `value`, `descrip`, `category`) VALUES
(1, 'Site name', 'site_name', '青岛化工有限公司', '网站的名称', 'global'),
(2, 'Theme', 'front_theme', 'default', 'Site Theme', 'hide'),
(3, 'Admin Theme', 'admin_theme', 'admin', 'Admin Theme', 'hide'),
(4, 'Keyword', 'keyword', '青岛德润凯化工有限公司,durakeychem.com', '网站关键字', 'global'),
(5, 'Site Description', 'description', '青岛德润凯化工有限公司', '网站描述', 'global'),
(6, 'Language', 'language', 'en,cn', 'Site language', 'hide'),
(8, 'Footer text', 'footer', 'Copyright © 2013 <a href="http://www.durakeychem.com">青岛德润凯化工有限公司</a><br />\r\n地址：青岛市崂山区深圳路222号天泰金融广场C座203室<br />\r\n电话：0532-89093718 \r\n传真：0532-80687050<br />\r\n<br />', '网站页脚', 'global');

-- --------------------------------------------------------

--
-- Table structure for table `etonn_syslog`
--

CREATE TABLE IF NOT EXISTS `etonn_syslog` (
  `lid` int(8) NOT NULL AUTO_INCREMENT,
  `uid` int(8) DEFAULT NULL,
  `ip` varchar(39) DEFAULT NULL COMMENT 'IPv6 length 39',
  `action` varchar(255) DEFAULT NULL,
  `date` int(10) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `etonn_syslog`
--

INSERT INTO `etonn_syslog` (`lid`, `uid`, `ip`, `action`, `date`) VALUES
(105, 1, '127.0.0.1', '登录系统', 1369501025);

-- --------------------------------------------------------

--
-- Table structure for table `etonn_user`
--

CREATE TABLE IF NOT EXISTS `etonn_user` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=213 ;

--
-- Dumping data for table `etonn_user`
--

INSERT INTO `etonn_user` (`uid`, `group_id`, `username`, `password`, `email`, `lastlogon`, `isadmin`, `firstname`, `lastname`, `status`) VALUES
(1, NULL, 'admin', '7fef6171469e80d32c0559f88b377245', 'admin@admin.com', 1369542112, 1, 'Aret', 'Sevan', 'active'),
(2, NULL, 'administrator', '7d0775da8d9e5afe42ece23f3db13151', 'admin@test.com', 1323228082, 1, 'administrator', 'sino', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `etonn_user_group`
--

CREATE TABLE IF NOT EXISTS `etonn_user_group` (
  `gid` int(4) NOT NULL AUTO_INCREMENT,
  `gname` varchar(64) DEFAULT NULL,
  `privilege` text,
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `etonn_user_group`
--

INSERT INTO `etonn_user_group` (`gid`, `gname`, `privilege`) VALUES
(1, '超级用户', 'all'),
(2, '网站管理员', 'add,view,manage'),
(3, '网站编辑', 'add,view');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
