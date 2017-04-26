DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS carts;
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

-- for each order that has been placed, assign it a userid
CREATE TABLE carts (
    id int unsigned NOT NULL AUTO_INCREMENT,
	userid int unsigned NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE productorder (
    id int unsigned NOT NULL AUTO_INCREMENT,
    cartid int unsigned NOT NULL,
	userid int unsigned NOT NULL,
    productsid int unsigned NOT NULL,
	amount int unsigned NOT NULL,
	status varchar(128) NOT NULL,
    PRIMARY KEY (id) 
);


-- Add some sample data
INSERT INTO stores(name) VALUES ("Fast shop 1");
INSERT INTO stores(name) VALUES ("Fast shop 2");
INSERT INTO stores(name) VALUES ("Fast shop 3");

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
INSERT INTO categories(name, storesid) VALUES ("Sea food", 2);
INSERT INTO categories(name, storesid) VALUES ("Veges", 2);
INSERT INTO categories(name, storesid) VALUES ("New!", 3);
INSERT INTO categories(name, storesid) VALUES ("Clothes", 3);

INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Carrots", 1, 1.5, NULL, 6, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Pencil", 2, 3.5, "2.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("CDs", 5, 22, "4.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Iphones", 1, 350, NULL, 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("A4 papers", 10, 1, NULL, 3, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("A5 papers", 2, 3, NULL, 3, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("A6 papers", 3, 5, NULL, 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 1, 350, NULL, 1, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 10, 1, NULL, 3, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 2, 3, NULL, 3, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 3, 5, NULL, 1, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 1, 350, NULL, 1, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 10, 1, NULL, 3, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 2, 3, NULL, 3, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 3, 5, NULL, 1, 2);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 1, 350, NULL, 1, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 10, 1, NULL, 3, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 2, 3, NULL, 3, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 3, 5, NULL, 1, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 1, 350, NULL, 1, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 10, 1, NULL, 3, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 2, 3, NULL, 3, 3);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("", 3, 5, NULL, 1, 3);

INSERT INTO carts(userid) VALUES (1);
INSERT INTO carts(userid) VALUES (1);
INSERT INTO carts(userid) VALUES (2);

INSERT INTO productorder(cartid, userid, productsid, amount, status) VALUES (1, 1, 2, 1, "not paid");
INSERT INTO productorder(cartid, userid, productsid, amount, status) VALUES (2, 2, 3, 3, "not paid");
INSERT INTO productorder(cartid, userid, productsid, amount, status) VALUES (1, 3, 5, 1, "shipped");
