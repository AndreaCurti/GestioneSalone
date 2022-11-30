DROP DATABASE IF EXISTS gestione_salone;
CREATE DATABASE gestione_salone;
USE gestione_salone;

CREATE TABLE user(
	email VARCHAR(50) PRIMARY KEY NOT NULL,
    password VARCHAR(64) NOT NULL
);

CREATE TABLE client(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    surname VARCHAR(20) NOT NULL,
    email VARCHAR(30) NOT NULL,
    phone INT(10) NOT NULL
);

CREATE TABLE product(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    cost DECIMAL NOT NULL,
    active INT NOT NULL
);

CREATE TABLE service(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    cost DECIMAL NOT NULL,
    active INT NOT NULL
);

CREATE TABLE method(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(20) NOT NULL
);


CREATE TABLE client_buys_service(
	client_id int NOT NULL,
    service_id int NOT NULL,
    method_id int NOT NULL,
    date date NOT NULL,
    FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE,
    FOREIGN KEY (service_id) REFERENCES service(id),
    FOREIGN KEY (method_id) REFERENCES method(id)
);

CREATE TABLE client_buys_product(
	client_id int NOT NULL,
    product_id int NOT NULL,
    method_id int NOT NULL,
    date date NOT NULL,
	FOREIGN KEY (client_id) REFERENCES client(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES product(id),
    FOREIGN KEY (method_id) REFERENCES method(id)
);

CREATE USER IF NOT EXISTS 'admin'@'%' IDENTIFIED BY 'Admin123!';
GRANT ALL privileges ON gestione_salone.* TO 'admin'@'%';