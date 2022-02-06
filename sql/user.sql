mysql -u root -h localhost -p;

CREATE DATABASE loginsys;

USE loginsys;

SHOW TABLES FROM loginsys;

CREATE TABLE users(
uid int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
uname TINYTEXT NOT NULL,
umail TINYTEXT NOT NULL,
upass LONGTEXT NOT NULL,
uhash LONGTEXT NOT NULL
);

SELECT * FROM users;

DESCRIBE users;


CREATE TABLE feedback(
fid int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
fname TINYTEXT NOT NULL,
fmail TINYTEXT NOT NULL,
fmess TINYTEXT NOT NULL
);

SELECT * FROM feedback;

DESCRIBE feedback;


CREATE TABLE ifile(
ifid int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
ifhash LONGTEXT NOT NULL,
ifname LONGTEXT NOT NULL
);

SELECT * FROM ifile;

DESCRIBE ifile;

ALTER TABLE users
ADD utype TINYTEXT;

UPDATE users SET utype='admin' WHERE uname='admin';

ALTER TABLE feedback
ADD ftype TINYTEXT;

ALTER TABLE feedback
ADD fhash TINYTEXT;

UPDATE feedback SET ftype='normal' WHERE fname='admin';

ALTER TABLE ifile
ADD ifmess TINYTEXT;

ALTER TABLE ifile
ADD ifstatus TINYTEXT;

UPDATE ifile SET ifstatus='public' WHERE ifhash='9c862d4654060aa1d652934e28b1bbe5';