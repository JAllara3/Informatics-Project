DROP TABLE IF EXISTS payment;
DROP TABLE IF EXISTS addresses;
DROP TABLE IF EXISTS payments;


-- TABLE with payment info
CREATE TABLE payment (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    address varchar(128) NOT NULL,
    payment int unsigned NOT NULL,
    deliver varchar(50) NOT NULL,
    usersid int unsigned NOT NULL,
    PRIMARY KEY (id)    
);

CREATE TABLE addresses (
    id int unsigned NOT NULL AUTO_INCREMENT,
    addresses varchar(128) NOT NULL,
    usersid int unsigned NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE cards (
    id int unsigned NOT NULL AUTO_INCREMENT,
    cards int unsigned NOT NULL,
    usersid int unsigned NOT NULL,
    PRIMARY KEY(id)
);


-- Add some sample data
INSERT INTO payment(name, address, payment, deliver) VALUES ('katie', '123 abc', 1234567891234567, '10/12/2017');
--INSERT INTO shape(name) VALUES('rectangular');

--INSERT INTO topping(name, vegetarian, vegan, glutenfree, lactosefree) VALUES ('pepperoni', FALSE, FALSE, TRUE, TRUE);
