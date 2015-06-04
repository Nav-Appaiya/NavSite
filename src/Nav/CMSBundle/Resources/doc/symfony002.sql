/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : symfony

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-03-08 19:55:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES ('1', 'Programming');
INSERT INTO `category` VALUES ('2', 'Design patterns');
INSERT INTO `category` VALUES ('3', 'Object Oriented Programming');
INSERT INTO `category` VALUES ('4', 'Symfony2');
INSERT INTO `category` VALUES ('5', 'Codeigniter');

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B438191E12469DE2` (`category_id`),
  CONSTRAINT `FK_B438191E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES ('1', 'PHP Tips', 'PHP has had many reputations over the years, but being insecure as a language never really was one of them.', '1');
INSERT INTO `page` VALUES ('2', 'Design Patterns', 'There are numerous ways to structure the code and project for your web application, and you can put as much or as little thought as you like into architecting. But it is usually a good idea to follow common patterns because it will make your code easier to manage and easier for others to understand.', '2');
INSERT INTO `page` VALUES ('3', 'Object-Oriented PHP for Beginners', 'For many PHP programmers, object-oriented programming is a frightening concept, full of complicated syntax and other roadblocks. As detailed in my book, Pro PHP and jQuery, you\'ll learn the concepts behind object-oriented programming (OOP), a style of coding in which related actions are grouped into classes to aid in creating more-compact, effective code.', '3');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'nav', '$2y$10$B6LRJcpBzwczomLy9uvXxeoyAFVKAEddhaQlkBfwW86lL5uOzXyxa');
