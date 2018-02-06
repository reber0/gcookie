/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : xss

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-04-25 15:38:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cookies`
-- ----------------------------
DROP TABLE IF EXISTS `cookies`;
CREATE TABLE `cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) NOT NULL DEFAULT '1493030466' COMMENT '获取Cookie的时间',
  `ip` varchar(15) NOT NULL DEFAULT '127.0.0.1' COMMENT '目标的IP',
  `screen` varchar(10) NOT NULL DEFAULT '1366x768' COMMENT '目标的屏幕大小',
  `browser` varchar(50) NOT NULL DEFAULT 'name: mozilla,version: 46.0' COMMENT '目标的浏览器及版本',
  `flash` varchar(20) NOT NULL DEFAULT '25.0 r0' COMMENT '目标的Flash版本',
  `useragent` varchar(150) NOT NULL DEFAULT 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:46.0) Gecko/20100101 Firefox/46.0' COMMENT '目标的User-Agent',
  `domain` varchar(50) NOT NULL DEFAULT '127.0.0.1' COMMENT '目标的域名',
  `title` varchar(200) NOT NULL DEFAULT 'test' COMMENT '目标的Title',
  `lang` varchar(50) NOT NULL DEFAULT 'zh-CN' COMMENT '目标的语言',
  `referer` varchar(1024) NOT NULL DEFAULT '127.0.0.1' COMMENT '目标的Referer',
  `location` varchar(1024) NOT NULL DEFAULT 'http://127.0.0.1/test.html' COMMENT '目标的Location',
  `toplocation` varchar(1024) NOT NULL DEFAULT 'http://127.0.0.1/test.html' COMMENT '目标的TopLocation',
  `cookie` varchar(4096) NOT NULL DEFAULT 'Cookie1=123; Cookie2=456' COMMENT '目标的Cookie',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cookies
-- ----------------------------
INSERT INTO `cookies` VALUES ('2', '1493105687', '127.0.0.1', '1366x768', 'name: mozilla,version: 46.0', '25.0 r0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:46.0) Gecko/20100101 Firefox/46.0', '127.0.0.1', 'test', 'zh-CN', 'http://127.0.0.1/', 'http://127.0.0.1/test.html', 'http://127.0.0.1/test.html', 'PHPSESSID=bbcpseq621evufhofigmol3411');
