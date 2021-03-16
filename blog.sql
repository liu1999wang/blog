# Host: localhost  (Version: 5.5.53)
# Date: 2021-03-16 16:28:06
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "blog_admin_role"
#

DROP TABLE IF EXISTS `blog_admin_role`;
CREATE TABLE `blog_admin_role` (
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_admin_role"
#

/*!40000 ALTER TABLE `blog_admin_role` DISABLE KEYS */;
INSERT INTO `blog_admin_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,3),(6,2),(7,3),(8,3);
/*!40000 ALTER TABLE `blog_admin_role` ENABLE KEYS */;

#
# Structure for table "blog_article"
#

DROP TABLE IF EXISTS `blog_article`;
CREATE TABLE `blog_article` (
  `art_id` int(10) NOT NULL AUTO_INCREMENT,
  `art_title` varchar(60) NOT NULL DEFAULT '',
  `art_tag` varchar(60) NOT NULL DEFAULT '',
  `art_description` varchar(255) NOT NULL DEFAULT '',
  `art_thumb` varchar(255) NOT NULL DEFAULT '',
  `art_content` text NOT NULL,
  `art_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `art_editor` varchar(60) NOT NULL DEFAULT '',
  `art_view` int(10) NOT NULL DEFAULT '0',
  `cate_id` int(10) NOT NULL DEFAULT '0',
  `art_status` int(10) NOT NULL DEFAULT '0',
  `art_love` int(10) NOT NULL DEFAULT '0',
  `art_collect` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`art_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_article"
#

/*!40000 ALTER TABLE `blog_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_article` ENABLE KEYS */;

#
# Structure for table "blog_category"
#

DROP TABLE IF EXISTS `blog_category`;
CREATE TABLE `blog_category` (
  `cate_id` int(10) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(60) NOT NULL DEFAULT '',
  `cate_title` varchar(60) NOT NULL DEFAULT '',
  `cate_order` int(11) NOT NULL DEFAULT '0',
  `cate_pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_category"
#

/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;

#
# Structure for table "blog_client_ip"
#

DROP TABLE IF EXISTS `blog_client_ip`;
CREATE TABLE `blog_client_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(11) NOT NULL DEFAULT '0',
  `ip` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_client_ip"
#

/*!40000 ALTER TABLE `blog_client_ip` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_client_ip` ENABLE KEYS */;

#
# Structure for table "blog_collect"
#

DROP TABLE IF EXISTS `blog_collect`;
CREATE TABLE `blog_collect` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_collect"
#

/*!40000 ALTER TABLE `blog_collect` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_collect` ENABLE KEYS */;

#
# Structure for table "blog_comment"
#

DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(255) NOT NULL DEFAULT '',
  `head_pic` longtext NOT NULL,
  `content` text NOT NULL,
  `post_ip` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_comment"
#

/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;

#
# Structure for table "blog_congig"
#

DROP TABLE IF EXISTS `blog_congig`;
CREATE TABLE `blog_congig` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
  `conf_title` varchar(50) NOT NULL DEFAULT '',
  `conf_tite` varchar(50) NOT NULL DEFAULT '',
  `conf_content` text NOT NULL,
  `conf_order` int(11) NOT NULL DEFAULT '0',
  `conf_tips` varchar(255) NOT NULL DEFAULT '',
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_value` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_congig"
#

/*!40000 ALTER TABLE `blog_congig` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_congig` ENABLE KEYS */;

#
# Structure for table "blog_links"
#

DROP TABLE IF EXISTS `blog_links`;
CREATE TABLE `blog_links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(255) NOT NULL DEFAULT '',
  `link_title` varchar(255) NOT NULL DEFAULT '',
  `link_url` varchar(255) NOT NULL DEFAULT '',
  `link_order` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL,
  `delete_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_links"
#

/*!40000 ALTER TABLE `blog_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_links` ENABLE KEYS */;

#
# Structure for table "blog_permission"
#

DROP TABLE IF EXISTS `blog_permission`;
CREATE TABLE `blog_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `per_name` varchar(255) NOT NULL DEFAULT '',
  `per_url` varchar(255) NOT NULL DEFAULT '',
  `parent` int(11) NOT NULL DEFAULT '0',
  `is_show` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

#
# Data for table "blog_permission"
#

/*!40000 ALTER TABLE `blog_permission` DISABLE KEYS */;
INSERT INTO `blog_permission` VALUES (1,'管理员管理','#',0,1),(2,'管理员列表','App\\Http\\Controllers\\Admin@list',1,1),(3,'管理员添加','App\\Http\\Controllers\\Admin@add',2,0),(4,'管理员编辑','App\\Http\\Controllers\\Admin@edit',2,0),(5,'管理员删除','App\\Http\\Controllers\\Admin@del',2,0),(6,'赋予角色','App\\Http\\Controllers\\Admin@role',2,0),(7,'角色管理','App\\Http\\Controllers\\Role@list',1,1),(8,'角色添加','App\\Http\\Controllers\\Role@add',7,0),(9,'角色编辑','App\\Http\\Controllers\\Role@edit',7,0),(10,'角色授权','App\\Http\\Controllers\\Role@empower',7,0),(11,'角色删除','App\\Http\\Controllers\\Role@del',7,0),(12,'权限管理','App\\Http\\Controllers\\Permission@list',1,1),(13,'权限添加','App\\Http\\Controllers\\Permission@add',12,0),(14,'权限编辑','App\\Http\\Controllers\\Permission@edit',12,0),(15,'权限删除','App\\Http\\Controllers\\Permission@del',12,0),(16,'用户管理','#',0,1),(17,'用户列表','App\\Http\\Controllers\\User@list',16,1),(18,'用户添加','App\\Http\\Controllers\\User@add',17,0);
/*!40000 ALTER TABLE `blog_permission` ENABLE KEYS */;

#
# Structure for table "blog_role"
#

DROP TABLE IF EXISTS `blog_role`;
CREATE TABLE `blog_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL DEFAULT '',
  `describe` varchar(255) NOT NULL DEFAULT '无',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

#
# Data for table "blog_role"
#

/*!40000 ALTER TABLE `blog_role` DISABLE KEYS */;
INSERT INTO `blog_role` VALUES (1,'超级管理员','拥有最高权限'),(2,'文章管理员','拥有关于文章的权限'),(3,'用户管理员','拥有关于用户的权限');
/*!40000 ALTER TABLE `blog_role` ENABLE KEYS */;

#
# Structure for table "blog_role_permission"
#

DROP TABLE IF EXISTS `blog_role_permission`;
CREATE TABLE `blog_role_permission` (
  `role_id` int(11) NOT NULL DEFAULT '1',
  `permission_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "blog_role_permission"
#

/*!40000 ALTER TABLE `blog_role_permission` DISABLE KEYS */;
INSERT INTO `blog_role_permission` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(2,16),(2,17),(2,18),(3,16),(3,17),(3,18);
/*!40000 ALTER TABLE `blog_role_permission` ENABLE KEYS */;

#
# Structure for table "data_admin_user"
#

DROP TABLE IF EXISTS `data_admin_user`;
CREATE TABLE `data_admin_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(60) NOT NULL DEFAULT '',
  `statu` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

#
# Data for table "data_admin_user"
#

/*!40000 ALTER TABLE `data_admin_user` DISABLE KEYS */;
INSERT INTO `data_admin_user` VALUES (1,'admin','57e30cd5deeed1b3fd16c60938d7d8e2',1),(2,'ljw1999','57e30cd5deeed1b3fd16c60938d7d8e2',1),(3,'chfadmin','57e30cd5deeed1b3fd16c60938d7d8e2',1),(4,'cqjadmin','57e30cd5deeed1b3fd16c60938d7d8e2',1),(5,'ljhadmin','57e30cd5deeed1b3fd16c60938d7d8e2',1),(6,'lyjadmin','57e30cd5deeed1b3fd16c60938d7d8e2',1),(7,'zsqadmin','57e30cd5deeed1b3fd16c60938d7d8e2',1),(8,'fjjadmin','57e30cd5deeed1b3fd16c60938d7d8e2',1);
/*!40000 ALTER TABLE `data_admin_user` ENABLE KEYS */;

#
# Structure for table "data_reception_user"
#

DROP TABLE IF EXISTS `data_reception_user`;
CREATE TABLE `data_reception_user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(60) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '',
  `sex` int(2) NOT NULL DEFAULT '0',
  `head` longtext NOT NULL,
  `statu` int(2) NOT NULL DEFAULT '1',
  `add_time` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

#
# Data for table "data_reception_user"
#

/*!40000 ALTER TABLE `data_reception_user` DISABLE KEYS */;
INSERT INTO `data_reception_user` VALUES (1,'12313','57e30cd5deeed1b3fd16c60938d7d8e2','15860298821','2449253779@qq.com',1,'..\\upload\\head\\head2.png',1,'2021-03-16'),(2,'明天，你好','57e30cd5deeed1b3fd16c60938d7d8e2','15860298821','2449253778@qq.com',0,'../upload/uphead/izndkrvpgcrjuopacpsbewydsa1615881745.jpeg',1,'2021-03-16');
/*!40000 ALTER TABLE `data_reception_user` ENABLE KEYS */;
