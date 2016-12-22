/*
Navicat MySQL Data Transfer

Source Server         : 09-61.19.22.165-เนินมะปราง
Source Server Version : 50542
Source Host           : 61.19.22.165:3306
Source Database       : dhdc

Target Server Type    : MYSQL
Target Server Version : 50542
File Encoding         : 65001

Date: 2016-12-22 23:07:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tst_citems
-- ----------------------------
DROP TABLE IF EXISTS `tst_citems`;
CREATE TABLE `tst_citems` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `cgroup_id` int(11) DEFAULT NULL,
  `note1` varchar(255) DEFAULT NULL,
  `note2` varchar(244) DEFAULT NULL,
  `note3` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tst_citems
-- ----------------------------
INSERT INTO `tst_citems` VALUES ('1', 'ได้รับการฝากครรภ์ครั้งแรกภายใน 12 สัปดาห์', '1', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('2', 'ได้รับการฝากครรภ์ครบ 5 ครั้งตามเกณฑ์', '1', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('3', 'ได้รับยาเม็ดเสริมไอโอดีน', '1', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('4', 'วัคซีน', '1', '', null, null);
INSERT INTO `tst_citems` VALUES ('5', 'ภาวะโลหิตจาง', '1', '', '', null);
INSERT INTO `tst_citems` VALUES ('6', 'ได้รับการดูแลครบ 3 ครั้งตามเกณฑ์  ', '2', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('7', 'กินนมแม่อย่างเดียว', '3', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('8', 'ได้รับวัคซีน IPV', '4', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('9', 'มีพัฒนาการสมวัย', '5', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('10', 'สูงดีสมส่วนและส่วนสูงเฉลี่ยที่อายุ5ปี', '5', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('11', 'เด็กสงสัยพัฒนาการล่าช้าได้รับการตรวจกระตุ้นพัฒนาการ', '5', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('12', 'โภชนาการ', '5', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('13', 'วัคซีน', '6', '', null, null);
INSERT INTO `tst_citems` VALUES ('14', 'ที่ได้รับวัคซีน BCG+HBV1+DTP3-HBV3+OPV3+MMR1+ DTP4+OPV4', '7', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('15', 'ที่ได้รับวัคซีน DTP4,โปลิโอ4,JE', '8', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('16', 'ได้รับวัคซีน JE,MMR2', '9', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('17', 'ที่ได้รับวัคซีน DTP5,โปลิโอ5', '10', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('18', 'มีภาวะเริ่มอ้วนและอ้วน', '11', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('19', 'สูงดีสมส่วน', '11', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('20', 'ได้รับการตรวจสุขภาพช่องปาก ', '12', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('21', 'ได้รับการเคลือบหลุมร่องฟัน( ฟันแท้ )', '12', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('22', 'วัคซีน', '12', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('23', 'วัคซีน', '13', '', null, null);
INSERT INTO `tst_citems` VALUES ('24', 'วัคซีน', '14', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('25', 'ได้รับบริการทันตกรรม', '15', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('26', 'ฟันดีไม่มีผุ(cavityfree)', '16', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('27', 'โภชนาการ', '17', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('28', 'การตั้งครรภ์ซ้ำ', '18', '', null, null);
INSERT INTO `tst_citems` VALUES ('29', 'การตั้งครรภ์ซ้ำ', '19', '', null, null);
INSERT INTO `tst_citems` VALUES ('30', 'ได้ตรวจคัดกรองมะเร็งปากมดลูกใน ภายใน 5 ปี', '20', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('31', 'ได้รับการคัดกรองมะเร็งเต้านม', '21', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('32', 'ความชุกของภาวะอ้วน(BMI ≥ 25 กก/ม2 และหรือภาวะอ้วนลงพุง (รอบเอวเกิน ชาย 90 ซม. หญิง 80 ซม.)', '22', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('33', 'ได้รับการคัดกรองเบาหวาน', '22', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('34', 'ได้รับการคัดกรองความดันโลหิตสูง', '22', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('35', 'เข้าถึงบริการ', '23', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('36', 'รายใหม่', '24', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('37', 'ที่ควบคุมน้ำตาลได้', '24', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('38', 'ได้รับบริการทันตกรรม', '24', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('39', 'ตรวจเท้า', '24', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('40', 'ตรวจจอประสาทตา', '24', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('41', 'รายใหม่', '25', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('42', 'ที่ควบคุมความดันโลหิตได้', '25', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('43', 'ที่ขึ้นทะเบียนได้รับการประเมินโอกาสเสี่ยงต่อโรคหัวใจและหลอดเลือด(CVDRisk)', '26', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('44', 'การคัดกรอง ADL', '27', 'ok', null, null);
INSERT INTO `tst_citems` VALUES ('45', 'ดูแลระยะยาวในชุมชน(LongTermCare)ผ่านเกณฑ์', '27', '', null, null);
INSERT INTO `tst_citems` VALUES ('46', 'ดูแลระยะยาวในชุมชน(LongTermCare)ผ่านเกณฑ์', '28', '', null, null);
