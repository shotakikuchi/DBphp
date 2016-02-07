DROP TABLE IF EXISTS message;
CREATE TABLE message(
  id int not null,
  username VARCHAR(50),
  message VARCHAR(250),
  reg_date DATETIME
);