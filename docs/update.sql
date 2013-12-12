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

alter table user_work_history modify location varchar(50) null;

#2013-9-16
alter table user add register_step varchar(20) null;

#2013-09-18
DELETE FROM `article` where url='aboutus';
INSERT INTO `article` (`aid`, `type`, `cid`, `uid`, `order`, `lang`, `url`, `title`, `descrip`, `content`, `date`) VALUES (NULL, 'page', NULL, NULL, '0', NULL, 'aboutus', 'About us', NULL, 'JingJobs is a unique online network connecting jobseekers with employment opportunities and internships within China. Our aim is to revolutionize the recruitment process by providing an efficient, organized and streamlined job-listing website.&nbsp;<br /><br /><strong>We¡¯ve got you covered.</strong><br /><br />JingJobs will bring you Full Time, Part Time, Casual, Contractor employment and internships in countless industries. You will find long and short-term employment and have the option to request accommodation and visa assistance too. No matter what you need, we¡¯ve got you covered. &nbsp;<br /><br /><strong>We¡¯ll do the work for you.</strong><br /><br />No one likes spending hours searching for the perfect job. This is where JingJobs is great - just fill in your details including education and employment history, language skills and personality traits and we¡¯ll match you to a great employer. At the same time, we¡¯ll recommend you to employers and job positions that we think would be interested in you. The more information you provide, the more accurate the match will be. Don¡¯t stress, we¡¯ll do the work for you.<br /><br /><strong>Be sure before you commit.</strong><br /><br />Taking on a new employee is a big deal and starting a new job is never easy. That¡¯s why you¡¯ll have the added confidence of a live chat function and private messaging interface where job seekers and employers can build a relationship, before the contract is signed. It¡¯s always important to be sure before you make any commitment.<br /><br />', '0');

#2013-9-20
alter table user modify birthday char(10);

#2013-9-24
alter table user_work_history add is_stillhere tinyint(4) null;
alter table user_education modify attend_date_from char(10);
alter table user_education modify attend_date_to char(10);

#2013-9-28 Modify User table, save company info in the user table
alter table user add description text null;

#2013-9-28 Please execute Industry&Skills.sql file to add industry, tech_skills, personal_skills table!!!

#2013-9-30 modify user table to add username field
alter table user add username varchar(50) null;

#2013-9-30
alter table user_seeking_industry modify industry varchar(100);
alter table user_seeking_industry modify position varchar(100);
alter table user_work_history modify industry varchar(100);

#2013-10-07
alter table user add province varchar(50) null;

#2013-10-10
ALTER TABLE  `job` ADD  `language_level` VARCHAR( 50 ) NULL AFTER  `language`;
ALTER TABLE  `job` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT

#2013-10-15
ALTER TABLE user_work_history  DROP PRIMARY KEY;

#2013-10-20 Add Country,Province,City info for JOB
ALTER TABLE  `job` ADD  `country` VARCHAR( 50 ) NULL;
ALTER TABLE  `job` ADD  `province` VARCHAR( 50 ) NULL;
ALTER TABLE  `job` ADD  `city` VARCHAR( 50 ) NULL;

#2013-10-30 Change Type of Employment from Tinyint to Varchar
ALTER TABLE `job` modify column employment_type varchar(100);

#2013-11-4
DELETE FROM user_work_history;
ALTER TABLE user_work_history add column id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT;
alter table user_work_history drop column industry;
alter table user_work_history drop column position;

CREATE TABLE `user_industry_position` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `uid` bigint(20) default NULL,
  `industry` varchar(50) default NULL,
  `position` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;ALTER TABLE `job` modify column employment_type varchar(100);
ALTER TABLE `job` modify column employment_type varchar(100);
ALTER TABLE `user` modify column employment_type varchar(100);

#2013-11-4
ALTER TABLE  user CHANGE  wechat  weibo VARCHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT  'weibo.com';
ALTER TABLE  user ADD  `facebook` VARCHAR( 100 ) NULL AFTER  weibo;

#2013-11-5
alter table job drop column language;
alter table job drop column language_level;
CREATE TABLE `job_language_level` (
  `id` int(11) NOT NULL auto_increment,
  `job_id` int(11) default NULL,
  `language` varchar(50) default NULL,
  `level` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#2013-11-08 
CREATE TABLE `job_apply` (
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`job_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#2013-11-13
alter table job drop column industry;
alter table job drop column position;
CREATE TABLE `job_industry_position` (
  `id` int(11) NOT NULL auto_increment,
  `job_id` int(11) default NULL,
  `industry` varchar(50) default NULL,
  `position` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#2013-11-18
ALTER TABLE `user` modify column availability varchar(50);
ALTER TABLE `user_work_history` modify column period_time_from char(10);
ALTER TABLE `user_work_history` modify column period_time_to char(10);

#2013-11-28
CREATE TABLE `job_bookmark` (
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`job_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `company_bookmark` (
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY  (`user_id`,`company_id`)
)

CREATE TABLE IF NOT EXISTS `inbox` (
  `id` bigint(20) NOT NULL,
  `seq` int(11) NOT NULL,
  `user1` bigint(20) NOT NULL,
  `user2` bigint(20) NOT NULL,
  `title` varchar(256) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(10) NOT NULL,
  `user1read` varchar(3) NOT NULL,
  `user2read` varchar(3) NOT NULL,
  `is_delete` tinyint(4) DEFAULT NULL,
  `is_offline` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#2013-12-08 Add column number of viewed profile.
ALTER TABLE  user ADD  `visit_num` INT(11) NULL DEFAULT 0;

#2013-12-10 Add interview table
CREATE TABLE `interview` (
  `id` int(11) NOT NULL auto_increment,
  `uid` int(11) default NULL COMMENT 'interview request to',
  `company_id` int(11) default NULL COMMENT 'interview request from',
  `job_id` int(11) default NULL,
  `communication_type` varchar(20) default NULL,
  `message` text,
  `communication_other` varchar(100) default NULL,
  `date` date default NULL,
  `time` varchar(20) default NULL,
  `time_zone` varchar(20) default NULL,
  `insert_date` varchar(10) default NULL,
  `is_deleted` smallint(6) default NULL,
  `reply_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

#2013-12-12
drop table company;