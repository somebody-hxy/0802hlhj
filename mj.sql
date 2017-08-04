/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : mj

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-07-10 09:26:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `mj_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `mj_admin_user`;
CREATE TABLE `mj_admin_user` (
  `au_id` int(11) NOT NULL AUTO_INCREMENT,
  `au_phone` varchar(200) NOT NULL DEFAULT '',
  `au_pwd` varchar(200) NOT NULL DEFAULT '',
  `au_name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`au_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_admin_user
-- ----------------------------
INSERT INTO `mj_admin_user` VALUES ('1', '13664156808', '4297f44b13955235245b2497399d7a93', '刘金明');

-- ----------------------------
-- Table structure for `mj_lecturer`
-- ----------------------------
DROP TABLE IF EXISTS `mj_lecturer`;
CREATE TABLE `mj_lecturer` (
  `l_id` int(11) NOT NULL AUTO_INCREMENT,
  `l_name` varchar(200) NOT NULL DEFAULT '',
  `l_pic` varchar(200) NOT NULL DEFAULT '',
  `l_detail` text NOT NULL,
  `l_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常，1-删除',
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_lecturer
-- ----------------------------
INSERT INTO `mj_lecturer` VALUES ('1', '小黄人', '/Uploads/images/2017-07-06/595df35d61f4e.jpg', '<p>1111111111111111</p>', '0');
INSERT INTO `mj_lecturer` VALUES ('2', '钢铁侠', '/Uploads/images/2017-07-06/595df378788b6.jpg', '', '0');
INSERT INTO `mj_lecturer` VALUES ('3', '美国队长', '/Uploads/images/2017-07-06/595df38c6a071.jpg', '', '0');

-- ----------------------------
-- Table structure for `mj_member`
-- ----------------------------
DROP TABLE IF EXISTS `mj_member`;
CREATE TABLE `mj_member` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_openid` varchar(200) NOT NULL DEFAULT '',
  `m_nickname` varchar(200) NOT NULL DEFAULT '',
  `m_avatarurl` varchar(200) NOT NULL DEFAULT '',
  `m_phone` varchar(200) NOT NULL DEFAULT '',
  `m_truename` varchar(200) NOT NULL DEFAULT '',
  `m_type_id` int(11) NOT NULL DEFAULT '0',
  `m_stimes` int(11) NOT NULL DEFAULT '0',
  `m_etimes` int(11) NOT NULL DEFAULT '0',
  `m_addtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_member
-- ----------------------------
INSERT INTO `mj_member` VALUES ('1', 'o7dsK0a5SyIHJXshIb24kEXI6_ig', '徐如升', '', '23434', '123123', '3', '1499414928', '1530950928', '1499306799');
INSERT INTO `mj_member` VALUES ('2', 'o7dsK0ekFkHL_a8XqJg7UBUwB0S8', '六角铃铛', 'https://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKFq3L4kae4BSgwEj7Iaa0ibVcgLEyznCcteg6K3kdxck9RZpNh1VOdpD1L6Cdicnf2dMC5CxvxncPw/0', '', '', '0', '0', '0', '1499329160');

-- ----------------------------
-- Table structure for `mj_member_address`
-- ----------------------------
DROP TABLE IF EXISTS `mj_member_address`;
CREATE TABLE `mj_member_address` (
  `ma_id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_member_id` int(11) NOT NULL DEFAULT '0',
  `ma_phone` varchar(200) NOT NULL DEFAULT '',
  `ma_truename` varchar(200) NOT NULL DEFAULT '',
  `ma_detail` varchar(200) NOT NULL DEFAULT '',
  `ma_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常，1-默认',
  PRIMARY KEY (`ma_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_member_address
-- ----------------------------

-- ----------------------------
-- Table structure for `mj_member_type`
-- ----------------------------
DROP TABLE IF EXISTS `mj_member_type`;
CREATE TABLE `mj_member_type` (
  `mt_id` int(11) NOT NULL AUTO_INCREMENT,
  `mt_name` varchar(200) NOT NULL DEFAULT '' COMMENT '会员名称',
  `mt_day` int(11) NOT NULL DEFAULT '0' COMMENT '天数',
  `mt_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常，1-删除',
  PRIMARY KEY (`mt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_member_type
-- ----------------------------
INSERT INTO `mj_member_type` VALUES ('1', '包月会员', '31', '0');
INSERT INTO `mj_member_type` VALUES ('2', '季度会员', '93', '0');
INSERT INTO `mj_member_type` VALUES ('3', '包年会员', '365', '0');

-- ----------------------------
-- Table structure for `mj_video`
-- ----------------------------
DROP TABLE IF EXISTS `mj_video`;
CREATE TABLE `mj_video` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_type_id` int(11) NOT NULL,
  `v_lecturer_id` int(11) NOT NULL,
  `v_title` varchar(200) NOT NULL DEFAULT '',
  `v_pic` varchar(200) NOT NULL DEFAULT '',
  `v_video` varchar(200) NOT NULL DEFAULT '',
  `v_views` int(11) NOT NULL DEFAULT '0',
  `v_addtime` int(11) NOT NULL DEFAULT '0',
  `v_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常，1-删除',
  PRIMARY KEY (`v_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_video
-- ----------------------------
INSERT INTO `mj_video` VALUES ('1', '1', '3', '视频1', '/Uploads/images/2017-07-06/595dfeeae9c01.jpg', '/Uploads/video/2017-07-05/595c9cebef1f1.mp4', '0', '1499236437', '0');
INSERT INTO `mj_video` VALUES ('2', '1', '2', '视频2', '/Uploads/images/2017-07-06/595dfedec311d.jpg', '', '0', '1499332196', '0');
INSERT INTO `mj_video` VALUES ('3', '2', '1', '视频3', '/Uploads/images/2017-07-06/595dfed0e9742.jpg', '', '0', '1499332220', '0');
INSERT INTO `mj_video` VALUES ('4', '2', '2', '视频4', '/Uploads/images/2017-07-06/595dfec4a021b.jpg', '', '0', '1499332262', '0');
INSERT INTO `mj_video` VALUES ('5', '3', '3', '视频5', '/Uploads/images/2017-07-06/595dfeb7d906d.jpg', '', '0', '1499332281', '0');

-- ----------------------------
-- Table structure for `mj_video_type`
-- ----------------------------
DROP TABLE IF EXISTS `mj_video_type`;
CREATE TABLE `mj_video_type` (
  `vt_id` int(11) NOT NULL AUTO_INCREMENT,
  `vt_name` varchar(200) NOT NULL DEFAULT '',
  `vt_pic` varchar(200) NOT NULL DEFAULT '',
  `vt_del` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-正常，1-删除',
  PRIMARY KEY (`vt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mj_video_type
-- ----------------------------
INSERT INTO `mj_video_type` VALUES ('1', '美甲', '', '0');
INSERT INTO `mj_video_type` VALUES ('2', '纹绣', '', '0');
INSERT INTO `mj_video_type` VALUES ('3', '纹身', '', '0');
