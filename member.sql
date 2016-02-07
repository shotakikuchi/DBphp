DROP TABLE IF EXISTS member;
CREATE TABLE member (
  id int not null auto_increment,
  username varchar(50),
  password varchar(128),
  birthday char(8),
  reg_date DATETIME,
  PRIMARY KEY(id)
);

DROP TABLE IF EXISTS message;
CREATE TABLE message(
  id int not null,
  username VARCHAR(50),
  message VARCHAR(250),
  reg_date DATETIME
);