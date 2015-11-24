drop table if EXISTS oc_rest_opening_times;
CREATE TABLE IF NOT EXISTS oc_rest_opening_times(
  schedule_id INT(11) PRIMARY KEY AUTO_INCREMENT,
  rest_id int(11),
  week_day int(8),
  open_hour FLOAT ,
  close_hour FLOAT
);

 LOAD DATA INFILE '/opt/release/SmartYourFood/Code/upload/admin/mysqlupdate/open_hours.csv' INTO TABLE  oc_restaurant_info CHARACTER SET utf8 FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' lines terminated by '\n';
insert into table oc_open_times values(26 ,7 ,0 ,24)