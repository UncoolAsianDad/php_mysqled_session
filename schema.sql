/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : invo

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2013-04-15 12:11:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `session_data` text NOT NULL,
  `session_expiration` longtext NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
