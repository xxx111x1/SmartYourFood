CREATE TABLE IF NOT EXISTS `oc_restaurant_reviews` (
  `review_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '',
  `restaurant_id` INT(11) NOT NULL COMMENT '',
  `overall_score` INT(2) NULL DEFAULT 4 COMMENT '',
  `taste_score` INT(2) NULL DEFAULT 4 COMMENT '',
  `service_score` INT(2) NULL DEFAULT 4 COMMENT '',
  `comment` NVARCHAR(2000) NULL COMMENT '',
  `date_added` DATETIME NULL COMMENT '',
  `available` INT(1) NULL DEFAULT 1 COMMENT '',
  `customer_id` INT(11) NOT NULL COMMENT '',
  PRIMARY KEY (`review_id`)  COMMENT '');