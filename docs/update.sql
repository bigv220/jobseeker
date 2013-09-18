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

#2013-9-5
alter table user add password varchar(50) not null;
alter table user add user_type varchar(20);

-- ----------------------------
-- Table structure for city
-- ----------------------------
CREATE TABLE `city` (
  `id` tinyint(4) NOT NULL auto_increment,
  `country_id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for country
-- ----------------------------
CREATE TABLE `country` (
  `id` tinyint(4) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#2013-9-12
alter table user change user_type user_type tinyint(4) default 0;
alter table user add newsletter tinyint(1);

#2013-9-15
drop table job;
-- ----------------------------
-- Table structure for job
-- ----------------------------
CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `job_name` varchar(100) NOT NULL COMMENT 'Job Name',
  `job_desc` text,
  `location` varchar(100) default NULL,
  `employment_length` tinyint(4) default NULL COMMENT 'Length of employment (Short Term..)',
  `employment_type` tinyint(4) default NULL COMMENT 'Type of employment (Full..)',
  `industry` varchar(100) default NULL,
  `position` varchar(100) default NULL,
  `salary_range` varchar(30) default NULL,
  `preferred_year_of_experience` varchar(20) default NULL COMMENT 'Year of experience (1 year, etc..)',
  `language` varchar(50) default NULL COMMENT 'Required languages for this Job',
  `preferred_personal_skills` text,
  `preferred_technical_skills` text,
  `is_visa_assistance` tinyint(4) default NULL,
  `is_housing_assistance` tinyint(4) default NULL,
  `company_id` int(11) default NULL,
  `post_date` date default NULL,
    PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- ----------------------------
-- Table structure for newsletter
-- ----------------------------
CREATE TABLE `newsletter` (
  `id` tinyint(4) NOT NULL auto_increment,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;