/*
Navicat MySQL Data Transfer

Source Server         : 09-61.19.22.165-เนินมะปราง
Source Server Version : 50542
Source Host           : 61.19.22.165:3306
Source Database       : dhdc

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-12-22 23:07:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tst_cgroup
-- ----------------------------
DROP TABLE IF EXISTS `tst_cgroup`;
CREATE TABLE `tst_cgroup` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `note1` varchar(255) DEFAULT NULL,
  `note2` varchar(255) DEFAULT NULL,
  `note3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tst_cgroup
-- ----------------------------
INSERT INTO `tst_cgroup` VALUES ('1', 'หญิงตั้งครรภ์', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('2', 'หญิงหลังคลอด', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('3', 'เด็กอายุ 5 เดือน 29วัน', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('4', 'เด็กอายุ 4 เดือน', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('5', 'เด็กอายุ0-5ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('6', 'เด็กอายุ0-7ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('7', 'เด็กอายุครบ 1 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('8', 'เด็กอายุครบ 2 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('9', 'เด็กอายุครบ 3 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('10', 'เด็กอายุครบ 5 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('11', 'เด็กนักเรียน', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('12', 'เด็ก ป.1(6ปี)', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('13', 'เด็ก ป.2', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('14', 'เด็ก ป.6', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('15', 'เด็กอายุ 6-12 ปี (ป.1-ป.6)', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('16', 'เด็กกลุ่มอายุ0-12ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('17', 'เด็ก 6 - 18 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('18', 'หญิงอายุ15-19ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('19', 'หญิงอายุน้อยกว่า 20 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('20', 'สตรี 30-60 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('21', 'สตรีอายุ 30–70 ปี', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('22', 'อายุ 35 ปี ขึ้นไป', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('23', 'ผู้ป่วยโรคซึมเศร้า/โรคจิต', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('24', 'ผู้ป่วยเบาหวาน', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('25', 'ผู้ป่วยความดันโลหิตสูง', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('26', 'ผู้ป่วยเบาหวานความดันโลหิตสูง', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('27', 'ผู้สูงอายุ', null, null, null);
INSERT INTO `tst_cgroup` VALUES ('28', 'ผู้พิการ', null, null, null);
