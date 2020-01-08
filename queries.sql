CREATE TABLE users (
 user_id INT(11) AUTO_INCREMENT,
 name VARCHAR(255) NOT NULL,
 phone INT (10) UNSIGNED ZEROFILL NOT NULL,
 password VARCHAR (255) NOT NULL,
 utype VARCHAR(11),
 PRIMARY KEY (user_id)
 );
 
CREATE TABLE contact (
 contact_id INT(11) AUTO_INCREMENT,
 name VARCHAR(255) NOT NULL,
 phone INT(10),
 message VARCHAR(100),
 PRIMARY KEY (contact_id),
 );
 
 CREATE TABLE recipes (
 recipe_id INT(11) AUTO_INCREMENT,
 user_id INT (11),
 name VARCHAR(255) NOT NULL,
 image TEXT NOT NULL,
 ingredients VARCHAR(255) NOT NULL,
 category VARCHAR(50) NOT NULL,
 event_date DATE NOT NULL,
 time_from TIME NOT NULL,
 time_to TIME NOT NULL, 
 location VARCHAR(255) NOT NULL,
 price INT(11),
 PRIMARY KEY (recipe_id),
 FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
 );
 
CREATE TABLE reviews IF NOT EXISTS(
 review_id int(11) AUTO_INCREMENT,
  recipe_id int(11),
  user_id int(11),
  review text,
  label varchar(255),
  score varchar(255),
 PRIMARY KEY (review_id),
 FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE SET NULL ON UPDATE CASCADE,
 FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL ON UPDATE CASCADE
 ); 
 
 CREATE TABLE bookings (
  booking_id int(11) AUTO_INCREMENT,
  recipe_id int(11) NOT NULL,
user_id int(11) NOT NULL,
 PRIMARY KEY (booking_id),
 FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id) ON DELETE CASCADE ON UPDATE CASCADE,
 FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE
 );