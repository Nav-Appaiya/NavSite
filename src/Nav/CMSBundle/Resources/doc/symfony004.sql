/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : symfony

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-03-16 12:42:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Nieuws', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category` VALUES ('2', 'Design patterns', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category` VALUES ('3', 'Object Oriented Programming', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category` VALUES ('4', 'Symfony2', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `category` VALUES ('5', 'Codeigniter', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for contact
-- ----------------------------
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `message` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of contact
-- ----------------------------
INSERT INTO `contact` VALUES ('20', 'test', 'test@test.nl', 't', '2015-03-15 17:41:42', '2015-03-15 17:41:42');
INSERT INTO `contact` VALUES ('21', 'test', 'test@test.nl', 'test', '2015-03-15 17:42:33', '2015-03-15 17:42:33');
INSERT INTO `contact` VALUES ('22', 'test', 'test@test.nl', 'test', '2015-03-15 17:43:01', '2015-03-15 17:43:01');
INSERT INTO `contact` VALUES ('23', 't', 'test@test.nl', 't', '2015-03-15 17:43:15', '2015-03-15 17:43:15');
INSERT INTO `contact` VALUES ('24', 'test', 'test@test.nl', 'test', '2015-03-15 17:43:35', '2015-03-15 17:43:35');
INSERT INTO `contact` VALUES ('25', 'test', 'test@test.nl', 't', '2015-03-15 17:43:52', '2015-03-15 17:43:52');
INSERT INTO `contact` VALUES ('26', 'test', 'test@test.nl', 't', '2015-03-15 17:44:11', '2015-03-15 17:44:11');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `feed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438191E12469DE2` (`category_id`),
  CONSTRAINT `FK_B438191E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', 'Tech nieuws', 'Altijd op de hoogte van het laatste Technieuws', '1', 'http://feeds.feedburner.com/technieuws/nav', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `page` VALUES ('2', 'Tweakers nieuws', 'Tweakers is de grootste hardwaresite en techcommunity van Nederland.', '1', 'http://feeds.feedburner.com/tweakers/mixed', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `page` VALUES ('3', 'Nu.nl - Tech', 'Het laatste tech nieuws het eerst op NU.nl', '1', 'http://feeds.feedburner.com/nu/aUIN', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'nav', '$2y$10$B6LRJcpBzwczomLy9uvXxeoyAFVKAEddhaQlkBfwW86lL5uOzXyxa', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
