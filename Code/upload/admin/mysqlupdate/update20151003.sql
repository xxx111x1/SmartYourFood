CREATE TABLE IF NOT EXISTS `oc_shipping_address_history` (
  `customer_id` int(11) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(17,14) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `phone` int(10) NOT NULL,
  `date_updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;