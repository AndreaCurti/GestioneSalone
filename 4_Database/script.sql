DROP DATABASE IF EXISTS gestione_salone;
CREATE DATABASE gestione_salone;
USE gestione_salone;

CREATE TABLE user(
	email VARCHAR(50) PRIMARY KEY,
    password VARCHAR(64)
);

CREATE TABLE client(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20),
    surname VARCHAR(20),
    address VARCHAR(30),
    phone INT(10)
);

CREATE TABLE product(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20),
    cost DECIMAL
);

CREATE TABLE service(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20),
    cost DECIMAL
);

CREATE TABLE method(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20)
);


CREATE TABLE client_buys_service(
	client_id int,
    service_id int,
    method_id int,
    date date,
    FOREIGN KEY (client_id) REFERENCES client(id),
    FOREIGN KEY (service_id) REFERENCES service(id),
    FOREIGN KEY (method_id) REFERENCES method(id)
);

CREATE TABLE client_buys_product(
	client_id int,
    product_id int,
    method_id int,
    date date,
	FOREIGN KEY (client_id) REFERENCES client(id),
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (method_id) REFERENCES method(id)
);

CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'Admin123!';
GRANT ALL privileges ON gestione_salone.* TO 'admin'@'%';