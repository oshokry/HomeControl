CREATE DATABASE IF NOT EXISTS Irrigation;
USE Irrigation;

CREATE TABLE IF NOT EXISTS Credentials (
	username varchar(255) PRIMARY KEY,
	password varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS TimingSchedule (
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
  dayOfWeek VARCHAR(20) NOT NULL,
  solenoidNumber VARCHAR(20) NOT NULL,
  startTime TIME NOT NULL,
  lengthSeconds INTEGER NOT NULL,
  enabled BOOLEAN NOT NULL,
	oneOff BOOLEAN NOT NULL
);

CREATE TABLE IF NOT EXISTS DayOfWeek (
	id INTEGER PRIMARY KEY,
    dayOfWeek VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS sensor (
  timestamp datetime PRIMARY KEY,
  temperature float(6,3) NOT NULL,
  pressure float(8,3) NOT NULL,
  humidity float(6,3) NOT NULL
);

CREATE TABLE IF NOT EXISTS WaterHistory (
  timestamp datetime,
  solenoidNumber INTEGER NOT NULL,
  mode VARCHAR(20) NOT NULL,
  lengthSeconds INTEGER NOT NULL,
  PRIMARY KEY(timestamp, solenoidNumber)
);

INSERT IGNORE INTO Credentials VALUES("admin","$2y$10$V9Nq600enrw5SxRxEWabfO/7w3Iley6mcKkuuj1lfS.jnhQxhN6wG");

INSERT IGNORE INTO DayOfWeek VALUES(1,"SUN");
INSERT IGNORE INTO DayOfWeek VALUES(2,"MON");
INSERT IGNORE INTO DayOfWeek VALUES(3,"TUE");
INSERT IGNORE INTO DayOfWeek VALUES(4,"WED");
INSERT IGNORE INTO DayOfWeek VALUES(5,"THU");
INSERT IGNORE INTO DayOfWeek VALUES(6,"FRI");
INSERT IGNORE INTO DayOfWeek VALUES(7,"SAT");
