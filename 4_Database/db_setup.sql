DROP DATABASE IF EXISTS gestione_salone;
CREATE DATABASE gestione_salone;
USE gestione_salone;

DROP TABLE IF EXISTS clienti;
CREATE TABLE method(
	name VARCHAR(50) PRIMARY KEY NOT NULL
);

DROP TABLE IF EXISTS payment;
CREATE TABLE payment(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	title VARCHAR(50) NOT NULL,
	amount DOUBLE NOT NULL,
	date DATE NOT NULL,
	type ENUM('entry','expense') NOT NULL,
	method_name VARCHAR(50),
	FOREIGN KEY (method_name) REFERENCES method(name)
    ON UPDATE CASCADE ON DELETE SET NULL
);

DROP TABLE IF EXISTS shop;
CREATE TABLE shop(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name VARCHAR(50) NOT NULL,
	address VARCHAR(50) NOT NULL,
	active INT NOT NULL
);

DROP TABLE IF EXISTS transaction;
CREATE TABLE transaction(
	shop_id INT NOT NULL,
	payment_id INT NOT NULL,
	PRIMARY KEY(shop_id, payment_id),
	FOREIGN KEY (shop_id) REFERENCES shop(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (payment_id) REFERENCES payment(id)
    ON UPDATE CASCADE ON DELETE CASCADE
);

DROP TABLE IF EXISTS user;
CREATE TABLE user(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	name VARCHAR(50) NOT NULL,
	surname VARCHAR(50) NOT NULL,
	email VARCHAR(50) NOT NULL,
	password VARCHAR(64) NOT NULL,
	role ENUM('amministratore','utente') NOT NULL,
	super INT,
	active INT NOT NULL,
	shop_id INT,
	FOREIGN KEY (shop_id) REFERENCES shop(id)
    ON UPDATE CASCADE ON DELETE SET NULL
);

