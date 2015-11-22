CREATE TABLE IF NOT EXISTS oc_rest_opening_times(
  schedule_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  rest_id int(11),
  week_day int(8),
  open_hour int(8),
  close_hour int(8)
);

 LOAD DATA INFILE 'open_hours.csv' INTO TABLE  oc_restaurant_info CHARACTER SET utf8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' lines terminated by '\n';
