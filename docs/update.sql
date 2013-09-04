#2013-9-4
drop table user;

-- ----------------------------
-- Table structure for user
-- ----------------------------
CREATE TABLE `user` (
  `uid` bigint(20) NOT NULL auto_increment,
  `first_name` varchar(50) NOT NULL COMMENT 'First Name',
  `last_name` varchar(50) NOT NULL COMMENT 'Last Name',
  `country` varchar(50) default NULL COMMENT 'Country',
  `city` varchar(50) default NULL COMMENT 'City',
  `city_id` int(11) default NULL,
  `profile_pic` varchar(100) default NULL COMMENT 'Profile Picture',
  `birthday` date default NULL COMMENT 'Birthday',
  `is_private` tinyint(4) default NULL COMMENT 'Whether keep info private',
  `email` varchar(50) default NULL COMMENT 'Email Address',
  `phone` varchar(30) default NULL COMMENT 'PHone Number (include area code)',
  `is_allow_phone` tinyint(4) default NULL COMMENT 'Allow employers to contact you by phone',
  `jingchat_username` varchar(100) default NULL COMMENT 'Username for Jing Chat',
  `is_allow_online_msg` tinyint(4) default NULL COMMENT 'Allow employees to contact you through online message',
  `personal_website` varchar(100) default NULL COMMENT 'Personal website',
  `twitter` varchar(100) default NULL COMMENT 'Twitter username',
  `linkedin` varchar(100) default NULL COMMENT 'Linkedin Username',
  `wechat` varchar(100) default NULL COMMENT 'WeChat ID',
  `employment_length` tinyint(4) default NULL COMMENT 'Perffered length of employment',
  `employment_type` tinyint(4) default NULL COMMENT 'Perferred type of employment',
  `is_visa_assistance` tinyint(4) default NULL COMMENT 'Require Visa assistance from employer',
  `is_accomodation_assistance` tinyint(4) default NULL COMMENT 'Accomodation assistance from employer',
  `availability` tinyint(4) default NULL COMMENT 'Availiability time',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;