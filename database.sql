-- The collection of favorite cars
DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS carts;

CREATE TABLE stores (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE categories (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    storesid int unsigned NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE products (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    available int unsigned NOT NULL,
    prices int unsigned NOT NULL,
    categoriesid int unsigned NOT NULL,
    storesid int unsigned NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE carts (
	id int unsigned NOT NULL AUTO_INCREMENT,
	productsid int unsigned NOT NULL,
	storesid int unsigned NOT NULL,
	amount int unsigned NOT NULL,
	prices int unsigned NOT NULL,
    status varchar(128) NOT NULL,
	PRIMARY KEY (id)
);

-- Add some sample data
INSERT INTO stores(name) VALUES ("Fast shop 1");
INSERT INTO stores(name) VALUES ("Fast shop 2");

INSERT INTO categories(name, storesid) VALUES ("Sales", 1);
INSERT INTO categories(name, storesid) VALUES ("Bath & Beauty", 1);
INSERT INTO categories(name, storesid) VALUES ("Book & Media", 1);
INSERT INTO categories(name, storesid) VALUES ("Clothing", 1);
INSERT INTO categories(name, storesid) VALUES ("Tools", 1);
INSERT INTO categories(name, storesid) VALUES ("Fresh food", 1);
INSERT INTO categories(name, storesid) VALUES ("Vegetables", 1);
INSERT INTO categories(name, storesid) VALUES ("Sales", 2);
INSERT INTO categories(name, storesid) VALUES ("Bath", 2);
INSERT INTO categories(name, storesid) VALUES ("Beauty", 2);

INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("Carrots", "1", "1.5", 5, 1);
INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("Pencil", "2", "3.5", 1, 1);
INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("CDs", "5", "22", 1, 1);
INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("Iphones", "1", "350", 1, 1);
INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("A4 papers", "10", "1", 1, 1);
INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("A5 papers", "2", "3", 1, 1);
INSERT INTO products(name, available, prices, categoriesid, storesid) VALUES ("A6 papers", "3", "5", 1, 1);

INSERT INTO carts(productsid, storesid, amount, prices, status) VALUES (2, 1, "1", "3.5", "not paid");
INSERT INTO carts(productsid, storesid, amount, prices, status) VALUES (3, 1, "3", "66", "not paid");
INSERT INTO carts(productsid, storesid, amount, prices, status) VALUES (5, 1, "1", "1", "shipping");