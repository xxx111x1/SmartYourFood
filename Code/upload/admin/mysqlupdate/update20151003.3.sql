CREATE TABLE IF NOT EXISTS `oc_shipping_address` (
  `address_id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(17,14) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;