CREATE DATABASE login;
USE login;
CREATE TABLE users(
		username VARCHAR(50),
        password VARCHAR(30)
);
INSERT INTO users
SET username="admin",
password="123este456";
SELECT * FROM users;