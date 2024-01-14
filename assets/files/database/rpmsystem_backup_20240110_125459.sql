

CREATE TABLE `database_mgmt` (
  `database_id` int(11) NOT NULL AUTO_INCREMENT,
  `database_name` varchar(255) NOT NULL,
  `database_date` datetime NOT NULL,
  `database_status` varchar(255) NOT NULL,
  PRIMARY KEY (`database_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO database_mgmt VALUES("4","rpmsystem_backup_20240110_002356.sql","2024-01-10 12:23:56","Backup successful");



CREATE TABLE `password_reset_temp` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `key` text NOT NULL,
  `expDate` datetime NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `password_reset_temp_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO password_reset_temp VALUES("3","trestizarizamae@gmail.com","768e78024aa8fdb9b8fe87be86f64745a794e9a7d8","2023-12-13 16:30:48");



CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `utility_type_id` int(11) NOT NULL,
  `is_cash_advance` int(11) NOT NULL,
  `is_cash_deposit` int(11) NOT NULL,
  `payment_type_id` int(11) NOT NULL,
  `payment_amount` double(11,2) NOT NULL,
  `payment_remaining` double(11,2) NOT NULL,
  `payment_reference` varchar(255) NOT NULL,
  `payment_date` datetime NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_comment` varchar(250) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `user_id` (`user_id`),
  KEY `payment_type_id` (`payment_type_id`),
  KEY `utility_type_id` (`utility_type_id`) USING BTREE,
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`payment_type_id`) REFERENCES `payment_type` (`payment_type_id`),
  CONSTRAINT `payment_ibfk_4` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_type` (`utility_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO payment VALUES("1","5","1","0","0","1","3000.00","2000.00","","2023-12-11 01:59:05","Partial","","Active");
INSERT INTO payment VALUES("2","9","1","0","0","1","5000.00","0.00","","2023-12-11 10:05:34","Paid","","Archive");
INSERT INTO payment VALUES("3","9","2","0","0","1","250.00","750.00","","2023-12-11 02:26:28","Partial","","Active");
INSERT INTO payment VALUES("4","9","3","0","0","2","200.00","0.00","12345678","2023-12-11 02:29:19","Paid","","Active");
INSERT INTO payment VALUES("5","9","1","0","0","2","5000.00","0.00","87654321","2023-12-11 02:33:16","Paid","","Active");
INSERT INTO payment VALUES("6","11","1","0","0","1","500.00","4500.00","","2023-12-11 02:54:23","Partial","","Active");
INSERT INTO payment VALUES("7","12","1","0","0","2","8000.00","0.00","018736","2023-12-12 02:16:19","Partial","","Archive");
INSERT INTO payment VALUES("8","12","1","1","0","1","5000.00","0.00","","2023-12-12 02:38:37","","","Archive");
INSERT INTO payment VALUES("9","12","1","1","0","1","89500.00","-79000.00","","2023-12-12 02:40:10","Paid","","Active");



CREATE TABLE `payment_type` (
  `payment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(255) NOT NULL,
  `payment_type_status` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO payment_type VALUES("1","Cash","Active");
INSERT INTO payment_type VALUES("2","GCash","Active");



CREATE TABLE `property` (
  `property_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_unit_code` varchar(255) NOT NULL,
  `property_purok` varchar(255) NOT NULL,
  `property_barangay` varchar(255) NOT NULL,
  `property_city` varchar(255) NOT NULL,
  `property_zipcode` varchar(255) NOT NULL,
  `property_type_id` int(11) NOT NULL,
  `has_electrical_meter` varchar(255) NOT NULL,
  `has_water_meter` varchar(255) NOT NULL,
  `has_parking_space` varchar(255) NOT NULL,
  `has_conectivity` varchar(255) NOT NULL,
  `property_amount` double(11,2) NOT NULL,
  `property_status` varchar(255) NOT NULL,
  `p_status` varchar(255) NOT NULL,
  PRIMARY KEY (`property_id`),
  KEY `user_id` (`user_id`),
  KEY `property_type_id` (`property_type_id`),
  CONSTRAINT `property_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `property_ibfk_2` FOREIGN KEY (`property_type_id`) REFERENCES `property_type` (`property_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO property VALUES("1","6","Door 1 Green","Corrales","","","","1","","","","","5000.00","Archive","");
INSERT INTO property VALUES("2","2","Door 2 Black","Corrales","","","","1","","","","","5000.00","Reserve","");
INSERT INTO property VALUES("3","2","Door 3 Green","Corrales","","","","1","","","","","5000.00","Available","");
INSERT INTO property VALUES("4","3","Door 1 Grey","Butuay","","","","2","","","","","2500.00","Rented","");
INSERT INTO property VALUES("5","3","Door 2 Silver","Butuay","","","","2","","","","","2500.00","Renovating","");
INSERT INTO property VALUES("6","3","Door 3 Red","Corrales","","","","2","","","","","10500.00","Rented","");
INSERT INTO property VALUES("7","6","Door Blue","4","Mialem","Jimenez","7204","1","Yes","Yes","Yes","No","5000.00","Rented","Active");
INSERT INTO property VALUES("8","2","Door 3 Green","Corrales","","","","1","","","","","5000.00","Archive","");
INSERT INTO property VALUES("9","2","Door 1","Corrales","","","","1","","","","","5000.00","Rented","");



CREATE TABLE `property_type` (
  `property_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_type_name` varchar(255) NOT NULL,
  `property_type_status` varchar(255) NOT NULL,
  PRIMARY KEY (`property_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO property_type VALUES("1","Apartment","Active");
INSERT INTO property_type VALUES("2","Boarding House","Active");
INSERT INTO property_type VALUES("3","Residential Space","Active");
INSERT INTO property_type VALUES("4","asdasdsad","Active");



CREATE TABLE `rentee` (
  `rentee_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  PRIMARY KEY (`rentee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `valid_id` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_rented` int(11) NOT NULL,
  `balance` double(11,2) NOT NULL,
  `status` varchar(250) NOT NULL,
  `type` varchar(6) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

INSERT INTO user VALUES("1","user","","admin"," ","Female","","Single","0000-00-00","","","","user_20240108_230538.png","admin@gmail.com","09457664942","admin123","0","0.00","Active","Admin");
INSERT INTO user VALUES("2","Jaylord","","Galindo"," ","Male","dadasda","","2024-01-02","","","","","jayjayjaylord16@gmail.com","0906355","jaylord","0","0.00","Active","Staff");
INSERT INTO user VALUES("3","Riza Mae","","Trestiza"," ","Female","sadasdasd","","0000-00-00","","","","","trestizarizamae@gmail.com","09061269981","riza","0","0.00","Active","Staff");
INSERT INTO user VALUES("4","John Mark","","Ebarat"," ","Male","sadsadsa","Single","2024-01-10","","","ID_20240110_010444.png","","john@gmail.com","09524856482","john","1","0.00","Active","Renter");
INSERT INTO user VALUES("5","Marilou","","Nobleza","I","Female","","","2024-01-08","","","","","marilou@gmail.com","09543854685","marilou","0","0.00","Active","Renter");
INSERT INTO user VALUES("6","Nica","","Nica Ogapay"," ","Female","","","0000-00-00","","","","","nica@gmail.com","09954844898","nica","0","0.00","Active","Staff");
INSERT INTO user VALUES("7","Abigail","","Maghuyop"," ","Female","","","0000-00-00","","","","","abigail@gmail.com","09554856548","abigail","0","0.00","Active","Renter");
INSERT INTO user VALUES("8","Judielyn","Trestiza","Cualbar"," ","Female","","","0000-00-00","","","","","judielyn.cualbar@ustp.edu.ph","09171234794","jud@123","0","0.00","Active","Admin");
INSERT INTO user VALUES("9","Judielyn","Cualbar","Trestiza"," ","Male","","","0000-00-00","","","","","judielyn.cualbar2@gmail.com","09171234794","judielyn@123","1","0.00","Active","Renter");
INSERT INTO user VALUES("10","Glyza","Mae T.","Lomo"," ","Female","","","0000-00-00","","","","","glyzamae2@gmail.com","09171475542","glyza@123","0","0.00","Archive","Renter");
INSERT INTO user VALUES("11","Glyza Mae","Trestiza","Lomo"," ","Female","","","0000-00-00","","","","","glyzamae2@gmail.com","09171475542","glyza@123","1","0.00","Active","Renter");
INSERT INTO user VALUES("12","Lady Key","Basan ","Bancale"," ","Female","","Single","0000-00-00","","","","","ladykeyb@gmail.com","0963 925 87","ladykey","1","0.00","Active","Renter");



CREATE TABLE `utility` (
  `utility_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `utility_type_id` int(11) NOT NULL,
  `utility_amount` decimal(11,2) NOT NULL,
  `utility_date` datetime NOT NULL,
  `utility_attachment` varchar(255) NOT NULL,
  `is_payment_made` int(11) NOT NULL,
  `utility_status` varchar(10) NOT NULL,
  PRIMARY KEY (`utility_id`),
  KEY `property_id` (`user_id`),
  KEY `utility_type_id` (`utility_type_id`) USING BTREE,
  CONSTRAINT `utility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `utility_ibfk_2` FOREIGN KEY (`utility_type_id`) REFERENCES `utility_type` (`utility_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO utility VALUES("1","9","2","1000.00","2023-12-11 10:06:10","","2","Active");
INSERT INTO utility VALUES("2","9","3","250.00","2023-12-11 02:28:27","","1","Active");
INSERT INTO utility VALUES("3","5","2","300.00","2023-12-13 02:58:56","","0","Active");



CREATE TABLE `utility_type` (
  `utility_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `utility_type_name` varchar(255) NOT NULL,
  `utility_type_status` varchar(255) NOT NULL,
  PRIMARY KEY (`utility_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

INSERT INTO utility_type VALUES("1","Rent","Active");
INSERT INTO utility_type VALUES("2","Electricity","Active");
INSERT INTO utility_type VALUES("3","Water","Active");
INSERT INTO utility_type VALUES("4","Penalty","Active");
INSERT INTO utility_type VALUES("5","sdasdsd","Active");

