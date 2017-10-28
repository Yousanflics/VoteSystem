SET FOREIGN_KEY_CHECKS=0;


-- ----------------------------
-- Table structure for toggle
-- ----------------------------
DROP TABLE IF EXISTS `toggle`;
CREATE TABLE `toggle` (
  `toggle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of toggle
-- ----------------------------
INSERT INTO `toggle` VALUES ('1');

-- ----------------------------
-- Table structure for vote_person_info
-- ----------------------------
DROP TABLE IF EXISTS `vote_person_info`;
CREATE TABLE `vote_person_info` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_stu` varchar(20) NOT NULL,
  `vote_name` varchar(20) DEFAULT NULL,

  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8;

load data infile "C:\\wamp64\\tmp\\14.csv"
into table vote_person_info character set utf8 
fields terminated by ',' optionally enclosed by '"' escaped by '"'
lines terminated by '\r\n';



-- ----------------------------
-- Table structure for vote_record
-- ----------------------------
DROP TABLE IF EXISTS `vote_record`;
CREATE TABLE `vote_record` (
  `vote_id` int(11) NOT NULL AUTO_INCREMENT,
  `vote_name` varchar(200) DEFAULT NULL,
  `vote_num` varchar(200) DEFAULT NULL,
  `vote_record` varchar(500) DEFAULT NULL,
  `vote_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;



-- ----------------------------
-- Table structure for vote_tw
-- ----------------------------
DROP TABLE IF EXISTS `vote_tw`;
CREATE TABLE `vote_tw` (
  `v_id` int(11) NOT NULL AUTO_INCREMENT,
  `v_name` varchar(200) DEFAULT NULL,
  `v_score` int(11) DEFAULT '0',
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vote_tw
-- ----------------------------
INSERT INTO `vote_tw` VALUES ('1', '李长安', '0');
INSERT INTO `vote_tw` VALUES ('2', '朱宗敏', '0');
INSERT INTO `vote_tw` VALUES ('3', '龚一鸣', '0');
INSERT INTO `vote_tw` VALUES ('4', '刘明辉', '0');
INSERT INTO `vote_tw` VALUES ('5', '曹晓峰', '0');
INSERT INTO `vote_tw` VALUES ('6', '吴迪', '0');
INSERT INTO `vote_tw` VALUES ('7', '祁士华', '0');
INSERT INTO `vote_tw` VALUES ('8', '曾斌', '0');
INSERT INTO `vote_tw` VALUES ('9', '王晓梅', '0');
INSERT INTO `vote_tw` VALUES ('10', '唐朝晖', '0');
INSERT INTO `vote_tw` VALUES ('11', '陈丽霞', '0');
INSERT INTO `vote_tw` VALUES ('12', '唐启家', '0');
INSERT INTO `vote_tw` VALUES ('13', '孙启良', '0');
INSERT INTO `vote_tw` VALUES ('14', '杜学斌', '0');
INSERT INTO `vote_tw` VALUES ('15', '丁华锋', '0');
INSERT INTO `vote_tw` VALUES ('16', '郝国成', '0');
INSERT INTO `vote_tw` VALUES ('17', '王庆义', '0');
INSERT INTO `vote_tw` VALUES ('18', '谭文伦', '0');
INSERT INTO `vote_tw` VALUES ('19', '严良', '0');
INSERT INTO `vote_tw` VALUES ('20', '倪琳', '0');
INSERT INTO `vote_tw` VALUES ('21', '冯迪', '0');
INSERT INTO `vote_tw` VALUES ('22', '姚夏晶', '0');
INSERT INTO `vote_tw` VALUES ('23', '王红平', '0');
INSERT INTO `vote_tw` VALUES ('24', '武彦斌', '0');
INSERT INTO `vote_tw` VALUES ('25', '李星', '0');
INSERT INTO `vote_tw` VALUES ('26', '罗文强', '0');
INSERT INTO `vote_tw` VALUES ('27', '沈锡田', '0');
INSERT INTO `vote_tw` VALUES ('28', '高翠欣', '0');
INSERT INTO `vote_tw` VALUES ('29', '李晓玉', '0');
INSERT INTO `vote_tw` VALUES ('30', '周学武', '0');
INSERT INTO `vote_tw` VALUES ('31', '李欢欢', '0');
INSERT INTO `vote_tw` VALUES ('32', '张志庭', '0');
INSERT INTO `vote_tw` VALUES ('33', '李春卉', '0');
INSERT INTO `vote_tw` VALUES ('34', '邓焰峰', '0');
INSERT INTO `vote_tw` VALUES ('35', '宁薇', '0');
INSERT INTO `vote_tw` VALUES ('36', '吴颢', '0');
INSERT INTO `vote_tw` VALUES ('37', '严世雄', '0');
INSERT INTO `vote_tw` VALUES ('38', '侯志军', '0');
INSERT INTO `vote_tw` VALUES ('39', '曾希', '0');
INSERT INTO `vote_tw` VALUES ('40', '陈性义', '0');




