/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50524
Source Host           : localhost:3306
Source Database       : messageboard

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-12-21 15:43:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mb_message`
-- ----------------------------
DROP TABLE IF EXISTS `mb_message`;
CREATE TABLE `mb_message` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `content` text NOT NULL,
  `reply` text,
  `userid` int(12) DEFAULT NULL,
  `settop` tinyint(1) NOT NULL DEFAULT '0',
  `ifshow` tinyint(1) NOT NULL DEFAULT '0',
  `ifqqh` tinyint(1) NOT NULL DEFAULT '0',
  `systime` datetime DEFAULT NULL,
  `replytime` datetime DEFAULT NULL,
  `userip` varchar(32) DEFAULT NULL COMMENT '用户ip',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `mb_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of mb_message
-- ----------------------------
INSERT INTO `mb_message` VALUES ('1', 'wod13579@163.com', '什么原因', null, null, '0', '1', '0', '2012-12-20 22:45:34', null, '::1');
INSERT INTO `mb_message` VALUES ('2', 'yinengwu0709', '', null, null, '0', '1', '0', '2012-12-20 22:55:18', null, '::1');
INSERT INTO `mb_message` VALUES ('3', '', 'afafasfsafsafasfasf', null, null, '0', '1', '0', '2012-12-21 14:58:47', null, '::1');
INSERT INTO `mb_message` VALUES ('4', 'yinengwu0709', 'afa  a a  a \r\n a \r\na\r\n a\r\n \r\na ', null, null, '0', '1', '0', '2012-12-21 15:01:42', null, '::1');
INSERT INTO `mb_message` VALUES ('5', 'wod13579@163.com', '吃的饭哈哈大发发', null, null, '0', '1', '0', '2012-12-21 15:11:44', null, '::1');
INSERT INTO `mb_message` VALUES ('6', '', '哈哈哈哈哈你好', null, null, '0', '1', '0', '2012-12-21 15:18:38', null, '::1');
INSERT INTO `mb_message` VALUES ('7', '你你东风', '发发发faf\r\nfi快快快', null, null, '0', '1', '0', '2012-12-21 15:22:44', null, '::1');
INSERT INTO `mb_message` VALUES ('8', '快快快快快', 'htmlspecialchars() 函数把一些预定义的字符转换为 HTML 实体。', null, null, '0', '1', '0', '2012-12-21 15:27:50', null, '::1');
INSERT INTO `mb_message` VALUES ('9', '留言内容以免程序出', '留言内容，以免程序出', null, null, '0', '1', '0', '2012-12-21 15:34:54', null, '::1');

-- ----------------------------
-- Table structure for `mb_users`
-- ----------------------------
DROP TABLE IF EXISTS `mb_users`;
CREATE TABLE `mb_users` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '用户主键',
  `account` varchar(32) NOT NULL COMMENT '用户账号',
  `name` varchar(32) DEFAULT '无名' COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `email` varchar(32) DEFAULT NULL COMMENT '用户邮件',
  `role` int(11) DEFAULT '4' COMMENT '0为管理员；1为会员；4为普通用户；',
  `created` datetime DEFAULT NULL COMMENT '最后登录时间',
  `lastlogin` datetime DEFAULT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of mb_users
-- ----------------------------
INSERT INTO `mb_users` VALUES ('1', 'chuanheng', '四爷', '123456', '825687351@qq.com', '0', '2012-12-20 22:12:03', '2012-12-20 22:12:08');
