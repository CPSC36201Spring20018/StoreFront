drop database if exists StoreFront;
create database if not exists StoreFront;


drop user if exists 'phpWebEngine';
grant select, insert, delete, update, execute on StoreFront.* to 'phpWebEngine' identified by 'withheld';

use StoreFront;

CREATE TABLE Users
(
  UserId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserName VARCHAR(30) NOT NULL,
  Password VARCHAR(30) NOT NULL,
  StoreName VARCHAR(50) NOT NULL,

  UNIQUE (UserName, Password)
);

INSERT INTO
	Users (UserName, Password, StoreName)
VALUES
	('StoreOwner1','test1', 'StoreName1'),
	('StoreOwner2','test2', 'StoreName2'),
	('StoreOwner3','test3', 'StoreName3'),
	('StoreOwner4','test4', 'StoreName4');

CREATE TABLE Products
(
  ProductId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserId INTEGER UNSIGNED NOT NULL,
  ProductName VARCHAR(50) NOT NULL,
  Description VARCHAR(300),
  Price FLOAT(13,2) NOT NULL,
  SKU VARCHAR(20),
  Count INTEGER SIGNED NOT NULL,
  isActive BOOLEAN NOT NULL,

  FOREIGN KEY (UserId) REFERENCES Users(UserId) ON DELETE CASCADE
);

INSERT INTO
	Products (UserId, ProductName, Description, Price, SKU, Count, isActive)
VALUES
	(1, 'Pencil1', 'Description1', 11.11, '1234567890', 30, 1),
	(1, 'Pen1', 'Description11', 11.11, '1234567890', 30, 1),
	(2, 'Pencil2', 'Description2', 22.22, '1234567890', 30, 1),
	(2, 'Pen2', 'Description22', 22.22, '1234567890', 30, 1),
	(3, 'Pencil2', 'Description3', 33.33, '1234567890', 30, 1),
	(3, 'Pen3', 'Description33', 33.33, '1234567890', 30, 1),
	(4, 'Pencil3', 'Description44', 44.44, '1234567890', 30, 1),
	(4, 'Pen4', 'Description44', 44.44, '1234567890', 30, 1);

CREATE TABLE Orders
(
  OrderId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserId INTEGER UNSIGNED NOT NULL,
  ProductId INTEGER UNSIGNED NOT NULL,
  Status VARCHAR(20) NOT NULL DEFAULT 'Ordered',
  FirstName VARCHAR(30) NOT NULL,
  LastName VARCHAR(30) NOT NULL,
  Address VARCHAR(300) NOT NULL,
  DateOfPurchase DEFAULT CURRENT_TIMESTAMP,

  FOREIGN KEY (UserId) REFERENCES Users(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
);

INSERT INTO
  Orders (UserId, ProductId, FirstName, LastName, Address)
VALUES
  (1, 1, 'First1', 'Last1', '1 test cir, test town, CA 12345'),
  (1, 2, 'First1', 'Last1', '1 test cir, test town, CA 12345'),
  (2, 3, 'First2', 'Last2', '2 test cir, test town, CA 12345'),
  (2, 4, 'First2', 'Last2', '2 test cir, test town, CA 12345'),
  (3, 5, 'First3', 'Last3', '3 test cir, test town, CA 12345'),
  (3, 6, 'First3', 'Last3', '3 test cir, test town, CA 12345'),
  (4, 7, 'First4', 'Last4', '4 test cir, test town, CA 12345'),
  (4, 8, 'First4', 'Last4', '4 test cir, test town, CA 12345');
