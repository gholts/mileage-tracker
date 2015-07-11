use CST207;
CREATE TABLE A2_Make
(makeID int AUTO_INCREMENT PRIMARY KEY,
description varchar(50));

INSERT INTO A2_Make (description)
VALUES ('Pilot Ejection Seat');
INSERT INTO A2_Make (description)
VALUES ('Electric Chair');
INSERT INTO A2_Make (description)
VALUES ('Screamer Roller Coaster Seat');
INSERT INTO A2_Make (description)
VALUES ('Hannibal Lecter Containment Chair');

CREATE TABLE A2_ChairModel
(chairModelID int AUTO_INCREMENT PRIMARY KEY,
makeID int references Make(makeID),
name varchar(50),
sellingPrice int,
numberOnHand int,
supplerEmail varchar(50),
reorderEmailSent varchar(50),
reorderQuantity int);

CREATE TABLE A2_Order
(orderID int AUTO_INCREMENT PRIMARY KEY,
customerName varchar(50),
phoneNumber int,
emailAddress varchar(50),
shippingAddress varchar (100),
creditCardType varchar (50),
pst int,
gst int,
totalValue int);

CREATE TABLE A2_OrderItem
(orderItemID int AUTO_INCREMENT PRIMARY KEY,
orderID int REFERENCES A2Order(orderID),
chairModelID int REFERENCES ChairModel(chairModelID),
quantityPurchased int,
pricePerChair int)

