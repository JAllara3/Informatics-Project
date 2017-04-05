-- The collection of favorite cars
DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS products;

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
    categoriesid int unsigned NOT NULL,
    storesid int unsigned NOT NULL,
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

INSERT INTO products(name, available, categoriesid, storesid) VALUES ("Carrots", 5, 5, 1);
INSERT INTO products(name, available, categoriesid, storesid) VALUES ("Pencil", 5, 1, 1);
INSERT INTO products(name, available, categoriesid, storesid) VALUES ("CDs", 4, 1, 1);
INSERT INTO products(name, available, categoriesid, storesid) VALUES ("Iphones", 5, 1, 1);
INSERT INTO products(name, available, categoriesid, storesid) VALUES ("A4 papers", 5, 1, 1);
INSERT INTO products(name, available, categoriesid, storesid) VALUES ("A5 papers", 5, 1, 1);
INSERT INTO products(name, available, categoriesid, storesid) VALUES ("A6 papers", 5, 1, 1);
