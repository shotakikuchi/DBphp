DROP TABLE IF EXISTS member;
CREATE TABLE member (
  id int not null auto_increment,
  username varchar(50),
  password varchar(128),
  last_name varchar(50),
  firstname varchar(50),
  birthday char(8),
  ken smallint,
  reg_date DATETIME,
  cancel DATETIME,
  PRIMARY KEY(id)
);




