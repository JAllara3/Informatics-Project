DROP TABLE IF EXISTS payment;
DROP TABLE IF EXISTS addresses;
DROP TABLE IF EXISTS cards;


-- TABLE with payment info
CREATE TABLE payment (
    id int unsigned NOT NULL AUTO_INCREMENT,
    name varchar(128) NOT NULL,
    addressid int unsigned NOT NULL,
    cardsid int unsigned NOT NULL,
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
INSERT INTO payment(name, addressid,cardsid, deliver, usersid) VALUES ('katie', 1 , 1, '2017-05-10', 1);
INSERT INTO payment(name, addressid,cardsid, deliver, usersid) VALUES ('katie', 2 , 2, '2017-05-10', 1);
INSERT INTO payment(name, addressid,cardsid, deliver, usersid) VALUES ('katie', 3 , 3, '2017-05-10', 1);

INSERT INTO addresses(addresses, usersid) VALUES ('123 street', 1);
INSERT INTO addresses(addresses, usersid) VALUES ('456 street', 1);
INSERT INTO addresses(addresses, usersid) VALUES ('789 street', 1);

INSERT INTO cards(cards, usersid) VALUES (1234567891234567, 1);
INSERT INTO cards(cards, usersid) VALUES (1234567891234568, 1);
INSERT INTO cards(cards, usersid) VALUES (1234567891234569, 1);
