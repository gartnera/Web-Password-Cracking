CREATE DATABASE cracking;
use cracking;
CREATE TABLE users (id   INT AUTO_INCREMENT, email VARCHAR(255) NOT NULL UNIQUE, hourLimit INT(3) DEFAULT 1, isSuperUser BIT DEFAULT 0,
										hash CHAR(128)                              NOT NULL, salt CHAR(8) NOT NULL, emailConfirmed BIT DEFAULT 0, managerConfirmed BIT DEFAULT 0, PRIMARY KEY (id));

CREATE TABLE attack (id         INT AUTO_INCREMENT, uid INT  NOT NULL, createTime TIMESTAMP DEFAULT current_timestamp, startTime TIMESTAMP,
										 endTime    TIMESTAMP, attackType INT(1) NOT NULL, hashType INT(4), attackMethod INT(1), status CHAR(1), mask VARCHAR(50),
										 dictionary VARCHAR(50), resumeFile VARCHAR(50), PRIMARY KEY (id), FOREIGN KEY (uid) REFERENCES users (id)
	ON DELETE CASCADE
	ON UPDATE CASCADE);

CREATE TABLE hash (id INT AUTO_INCREMENT, jobId INT NOT NULL, hash VARCHAR(300) NOT NULL, password VARCHAR(30) NOT NULL,
	PRIMARY KEY (id), FOREIGN KEY (jobId) REFERENCES attack (id)
	ON DELETE CASCADE
	ON UPDATE CASCADE);
#consider changing 'on delete cascade' to 'on delete null' for lookups

CREATE TABLE confirmation (id INT AUTO_INCREMENT, uid INT, challenge CHAR(64) UNIQUE, conType CHAR(1), PRIMARY KEY (id), FOREIGN KEY (uid) REFERENCES users (id));
