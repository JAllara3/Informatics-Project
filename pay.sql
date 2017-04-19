-- Payment database
/*
DROP TABLE IF EXISTS name;
DROP TABLE IF EXISTS address;
DROP TABLE IF EXISTS delivery;
*/
DROP TABLE IF EXISTS payment;


-- TABLE with payment info
CREATE TABLE payment (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    address varchar(128) NOT NULL,
    payment int unsigned NOT NULL,
    /*type varchar(20) NOT NULL,*/
    delivery varchar(50) NOT NULL,
    PRIMARY KEY (id)    
);
/*
-- TABLE WITH address
CREATE TABLE address (
    id int unsigned NOT NULL AUTO_INCREMENT,
    address varchar(128) NOT NULL,
    PRIMARY KEY (id)        
);

-- payment
CREATE TABLE payment (
    id int unsigned NOT NULL AUTO_INCREMENT,
    payment int unsigned NOT NULL,
    type varchar(20) NOT NULL,
    PRIMARY KEY (id)
);

-- listing of delivery options
CREATE TABLE delivery (
    id int unsigned NOT NULL AUTO_INCREMENT,
    delivery varchar(50) NOT NULL,
    PRIMARY KEY (id)    
);
*/
-- Add some sample data
--INSERT INTO shape(name) VALUES ('circular');
--INSERT INTO shape(name) VALUES('rectangular');

--INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('pepperoni', FALSE, FALSE, TRUE, TRUE);
--INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('olives', TRUE, TRUE, TRUE, TRUE);
--INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('sausage', FALSE, FALSE, TRUE, TRUE);
--INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('sundried tomatoes', TRUE, TRUE, TRUE, TRUE);

--INSERT INTO pizza(shapeid, crust, size, cheese, name) VALUES (1, 'thin', 11, TRUE, 'sorrentina');
--INSERT INTO pizza(shapeid, crust, size, cheese, name) VALUES (1, 'thin', 11, TRUE, 'calabrese');

--INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (1, 2);
--INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (1, 4);
--INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (2, 1);
--INSERT INTO pizzatopping(pizzaid, toppingid) VALUES (2, 3);