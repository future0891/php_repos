/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : think_cms

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-02-03 21:38:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_access`
-- ----------------------------
DROP TABLE IF EXISTS `t_access`;
CREATE TABLE `t_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_access
-- ----------------------------
INSERT INTO `t_access` VALUES ('1', '34', '3', null);
INSERT INTO `t_access` VALUES ('1', '33', '2', null);
INSERT INTO `t_access` VALUES ('1', '13', '3', null);
INSERT INTO `t_access` VALUES ('1', '12', '3', null);
INSERT INTO `t_access` VALUES ('1', '11', '3', null);
INSERT INTO `t_access` VALUES ('1', '10', '3', null);
INSERT INTO `t_access` VALUES ('1', '9', '3', null);
INSERT INTO `t_access` VALUES ('1', '8', '3', null);
INSERT INTO `t_access` VALUES ('1', '7', '3', null);
INSERT INTO `t_access` VALUES ('1', '6', '3', null);
INSERT INTO `t_access` VALUES ('1', '5', '3', null);
INSERT INTO `t_access` VALUES ('1', '4', '3', null);
INSERT INTO `t_access` VALUES ('2', '24', '3', null);
INSERT INTO `t_access` VALUES ('2', '23', '3', null);
INSERT INTO `t_access` VALUES ('2', '22', '3', null);
INSERT INTO `t_access` VALUES ('2', '21', '3', null);
INSERT INTO `t_access` VALUES ('2', '20', '3', null);
INSERT INTO `t_access` VALUES ('2', '19', '3', null);
INSERT INTO `t_access` VALUES ('2', '18', '3', null);
INSERT INTO `t_access` VALUES ('2', '17', '3', null);
INSERT INTO `t_access` VALUES ('2', '16', '3', null);
INSERT INTO `t_access` VALUES ('2', '15', '3', null);
INSERT INTO `t_access` VALUES ('2', '14', '2', null);
INSERT INTO `t_access` VALUES ('2', '13', '3', null);
INSERT INTO `t_access` VALUES ('2', '12', '3', null);
INSERT INTO `t_access` VALUES ('2', '11', '3', null);
INSERT INTO `t_access` VALUES ('2', '10', '3', null);
INSERT INTO `t_access` VALUES ('2', '9', '3', null);
INSERT INTO `t_access` VALUES ('2', '8', '3', null);
INSERT INTO `t_access` VALUES ('2', '7', '3', null);
INSERT INTO `t_access` VALUES ('2', '6', '3', null);
INSERT INTO `t_access` VALUES ('2', '5', '3', null);
INSERT INTO `t_access` VALUES ('1', '3', '3', null);
INSERT INTO `t_access` VALUES ('1', '2', '2', null);
INSERT INTO `t_access` VALUES ('1', '1', '1', null);
INSERT INTO `t_access` VALUES ('2', '4', '3', null);
INSERT INTO `t_access` VALUES ('2', '3', '3', null);
INSERT INTO `t_access` VALUES ('2', '2', '2', null);
INSERT INTO `t_access` VALUES ('1', '35', '3', null);
INSERT INTO `t_access` VALUES ('2', '1', '1', null);
INSERT INTO `t_access` VALUES ('2', '25', '3', null);
INSERT INTO `t_access` VALUES ('2', '26', '3', null);
INSERT INTO `t_access` VALUES ('2', '27', '3', null);
INSERT INTO `t_access` VALUES ('2', '28', '3', null);
INSERT INTO `t_access` VALUES ('2', '29', '3', null);
INSERT INTO `t_access` VALUES ('2', '30', '3', null);
INSERT INTO `t_access` VALUES ('2', '31', '3', null);
INSERT INTO `t_access` VALUES ('2', '32', '3', null);
INSERT INTO `t_access` VALUES ('2', '33', '2', null);
INSERT INTO `t_access` VALUES ('2', '34', '3', null);
INSERT INTO `t_access` VALUES ('2', '35', '3', null);

-- ----------------------------
-- Table structure for `t_article`
-- ----------------------------
DROP TABLE IF EXISTS `t_article`;
CREATE TABLE `t_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `author` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `create_time` date NOT NULL,
  `content` text CHARACTER SET utf8,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of t_article
-- ----------------------------
INSERT INTO `t_article` VALUES ('1', 'tetete', null, '0000-00-00', '<p>bfbdasfbha</p><p>bdabdn</p><p>fbhaafnhnhjjy<br /></p>');
INSERT INTO `t_article` VALUES ('2', '请联系我们', null, '0000-00-00', '我家住在:武汉市硚口区下荣华里5号402<img alt=\"大笑\" src=\"Public/xheditor/xheditor_emot/default/laugh.gif\" /><br />');

-- ----------------------------
-- Table structure for `t_channel`
-- ----------------------------
DROP TABLE IF EXISTS `t_channel`;
CREATE TABLE `t_channel` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `pid` int(100) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_channel
-- ----------------------------
INSERT INTO `t_channel` VALUES ('1', '男装(Male)', '0', null);
INSERT INTO `t_channel` VALUES ('3', '儿童(Kid)', '0', null);
INSERT INTO `t_channel` VALUES ('4', '海澜之家HLA', '1', null);
INSERT INTO `t_channel` VALUES ('5', '西贝', '3', null);
INSERT INTO `t_channel` VALUES ('6', '小阿哥', '3', null);
INSERT INTO `t_channel` VALUES ('7', 'ABC', '3', null);
INSERT INTO `t_channel` VALUES ('8', '英伦夹克', '4', null);
INSERT INTO `t_channel` VALUES ('9', '羽绒服', '4', null);
INSERT INTO `t_channel` VALUES ('10', '衬衣', '4', null);

-- ----------------------------
-- Table structure for `t_discout`
-- ----------------------------
DROP TABLE IF EXISTS `t_discout`;
CREATE TABLE `t_discout` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) NOT NULL,
  `pre_price` double(20,2) NOT NULL,
  `after_price` double(20,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_discout
-- ----------------------------
INSERT INTO `t_discout` VALUES ('1', '8', '278.00', '200.00');
INSERT INTO `t_discout` VALUES ('2', '9', '500.00', '460.00');
INSERT INTO `t_discout` VALUES ('3', '10', '123.00', '100.00');
INSERT INTO `t_discout` VALUES ('4', '9', '500.00', '222.00');
INSERT INTO `t_discout` VALUES ('5', '5', '555.00', '1234.00');
INSERT INTO `t_discout` VALUES ('6', '6', '444.00', '543456.00');
INSERT INTO `t_discout` VALUES ('7', '7', '3333.00', '343567.00');

-- ----------------------------
-- Table structure for `t_node`
-- ----------------------------
DROP TABLE IF EXISTS `t_node`;
CREATE TABLE `t_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_node
-- ----------------------------
INSERT INTO `t_node` VALUES ('1', 'admin', null, '1', '后台管理', null, '0', '1');
INSERT INTO `t_node` VALUES ('2', 'Channel', null, '1', '品种管理', null, '1', '2');
INSERT INTO `t_node` VALUES ('3', 'showChannel', null, '1', '显示品种', null, '2', '3');
INSERT INTO `t_node` VALUES ('4', 'channelInfo', null, '1', '生成品种树', null, '2', '3');
INSERT INTO `t_node` VALUES ('5', 'add', null, '1', '添加品种', null, '2', '3');
INSERT INTO `t_node` VALUES ('6', 'addProcess', null, '1', '添加品种处理 ', null, '2', '3');
INSERT INTO `t_node` VALUES ('7', 'showInfo', null, '1', '显示品种信息', null, '2', '3');
INSERT INTO `t_node` VALUES ('8', 'update', null, '1', '修改品种', null, '2', '3');
INSERT INTO `t_node` VALUES ('9', 'updateProcess', null, '1', '修改品种处理', null, '2', '3');
INSERT INTO `t_node` VALUES ('10', 'delete', null, '1', '删除品种', null, '2', '3');
INSERT INTO `t_node` VALUES ('11', 'sortChannel', null, '1', '品种排序页面', null, '2', '3');
INSERT INTO `t_node` VALUES ('12', 'sortChannelPanel', null, '1', '品种排序面板', null, '2', '3');
INSERT INTO `t_node` VALUES ('13', 'sortChannelProccess', null, '1', '品种排序处理程序', null, '2', '3');
INSERT INTO `t_node` VALUES ('14', 'Product', null, '1', '商品管理', null, '1', '2');
INSERT INTO `t_node` VALUES ('15', 'add', null, '1', '添加商品', null, '14', '3');
INSERT INTO `t_node` VALUES ('16', 'getImage', null, '1', '添加商品图片', null, '14', '3');
INSERT INTO `t_node` VALUES ('17', 'addProcess', null, '1', '添加商品处理', null, '14', '3');
INSERT INTO `t_node` VALUES ('18', 'update', null, '1', '更新商品页面', null, '14', '3');
INSERT INTO `t_node` VALUES ('19', 'updatePanel', null, '1', '更新商品面板', null, '14', '3');
INSERT INTO `t_node` VALUES ('20', 'delete', null, '1', '删除商品及图片', null, '14', '3');
INSERT INTO `t_node` VALUES ('21', 'delPic', null, '1', 'ajax删除图片', null, '14', '3');
INSERT INTO `t_node` VALUES ('22', 'delExistPic', null, '1', '删除已存在图片', null, '14', '3');
INSERT INTO `t_node` VALUES ('23', 'showSortProduct', null, '1', '显示排序商品', null, '14', '3');
INSERT INTO `t_node` VALUES ('24', 'productSort', null, '1', '商品排序处理', null, '14', '3');
INSERT INTO `t_node` VALUES ('25', 'updateProcess', null, '1', '更新处理', null, '14', '3');
INSERT INTO `t_node` VALUES ('26', 'addAttPanel', null, '1', '添加商品属性面板', null, '14', '3');
INSERT INTO `t_node` VALUES ('27', 'addAtt', null, '1', '添加商品属性页面', null, '14', '3');
INSERT INTO `t_node` VALUES ('28', 'attrProcess', null, '1', '库存尺码处理', null, '14', '3');
INSERT INTO `t_node` VALUES ('29', 'attrUpdate', null, '1', '更新属性', null, '14', '3');
INSERT INTO `t_node` VALUES ('30', 'attrUpdateProcess', null, '1', '更新属性处理', null, '14', '3');
INSERT INTO `t_node` VALUES ('31', 'attr_delete', null, '1', 'Ajax 删除商品尺码库存', null, '14', '3');
INSERT INTO `t_node` VALUES ('32', 'addProductPanel', null, '1', '添加商品属性 ', null, '14', '3');
INSERT INTO `t_node` VALUES ('33', 'Index', null, '1', '后台模块', null, '1', '2');
INSERT INTO `t_node` VALUES ('34', 'index', null, '1', '后台框架', null, '33', '3');
INSERT INTO `t_node` VALUES ('35', 'welcom', null, '1', '欢迎页面', null, '33', '3');

-- ----------------------------
-- Table structure for `t_picture`
-- ----------------------------
DROP TABLE IF EXISTS `t_picture`;
CREATE TABLE `t_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`channel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_picture
-- ----------------------------
INSERT INTO `t_picture` VALUES ('1', '52839b294da2d.jpg', '8', null);
INSERT INTO `t_picture` VALUES ('2', '52839b2968fb3.jpg', '8', null);
INSERT INTO `t_picture` VALUES ('3', '52906bfd2b670.jpg', '9', null);
INSERT INTO `t_picture` VALUES ('4', '52906bfd71f68.jpg', '9', null);
INSERT INTO `t_picture` VALUES ('5', '52906c2247ff3.jpg', '10', null);
INSERT INTO `t_picture` VALUES ('6', '52906c2260699.jpg', '10', null);
INSERT INTO `t_picture` VALUES ('7', '52ad5118ee2c2.jpg', '5', null);
INSERT INTO `t_picture` VALUES ('8', '52ad51192a215.jpg', '5', null);
INSERT INTO `t_picture` VALUES ('9', '52ad5131abde1.jpg', '6', null);
INSERT INTO `t_picture` VALUES ('10', '52ad5131c34e6.jpg', '6', null);
INSERT INTO `t_picture` VALUES ('11', '52ad5143ca265.jpg', '7', null);
INSERT INTO `t_picture` VALUES ('12', '52ad5143e5404.jpg', '7', null);

-- ----------------------------
-- Table structure for `t_product`
-- ----------------------------
DROP TABLE IF EXISTS `t_product`;
CREATE TABLE `t_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `recommend` tinyint(1) DEFAULT NULL,
  `discount` tinyint(1) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `description` mediumtext,
  `price` double(25,0) DEFAULT NULL,
  `pubtime` date DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `cover` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_product
-- ----------------------------
INSERT INTO `t_product` VALUES ('1', '8', '1', null, null, '衣服保暖', '278', null, null, '1');
INSERT INTO `t_product` VALUES ('2', '9', '1', null, null, '保暖轻便', '500', null, null, '3');
INSERT INTO `t_product` VALUES ('3', '10', '1', null, null, '清爽', '123', null, null, '5');
INSERT INTO `t_product` VALUES ('4', '5', null, null, null, '测试', '555', null, null, '7');
INSERT INTO `t_product` VALUES ('5', '6', null, null, null, '涣发大号', '444', null, null, '10');
INSERT INTO `t_product` VALUES ('6', '7', null, null, null, '好地方哈电话', '3333', null, null, null);

-- ----------------------------
-- Table structure for `t_product_attribute`
-- ----------------------------
DROP TABLE IF EXISTS `t_product_attribute`;
CREATE TABLE `t_product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_product_attribute
-- ----------------------------
INSERT INTO `t_product_attribute` VALUES ('1', '8', '180', '22');
INSERT INTO `t_product_attribute` VALUES ('2', '8', '185', '11');

-- ----------------------------
-- Table structure for `t_role`
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_role
-- ----------------------------
INSERT INTO `t_role` VALUES ('1', 'channel', null, '1', '品种管理员');
INSERT INTO `t_role` VALUES ('2', 'product', null, '1', '商品管理员');

-- ----------------------------
-- Table structure for `t_role_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_role_user`;
CREATE TABLE `t_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_role_user
-- ----------------------------
INSERT INTO `t_role_user` VALUES ('2', '2');

-- ----------------------------
-- Table structure for `t_rotator`
-- ----------------------------
DROP TABLE IF EXISTS `t_rotator`;
CREATE TABLE `t_rotator` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(32) NOT NULL,
  `sort` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `label` varchar(32) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_rotator
-- ----------------------------
INSERT INTO `t_rotator` VALUES ('1', '5288ce7024ca5.jpg', '0', '11', '童装', '测试图片');
INSERT INTO `t_rotator` VALUES ('2', '5288cf1905368.jpg', '0', '10', '男装', '测试图片');
INSERT INTO `t_rotator` VALUES ('3', '5288cf2ebcddc.jpg', '0', '10', '女装', '测试女装');
INSERT INTO `t_rotator` VALUES ('4', '5288e713944e3.jpg', '0', '9', '休闲装', '休闲生活');

-- ----------------------------
-- Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `password` char(32) NOT NULL,
  `bind_account` varchar(50) DEFAULT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) unsigned DEFAULT NULL,
  `update_time` int(11) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `type_id` tinyint(2) unsigned DEFAULT '0',
  `info` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES ('1', 'admin', null, '21232f297a57a5a743894a0e4a801fc3', null, '0', null, '0', null, null, null, '1383048792', null, '1', '0', null);
INSERT INTO `t_user` VALUES ('2', 'hufa', null, '7428e79afacc40c2c5f798977da26e7b', null, '0', null, '0', null, null, null, '1383049904', null, '1', '0', null);
