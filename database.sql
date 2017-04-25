-- The collection of favorite cars
DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS productorder; 

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
    icon varchar(128),
    categoriesid int unsigned NOT NULL,
    storesid int unsigned NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE orders (
	id int unsigned NOT NULL AUTO_INCREMENT,
    status varchar(128) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE productorder (
    id int unsigned NOT NULL AUTO_INCREMENT,
    ordersid int unsigned NOT NULL,
    productsid int unsigned NOT NULL,
    name varchar(128) NOT NULL,
	amount int unsigned NOT NULL,
    price int unsigned NOT NULL,
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

INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Carrots", 1, 1.5, NULL, 6, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Pencil", 2, 3.5, "2.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("CDs", 5, 22, "4.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Iphones", 1, 350, NULL, 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("A4 papers", 10, 1, NULL, 3, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("A5 papers", 2, 3, NULL, 3, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("A6 papers", 3, 5, NULL, 1, 1);

INSERT INTO orders(status) VALUES ("not paid");
INSERT INTO orders(status) VALUES ("not paid");
INSERT INTO orders(status) VALUES ("shipping");

INSERT INTO productorder(ordersid, productsid, name, amount, price) VALUES (1, 2, "Pencil", 1, "3.5");
INSERT INTO productorder(ordersid, productsid, name, amount, price) VALUES (2, 3, "CDs", 3, "66");
INSERT INTO productorder(ordersid, productsid, name, amount, price) VALUES (3, 5, "A4 papers", 1, "1");

