/*
 Navicat Premium Data Transfer

 Source Server         : 1234
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : shop2

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 28/07/2023 16:17:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_code_rewards
-- ----------------------------
DROP TABLE IF EXISTS `tbl_code_rewards`;
CREATE TABLE `tbl_code_rewards`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `reward_id` int NOT NULL,
  `code` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timeadd` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_code_rewards
-- ----------------------------
INSERT INTO `tbl_code_rewards` VALUES (7, 5, 'fffff', 1687376312, 1);
INSERT INTO `tbl_code_rewards` VALUES (8, 5, 'aaaa', 1687376312, 1);
INSERT INTO `tbl_code_rewards` VALUES (9, 5, 'aaaa', 1687376312, 1);

-- ----------------------------
-- Table structure for tbl_game
-- ----------------------------
DROP TABLE IF EXISTS `tbl_game`;
CREATE TABLE `tbl_game`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `typegame` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `platform` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_game
-- ----------------------------
INSERT INTO `tbl_game` VALUES (1, 'idgame', 'Valorant', 'volorant.png', 'Steam', 1);
INSERT INTO `tbl_game` VALUES (2, 'idgame', 'Pubg', 'pubg.png', 'Steam', 1);
INSERT INTO `tbl_game` VALUES (8, 'idgame', 'Rov', 'rov.png', 'Mobile', 1);
INSERT INTO `tbl_game` VALUES (9, 'idgame', 'Steam', 'Steam_icon_logo.png', 'Steam', 1);
INSERT INTO `tbl_game` VALUES (14, 'account', 'Netflix', 'Netflix_icon.png', 'Steaming', 1);
INSERT INTO `tbl_game` VALUES (16, 'account', 'Youtube', '3938037.png', 'Steamimg', 1);

-- ----------------------------
-- Table structure for tbl_history_api
-- ----------------------------
DROP TABLE IF EXISTS `tbl_history_api`;
CREATE TABLE `tbl_history_api`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `info` varchar(9999) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timeadd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_history_api
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_history_rewards
-- ----------------------------
DROP TABLE IF EXISTS `tbl_history_rewards`;
CREATE TABLE `tbl_history_rewards`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `game` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timeadd` int NOT NULL,
  `status` int NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_history_rewards
-- ----------------------------
INSERT INTO `tbl_history_rewards` VALUES (10, 'บัตร Truemoney 50 บาท', 'spin', '123123123123', 1687430127, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (11, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1687430138, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (12, '5 - 10 เครดิต', 'spin', '8 เครดิต', 1687430182, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (13, 'ไม่ได้รับรางวัล', 'spin', 'ไม่ได้รับรางวัล', 1687430218, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (22, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1687443846, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (23, 'Steam Wallet 1,000 บาท', 'roller', 'testesstse', 1687443998, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (24, 'Steam Wallet 1,000 บาท', 'roller', 'Gif Code หมดติดต่อ แอดมิน!!', 1687444015, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (25, '5-10 เครดิต', 'roller', '10 เครดิต', 1687444050, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (26, '5-10 เครดิต', 'roller', '10 เครดิต', 1687444066, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (27, '5-10 เครดิต', 'roller', '5 เครดิต', 1687444079, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (28, '5-10 เครดิต', 'roller', '5 เครดิต', 1687454157, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (29, '5-10 เครดิต', 'roller', '7 เครดิต', 1687454168, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (37, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687457170, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (38, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687457249, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (39, 'บัตร Truemoney 1,000 บาท', 'slot', 'aaabbbccc', 1687457259, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (40, '5-10 เครดิต', 'roller', '10 เครดิต', 1687457852, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (41, '5-10 เครดิต', 'roller', '9 เครดิต', 1687457862, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (42, 'บัตร Truemoney 1,000 บาท', 'spin', 'aaaaabbbbbcccccc', 1687457895, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (43, '5-10 เครดิต', 'roller', '7 เครดิต', 1687457912, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (44, 'บัตร Truemoney 1,000 บาท', 'slot', 'Gif Code หมดติดต่อ แอดมิน!!', 1687457929, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (45, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687457999, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (46, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687458060, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (47, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687458068, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (48, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687458078, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (49, 'บัตร Truemoney 50 บาท', 'spin', 'truecode50', 1687464275, 1, 'user2');
INSERT INTO `tbl_history_rewards` VALUES (50, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1687464294, 1, 'user2');
INSERT INTO `tbl_history_rewards` VALUES (51, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687464306, 1, 'user2');
INSERT INTO `tbl_history_rewards` VALUES (52, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1687464403, 1, 'user2');
INSERT INTO `tbl_history_rewards` VALUES (53, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1688977789, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (54, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1688977810, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (55, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1688977829, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (56, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1688977839, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (57, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1688977860, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (58, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1688977886, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (59, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1688977893, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (60, '5 - 10 เครดิต', 'slot', '6 เครดิต', 1688977900, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (61, '5 - 10 เครดิต', 'slot', '7 เครดิต', 1688977907, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (62, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1688977935, 1, 'kuy99');
INSERT INTO `tbl_history_rewards` VALUES (63, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689383326, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (64, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1689383349, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (65, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1689383373, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (66, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689383427, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (67, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689383438, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (68, 'บัตร Truemoney 50 บาท', 'spin', 'Gif Code หมดติดต่อ แอดมิน!!', 1689840228, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (69, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1689840250, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (70, 'ไม่ได้รับรางวัล', 'roller', 'ไม่ได้รับรางวัล', 1689840262, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (71, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1689840291, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (72, 'ไม่ได้รับรางวัล', 'slot', 'ไม่ได้รับรางวัล', 1689840298, 1, 'admin');
INSERT INTO `tbl_history_rewards` VALUES (73, '5 - 10 เครดิต', 'slot', '7 เครดิต', 1689840305, 1, 'admin');

-- ----------------------------
-- Table structure for tbl_item_rewards
-- ----------------------------
DROP TABLE IF EXISTS `tbl_item_rewards`;
CREATE TABLE `tbl_item_rewards`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` int NOT NULL,
  `game` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `percent` int NOT NULL,
  `color` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_item_rewards
-- ----------------------------
INSERT INTO `tbl_item_rewards` VALUES (1, 2, 'spin', '10 - 20 เครดิต', '10|20', 'assets/img/rewards_icon/10-20.png', 0, '#2d8791', 1);
INSERT INTO `tbl_item_rewards` VALUES (2, 3, 'spin', 'บัตร Truemoney 50 บาท', '', 'assets/img/rewards_icon/true50.png', 100, '#2d8791', 1);
INSERT INTO `tbl_item_rewards` VALUES (3, 3, 'spin', 'บัตร Truemoney 1,000 บาท', '', 'assets/img/rewards_icon/true1000.png', 0, '#2d8791', 1);
INSERT INTO `tbl_item_rewards` VALUES (4, 1, 'spin', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 0, '#546e7a', 1);
INSERT INTO `tbl_item_rewards` VALUES (5, 3, 'spin', 'บัตร Truemoney 90 บาท', '', 'assets/img/rewards_icon/true90.png', 0, '#2d8791', 1);
INSERT INTO `tbl_item_rewards` VALUES (6, 2, 'spin', '5 - 10 เครดิต', '5|10', 'assets/img/rewards_icon/5-10c.png', 0, '#2d8791', 1);
INSERT INTO `tbl_item_rewards` VALUES (7, 1, 'spin', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 0, '#546e7a', 1);
INSERT INTO `tbl_item_rewards` VALUES (8, 3, 'slot', 'Steam Wallet 50 บาท', '', 'assets/img/rewards_icon/s50.png', 0, '#808080', 1);
INSERT INTO `tbl_item_rewards` VALUES (26, 1, 'roller', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 100, '#2d8791', 1);
INSERT INTO `tbl_item_rewards` VALUES (27, 3, 'roller', 'Steam Wallet 1,000 บาท', '', 'assets/img/rewards_icon/s1000.png', 0, '#fe3939', 1);
INSERT INTO `tbl_item_rewards` VALUES (28, 2, 'roller', '5-10 เครดิต', '5|10', 'assets/img/rewards_icon/5-10c.png', 0, '#332c90', 1);
INSERT INTO `tbl_item_rewards` VALUES (29, 3, 'slot', 'Steam Wallet 100 บาท', '', 'assets/img/rewards_icon/s100.png', 0, '#8f8f8f', 1);
INSERT INTO `tbl_item_rewards` VALUES (30, 3, 'slot', 'Steam Wallet 1,000 บาท', '', 'assets/img/rewards_icon/s1000.png', 0, '#9c1111', 1);
INSERT INTO `tbl_item_rewards` VALUES (31, 3, 'slot', 'บัตร Truemoney 50 บาท', '', 'assets/img/rewards_icon/true50.png', 0, '#3e8a38', 1);
INSERT INTO `tbl_item_rewards` VALUES (32, 3, 'slot', 'บัตร Truemoney 90 บาท', '', 'assets/img/rewards_icon/true90.png', 0, '#d19329', 1);
INSERT INTO `tbl_item_rewards` VALUES (33, 1, 'slot', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 50, '#5e5e5e', 1);
INSERT INTO `tbl_item_rewards` VALUES (34, 2, 'slot', '5 - 10 เครดิต', '5|10', 'assets/img/rewards_icon/5-10c.png', 97, '#cc286a', 1);
INSERT INTO `tbl_item_rewards` VALUES (35, 3, 'slot', 'บัตร Truemoney 300 บาท', '', 'assets/img/rewards_icon/true300.png', 0, '#f38a35', 1);
INSERT INTO `tbl_item_rewards` VALUES (36, 3, 'slot', 'บัตร Truemoney 1,000 บาท', '', 'assets/img/rewards_icon/true1000.png', 0, '#ff2929', 1);
INSERT INTO `tbl_item_rewards` VALUES (37, 1, 'slot', 'ไม่ได้รับรางวัล', '', 'assets/img/rewards_icon/noc-1.png', 53, '#363636', 1);

-- ----------------------------
-- Table structure for tbl_setting
-- ----------------------------
DROP TABLE IF EXISTS `tbl_setting`;
CREATE TABLE `tbl_setting`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `web_img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_version` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_wallet` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_fb` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_discord` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_youtube` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_status` int NOT NULL,
  `point_spin` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `point_roller` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `point_slot` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `menu_color` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `web_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_setting
-- ----------------------------
INSERT INTO `tbl_setting` VALUES (1, 'assets/img/logo_shop.png', 'P\'tung-Shop', '1.0.0', '0647024408', 'https://www.facebook.com/tem.channarong', 'https://discord.gg/AaqMmsx87g', 'https://www.youtube.com/channel/UCZlVxZiFXnH-xJmVe2HW8TA', 1, '10', '10', '10', '#6a6868', '#000000', 'TH SHOP | ขายทุกอย่าง');

-- ----------------------------
-- Table structure for tbl_shop_history
-- ----------------------------
DROP TABLE IF EXISTS `tbl_shop_history`;
CREATE TABLE `tbl_shop_history`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `secret_info` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timeadd` int NOT NULL,
  `point` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `gameid` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_shop_history
-- ----------------------------
INSERT INTO `tbl_shop_history` VALUES (15, '0aFFSOR8djx8dw==', 1687618359, '50', 'admin', 34, 1);
INSERT INTO `tbl_shop_history` VALUES (16, '0aFFSOR3dT11ck//NiRFG28tqaUKXFZ9OvmpEBIZhHqt/sxKZI9OB7Q=', 1687618672, '100', 'admin', 26, 1);
INSERT INTO `tbl_shop_history` VALUES (22, '0aRJQOsnJm8ueUz+MXQTRQ==', 1687652475, '50', 'user1', 35, 1);

-- ----------------------------
-- Table structure for tbl_shop_id
-- ----------------------------
DROP TABLE IF EXISTS `tbl_shop_id`;
CREATE TABLE `tbl_shop_id`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `gameid` int NOT NULL,
  `shoptype` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `img` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `point` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pointv` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timeadd` int NOT NULL,
  `status` int NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `count` int NOT NULL,
  `top` int NOT NULL,
  `secret_info` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `publish_info` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `owner` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_shop_id
-- ----------------------------
INSERT INTO `tbl_shop_id` VALUES (9, 21, 'idgame1', 'shop11', 'assets/img/shop/FEoJ8QCVUAol4u7.jpg,assets/img/shop/2.png,assets/img/shop/3.png1', '12001', '100', 1686499521, 1, 'admin1', 1, 1, '0aFFSOR3dT11ck//NiRFG28tqaUKXFZ9OvmpEBIZhHqt/sxKZI9OB7Q=', '8 สาวว ตัวตึงแห่ง ROV การีน่าสะอาดไม่ติดอ่ะไรเลยโครตคุ้ม บอกเลย รูนเพียบ บัตรเปลี่ยนชื่อพร้อมมากๆ เงินเหลืออีก 60k เศษรูนอีกเพียบ1', '');
INSERT INTO `tbl_shop_id` VALUES (10, 2, 'idgame', 'shop1', 'assets/img/shop/186118661_152570150169562_1955497902700140264_n.jpg,assets/img/shop/186476218_152611883498722_4227498950525439665_n.jpg,assets/img/shop/321200612_2957691344526982_6850794933529747053_n.jpg', '800', '100', 1687641741, 1, 'admin', 0, 0, '0aRJQOsnJWwtIQ==', '<p>สินค้ารายการที่ 570 | Vandal Reaver + Phantom Oni + Op Ion BTP2,5MAX + ของแยกตามภาพเลยงับ</p><p>⚡⚡⚡ ราคา 1600 บาทค่าา ถูกไป แพงไป มาคุยกันได้ค่า (รับผ่อน)⚡</p><p>━━━━━━━━━━━━━━━━━</p><p>⚡รายละเอียดของสินค้า</p><p>⚡ชื่อ : เปลี่ยนได้เลย</p><p>????เเรงค์ : Silver3</p><p>⚡⚡Battle Pass : BTP2,5(Max)</p><p>♟Agents : ครบ| 6 (Max)</p><p>⚡⚡V Point : 295</p><p>????R Point : 145</p><p>━━━━━━━━━━━━━━━━━</p><p>????????Skins⚡⚡⚡✝⚡⚡⚡</p><p>⚡Melee : Forsaken⚡⚡, Luxe, BTP2, BTP5</p><p>⚡Phantom : Oni????</p><p>⚡Vandal : Reaver????????</p><p>⚡Operator : Ion⚡⚡</p><p><br></p><p>✅ รายละเอียดเพิ่มเติม IB สอบถามได้เลยนะคะ</p><p>✅ ราคาคุ้ม ๆ ยินดีกลางนะคะ</p><p>━━━━━━━━━━━━━━━━━</p><p>⚡⚡ ช่องทางการชำระเงิน</p><p>⚡⚡ บัญชีธนาคาร, พร้อมเพย์ (ไม่มีค่าธรรมเนียม)</p><p>???? True Wallet (ค่าธรรมเนียม +15 บาท) ⚡</p><p>⚡⚡กรณีโดนแบนจากโปรแกรมช่วยเล่น จะไม่คืนมัดจำหรือค่าเสียหายใดๆ ทั้งสิ้น⚡⚡</p>', '');
INSERT INTO `tbl_shop_id` VALUES (11, 8, 'idgame', 'shop1', 'assets/img/shop/FEoJ7_7VQAA7aZ6.jpg,assets/img/shop/FEoJ8FVVIAAXZNC.jpg,assets/img/shop/FEoJ8KXVEAIy0Mq.jpg,assets/img/shop/FEoJ8QCVUAol4u7.jpg', '40', '100', 1686504663, 1, 'admin', 0, 0, '0aFFSOR3dT11ck//NiRFG28tqaUKXFZ9OvmpEBIZhHqt/sxKZI9OB7Q=', '<p>ขายไอดี ROV 300฿ ✅สะอาดล็อกอินการีน่าฮะ ✅ แรงค์คอม3 มีบัตรเปลี่ยนชื่อพร้อมเบย #ขายรหัสrov #ขายไอดีrov #ขายไอดีเกม #rov #rovth #การีน่า #RoVi #ขายรหัสเกม<br></p>', '');
INSERT INTO `tbl_shop_id` VALUES (16, 1, 'idgame', 'shop1', 'assets/img/shop/185984687_152571886836055_3814997202927593654_n.jpg,assets/img/shop/186118661_152570150169562_1955497902700140264_n.jpg,assets/img/shop/186476218_152611883498722_4227498950525439665_n.jpg', '1222', '100', 1686511328, 1, 'admin', 0, 1, '0aRJQOsnJWwtIQ==', '&lt;p&gt;สินค้ารายการที่ 570 | Vandal Reaver + Phantom Oni + Op Ion BTP2,5MAX + ของแยกตามภาพเลยงับ&lt;/p&gt;&lt;p&gt;ราคา 1600 บาทค่าา ถูกไป แพงไป มาคุยกันได้ค่า (รับผ่อน)&lt;/p&gt;', '');
INSERT INTO `tbl_shop_id` VALUES (17, 1, 'idgame', 'shop1', 'assets/img/shop/185984687_152571886836055_3814997202927593654_n.jpg,assets/img/shop/186118661_152570150169562_1955497902700140264_n.jpg,assets/img/shop/186476218_152611883498722_4227498950525439665_n.jpg', '111', '100', 1686511368, 1, 'admin', 0, 1, '0aRJQOsnJWwtIQ==', '&lt;p&gt;สินค้ารายการที่ 570 | Vandal Reaver + Phantom Oni + Op Ion BTP2,5MAX + ของแยกตามภาพเลยงับ&lt;/p&gt;&lt;p&gt;ราคา 1600 บาทค่าา ถูกไป แพงไป มาคุยกันได้ค่า (รับผ่อน)&lt;/p&gt;&lt;p&gt;&amp;lt;script&amp;gt;&lt;/p&gt;&lt;p&gt;&amp;nbsp; alert(&quot;Hello! I am an alert box!&quot;);&lt;/p&gt;&lt;p&gt;&amp;lt;/script&amp;gt;&lt;/p&gt;', '');
INSERT INTO `tbl_shop_id` VALUES (19, 2, 'idgame', 'shop1', 'assets/img/shop/119769808_676114446331974_7478211223711704283_n.jpg', '5000', '100', 1687648799, 1, 'admin', 0, 1, '0adLRbAnJW1+cU74', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px !important;\">BP : 5,201 G : 880<br style=\"outline: 0px !important;\">น้ำแข็ง7 fool7 กอส7 กระดูก7 ปืนอัพรวม10กระบอก มัมมี่ หมวกหนาม Re2 ของแรร์เพียบ<br style=\"outline: 0px !important;\"></p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; outline: 0px !important;\">การผูกมัด : เชื่อมต่อเฟสบุ๊ค (ไอดียกเมล์พร้อมเล่น)<br style=\"outline: 0px !important;\">ความปลอดภัย : รับประกันการดึงคืนตลอดชีพ<br style=\"outline: 0px !important;\">สถานะ : รหัสตรวจสอบเรียบร้อย<br style=\"outline: 0px !important;\">การรับประกัน : รับประกันการดึงคืนตลอดชีพ</p>', '');
INSERT INTO `tbl_shop_id` VALUES (21, 9, 'idgame', 'shop1', 'assets/img/shop/321200612_2957691344526982_6850794933529747053_n.jpg,assets/img/shop/321239163_645914603887722_5282100605226886785_n.jpg,assets/img/shop/321242740_1202869817250102_1072404372711344790_n.jpg', '500', '100', 1686550278, 1, 'admin', 0, 0, '0adLRbAnJW1+cU74', '&lt;p&gt;สินค้ารายการที่ 570 | Vandal Reaver + Phantom Oni + Op Ion BTP2,5MAX + ของแยกตามภาพเลยงับ&lt;/p&gt;&lt;p&gt;ราคา 1600 บาทค่าา ถูกไป แพงไป มาคุยกันได้ค่า (รับผ่อน)&lt;/p&gt;&lt;p&gt;ปล่อยเช่า ID-133 สถานะ:&amp;nbsp; ✅ ว่าง ✅&amp;nbsp;&lt;/p&gt;&lt;p&gt;ราคาในการเช่า&lt;/p&gt;&lt;p&gt;+&amp;nbsp; 7วัน 50 บาท&lt;/p&gt;&lt;p&gt;+&amp;nbsp; 30วัน 150 บาท&amp;nbsp;&lt;/p&gt;&lt;p&gt;+&amp;nbsp; ออนไลบางเกมเล่นไม่ได้&lt;/p&gt;', '');
INSERT INTO `tbl_shop_id` VALUES (26, 9, 'idgame', 'shop1', 'assets/img/shop/321239163_645914603887722_5282100605226886785_n.jpg', '100', '100', 1687423148, 2, 'admin', 0, 0, '0aFFSOR3dT11ck//NiRFG28tqaUKXFZ9OvmpEBIZhHqt/sxKZI9OB7Q=', '&lt;p&gt;test&lt;/p&gt;', 'admin');
INSERT INTO `tbl_shop_id` VALUES (27, 1, 'idgame', 'shop11', 'assets/img/shop/119769808_676114446331974_7478211223711704283_n.jpg', '100', '100', 1687424646, 2, 'admin', 0, 0, '0adLRbAnJW1+cU74', '&lt;p&gt;test sss&lt;/p&gt;', 'admin');
INSERT INTO `tbl_shop_id` VALUES (34, 14, 'account', 'บัญชี Netflix', 'assets/img/shop/Netflix-เน็ตฟลิกซ์-728x485.jpg,assets/img/shop/Netflix.jpg,assets/img/shop/1682416661.jpg', '50', '100', 1687641999, 1, 'admin', 0, 1, '', '<p>บัญชี Netflix<br></p>', '');
INSERT INTO `tbl_shop_id` VALUES (35, 16, 'account', 'บัญชี Youtube', 'assets/img/shop/Youtube-Premium-flashfly.jpg,assets/img/shop/youtube-premium.jpg,assets/img/shop/ScreenHunter_05-Nov.-06-10.09.jpg', '100', '50', 1687652382, 1, 'admin', 0, 1, '', '<p>บัญชี Youtube<br></p>', '');
INSERT INTO `tbl_shop_id` VALUES (36, 14, 'account', 'บัญชี Netflix Test 1', 'assets/img/shop/Youtube-Premium-flashfly.jpg,assets/img/shop/ScreenHunter_05-Nov.-06-10.09.jpg,assets/img/shop/youtube-premium.jpg', '100', '50', 1687651744, 1, 'admin', 0, 0, '0aRJQOsnJWwtIQ==', '<p>บัญชี Netflix Test 1</p>', '');

-- ----------------------------
-- Table structure for tbl_shop_stock
-- ----------------------------
DROP TABLE IF EXISTS `tbl_shop_stock`;
CREATE TABLE `tbl_shop_stock`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `shopid` int NOT NULL,
  `account` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `time` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_shop_stock
-- ----------------------------
INSERT INTO `tbl_shop_stock` VALUES (9, 34, 'xbZNU7B3dT17', 1687613180, 1);
INSERT INTO `tbl_shop_stock` VALUES (10, 34, '0aRJQOsnJm8uIhyt', 1687613188, 1);
INSERT INTO `tbl_shop_stock` VALUES (11, 34, '0qdKQ+gkJWwtIR+u', 1687613188, 1);
INSERT INTO `tbl_shop_stock` VALUES (12, 34, '0aFFSOR8djx8d0z+MXQ=', 1687613245, 1);
INSERT INTO `tbl_shop_stock` VALUES (13, 34, '0aFFSOR8djx8d0z+MXQ=', 1687613245, 1);
INSERT INTO `tbl_shop_stock` VALUES (14, 34, '0aFFSOR8djx8d0z+MXQ=', 1687613245, 1);
INSERT INTO `tbl_shop_stock` VALUES (15, 34, '0aFFSOR8djx8d0z+MXQ=', 1687613245, 1);
INSERT INTO `tbl_shop_stock` VALUES (16, 34, '0aFFSOR8djx8d0z+MXQ=', 1687613245, 1);
INSERT INTO `tbl_shop_stock` VALUES (23, 35, '0aRJQOsnJm8ueUz+MXQTRQ==', 1687652269, 1);
INSERT INTO `tbl_shop_stock` VALUES (24, 35, '0qdKQ+gkJWwteUz+MXQTRQ==', 1687652269, 1);

-- ----------------------------
-- Table structure for tbl_shop_stock_api
-- ----------------------------
DROP TABLE IF EXISTS `tbl_shop_stock_api`;
CREATE TABLE `tbl_shop_stock_api`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `price_web` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `up` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `showitem` int NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_shop_stock_api
-- ----------------------------
INSERT INTO `tbl_shop_stock_api` VALUES (1, '1', 'Netflix 4K /30วัน (จอส่วนตัว)', '90.00', '120.00', 'https://byshop.me/api/img/app/netflix.png', '37', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (2, '2', 'Netflix 4K /7วัน (จอส่วนตัว)', '25.00', '35.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (3, '3', 'Netflix 4K /30วัน (จอแชร์)', '69.00', '89.00', 'https://byshop.me/api/img/app/netflix.png', '26', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (4, '4', 'Netflix 4K /7วัน (จอแชร์)', '15.00', '25.00', 'https://byshop.me/api/img/app/netflix.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (5, '5', 'Disney+ /30วัน (จอส่วนตัว)', '79.00', '89.00', 'https://byshop.me/api/img/app/Disney.png', '10', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (6, '6', 'Youtube Premium/30วัน (เมลร้าน)', '10.00', '20.00', 'https://byshop.me/api/img/app/yt.png', '5', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (7, '7', 'Youtube Premium/30วัน (เมลตัวเอง)', '10.00', '29.00', 'https://byshop.me/api/img/app/yt.png', '45', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (8, '8', 'Youtube Premium/1ปี (เมลตัวเอง)', '450.00', '590.00', 'https://byshop.me/api/img/app/yt.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (9, '9', 'MONOMAX/30วัน (จอส่วนตัว)', '35.00', '49.00', 'https://byshop.me/api/img/app/monomax.png', '6', 'พร้อมส่ง', '', 0);
INSERT INTO `tbl_shop_stock_api` VALUES (10, '10', 'MONOMAX/30วัน (จอแชร์)', '25.00', '39.00', 'https://byshop.me/api/img/app/monomax.png', '7', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (11, '11', 'HBO GO/30วัน', '45.00', '59.00', 'https://byshop.me/api/img/app/hbo.png', '20', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (12, '12', 'VIU Premium/30วัน (หาร3)', '10.00', '29.00', 'https://byshop.me/api/img/app/viu.png', '11', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (13, '13', 'iQIYI GOLD /30วัน', '22.00', '29.00', 'https://byshop.me/api/img/app/iq.png', '21', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (14, '14', 'WeTV VIP /30วัน', '20.00', '29.00', 'https://byshop.me/api/img/app/wetv.png', '26', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (15, '15', 'Amazon Prime Video/30วัน', '45.00', '59.00', 'https://byshop.me/api/img/app/pv.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (16, '16', 'Amazon Prime Video/7วัน', '10.00', '19.00', 'https://byshop.me/api/img/app/pv.png', '15', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (17, '17', 'Spotify Premium/30วัน(เมลร้าน)', '10.00', '29.00', 'https://byshop.me/api/img/app/sf.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (18, '18', 'TrueID+ /30วัน', '10.00', '29.00', 'https://byshop.me/api/img/app/trueid+.png', '3', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (19, '19', 'AIS Play Premium /30วัน', '10.00', '29.00', 'https://byshop.me/api/img/app/ais.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (20, '20', 'Bilibili /30วัน', '25.00', '29.00', 'https://byshop.me/api/img/app/bb.png', '6', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (21, '21', 'Netflix 4K /1วัน (จอส่วนตัว)', '7.00', '10.00', 'https://byshop.me/api/img/app/netflix.png', '16', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (22, '22', 'Netflix 4K /1วัน (จอแชร์)', '5.00', '7.00', 'https://byshop.me/api/img/app/netflix.png', '18', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (23, '23', 'Netflix 4K /30วัน (TV) (จอส่วนตัว)', '159.00', '179.00', 'https://byshop.me/api/img/app/netflix.png', '1', 'พร้อมส่ง', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (24, '24', 'VIU Premium/30วัน (หาร4)', '29.00', '29.00', 'https://byshop.me/api/img/app/viu.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (25, '25', 'BeinSports /30วัน', '10.00', '29.00', 'https://byshop.me/api/img/app/bs.png', '0', 'สินค้าหมด', '', 1);
INSERT INTO `tbl_shop_stock_api` VALUES (26, '26', 'CH3 Plus /30วัน', '10.00', '29.00', 'https://byshop.me/api/img/app/ch3.png', '0', 'สินค้าหมด', '', 1);

-- ----------------------------
-- Table structure for tbl_slide
-- ----------------------------
DROP TABLE IF EXISTS `tbl_slide`;
CREATE TABLE `tbl_slide`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `height` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_slide
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_topup
-- ----------------------------
DROP TABLE IF EXISTS `tbl_topup`;
CREATE TABLE `tbl_topup`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `topupby` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `topuptime` int NOT NULL,
  `point` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_topup
-- ----------------------------
INSERT INTO `tbl_topup` VALUES (1, 'Aungpao', 1683738752, '10.00', 1, 'admin');
INSERT INTO `tbl_topup` VALUES (2, 'Aungpao', 1683738752, '10.00', 1, 'admin');

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `point` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES (1, 'assets/img/web_logo.png', 'ad', 'ad', 'ad@ad.com', '1000', '192.168.1.112', 0);
INSERT INTO `tbl_users` VALUES (2, 'assets/img/anya.jpg', 'admin', 'bfd79593967766e0c768093f524a8449', 'admin@admin.com', '5057', '::1', 7);
INSERT INTO `tbl_users` VALUES (3, 'assets/img/anya.jpg', 'user1', '3f1ba46962fe9ee0282d733d46f6042b', 'user@gmail.com', '0', '::1', 5);
INSERT INTO `tbl_users` VALUES (4, 'assets/img/anya.jpg', 'user2', '3f1ba46962fe9ee0282d733d46f6042b', 'user2@gmail.com', '0', '::1', 1);
INSERT INTO `tbl_users` VALUES (5, 'assets/img/anya.jpg', 'kuy99', 'a7d8ef8a50ad3e77d632134f54dddefa', 'gweafwd@gmail.com', '9942', '158.108.230.22', 7);
INSERT INTO `tbl_users` VALUES (6, 'assets/img/anya.jpg', 'kuekew', '7d57fc2b9f41833c5ecbfa9290cda567', 'wdadw@gmail.com', '0', '2403:6200:88a4:e54b:2c21:3ab7:76', 1);
INSERT INTO `tbl_users` VALUES (7, 'assets/img/anya.jpg', 'atxdfun', '8e777aa7e3e7d5e14eb0f58236031ce2', 'Athichon@gg.hh', '0', '2a09:bac1:6f20:d58::23:31f', 1);
INSERT INTO `tbl_users` VALUES (8, 'assets/img/anya.jpg', 'cologamez', 'e12e76a46ba91581aba4df72bf06f272', 'cologamez@gmail.com', '0', '2405:9800:ba00:6e14:59:228f:2981', 1);
INSERT INTO `tbl_users` VALUES (9, 'assets/img/anya.jpg', 'test01', 'b6f460ac70c39feca188c33bdebb08c6', 'likeplusplus@gmail.com', '0', '2001:fb1:41:1cad:8420:b4:df99:ca', 1);
INSERT INTO `tbl_users` VALUES (10, 'assets/img/anya.jpg', 'Macer', '3f1ba46962fe9ee0282d733d46f6042b', 'maganmyame@gmail.com', '0', '58.136.178.29', 1);
INSERT INTO `tbl_users` VALUES (11, 'assets/img/anya.jpg', 'Test99', '673547bacf691514ad88480bb5206b93', 't.6627.727@2@2', '0', '2001:44c8:4162:5006:7534:b331:2f', 1);
INSERT INTO `tbl_users` VALUES (12, 'assets/img/anya.jpg', 'emilyTH', 'b61815ba5549632ab41730eb3f7b649c', 'fshsisis@gmail.con', '0', '110.49.4.25', 1);
INSERT INTO `tbl_users` VALUES (13, 'assets/img/anya.jpg', 't534tefcfsd', '828b98855aa8f2f9b014e275a30c2daf', 't534tefcfsd@gmail.com', '0', '2403:6200:8821:af1d:3510:d21d:40', 1);
INSERT INTO `tbl_users` VALUES (14, 'assets/img/anya.jpg', 'g43etgsefsdcs', '6a630b4117aac047134c77808ad5eccd', 'jythdgdds@gmail.com', '0', '2403:6200:8821:af1d:3510:d21d:40', 1);

SET FOREIGN_KEY_CHECKS = 1;
