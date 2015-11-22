CREATE TABLE `oc_food_tag_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `food_name_cn` varchar(45) NOT NULL,
  `food_name_en` varchar(45) DEFAULT NULL,
  `tag_id` int(11) NOT NULL,
  `is_special` int(11) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `rest_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `rest_name_cn` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE `smartyourfood`.`oc_food_tag` (
  `tag_id` INT NOT NULL COMMENT '',
  `tag_name_cn` NVARCHAR(45) NULL COMMENT '',
  `tag_name_en` VARCHAR(50) NULL COMMENT '',
  PRIMARY KEY (`tag_id`)  COMMENT '');
