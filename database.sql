DROP TABLE IF EXISTS stores;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS carts;
DROP TABLE IF EXISTS productorder;

CREATE TABLE stores (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    description varchar(128),
    bg varchar(128),
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
	status varchar(128) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE productorder (
    id int unsigned NOT NULL AUTO_INCREMENT,
    cartid int unsigned NOT NULL,
    productsid int unsigned NOT NULL,
    amount int unsigned NOT NULL,
    PRIMARY KEY (id) 
);


-- Add some sample data
INSERT INTO stores(name, description, bg) VALUES ("Fast Shop", "You can find tools to build your own modern living style here", "6.png");
INSERT INTO stores(name, description, bg) VALUES ("Fresh Zone", "Shop for fresh food here", "1.png");
INSERT INTO stores(name, description, bg) VALUES ("Summer Blast", "Explore Your summer here", "1.gif");

INSERT INTO categories(name, storesid) VALUES ("Sales", 1);
INSERT INTO categories(name, storesid) VALUES ("Living Room", 1);
INSERT INTO categories(name, storesid) VALUES ("Bed Room", 1);
INSERT INTO categories(name, storesid) VALUES ("Bath & Beauty", 1);
INSERT INTO categories(name, storesid) VALUES ("Gardening Tools", 1);
INSERT INTO categories(name, storesid) VALUES ("Storage", 1);
INSERT INTO categories(name, storesid) VALUES ("Weekly Special!", 2);
INSERT INTO categories(name, storesid) VALUES ("Fruit", 2);
INSERT INTO categories(name, storesid) VALUES ("Sea food", 2);
INSERT INTO categories(name, storesid) VALUES ("Vegetables", 2);
INSERT INTO categories(name, storesid) VALUES ("Burgers", 2);
INSERT INTO categories(name, storesid) VALUES ("Milk Tea", 2);
INSERT INTO categories(name, storesid) VALUES ("Deserts", 2);
INSERT INTO categories(name, storesid) VALUES ("New!", 3);
INSERT INTO categories(name, storesid) VALUES ("The Sea", 3);
INSERT INTO categories(name, storesid) VALUES ("Bikini", 3);
INSERT INTO categories(name, storesid) VALUES ("Bath", 3);
INSERT INTO categories(name, storesid) VALUES ("Beauty", 3);
INSERT INTO categories(name, storesid) VALUES ("Facial care", 3);
INSERT INTO categories(name, storesid) VALUES ("Skin care", 3);

INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Moore Pebble Grey Wing Back Accent Chair", 10, 500, "11.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Moore Pebble Grey Wing Back Accent Chair", 10, 500, "11.jpg", 2, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Edmund Smoke Grey Dining Table", 2, 700, "14.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Indy Floral Indigo Kilim Arm Chair", 3, 650, "15.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Oxford White File Cabinet", 2, 119, "12.jpg", 2, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Edmund Smoke Grey Dining Table", 2, 700, "14.jpg", 2, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Indy Floral Indigo Kilim Arm Chair", 3, 650, "15.jpg", 2, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Chennai White Wash Queen Platform Bed", 5, 1220, "13.jpg", 2, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Chennai White Wash Queen Platform Bed", 5, 1220, "13.jpg", 3, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("5.83 ft. Black 3-Panel Room Divider", 4, 35, "17.jpg", 4, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("22 in. Kohler High Wheel Variable Speed Gas Self Propelled Mower", 10, 300, "16.jpg", 5, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("22 in. Kohler High Wheel Variable Speed Gas Self Propelled Mower", 10, 300, "16.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("0.625 in. H x 4.25 in. W x 9 in. D Oil Rubbed Bronze Under Cabinet Double Wine Bottle Rack", 13, 30, "18.jpg", 6, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Balmain 2-Shelf Metal Kitchen Corner Shelf", 3, 50, "19.jpg", 1, 1);
INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ("Balmain 2-Shelf Metal Kitchen Corner Shelf", 3, 50, "19.jpg", 6, 1);
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

INSERT INTO carts(userid, status) VALUES (1, "cart");

INSERT INTO productorder(cartid, productsid, amount) VALUES (1, 2, 1);
