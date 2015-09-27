CREATE TABLE `oc_address_search_history` (
  `customer_id` int(11) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(17,14) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
