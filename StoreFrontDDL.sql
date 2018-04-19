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
  Address VARCHAR(300),
  isStoreOwner BOOLEAN NOT NULL,
  StoreName VARCHAR(50),

  UNIQUE (UserName, Password)
);

CREATE TABLE Products
(
  ProductId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ProductName VARCHAR(50) NOT NULL,
  Description VARCHAR(300),
  Price FLOAT(13,2) NOT NULL,
  SKU VARCHAR(20),
  Count INTEGER SIGNED NOT NULL,
  isActive BOOLEAN NOT NULL
);

CREATE TABLE Orders
(
  OrderId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserId INTEGER UNSIGNED NOT NULL,
  ProductId INTEGER UNSIGNED NOT NULL,
  Status VARCHAR(20) NOT NULL DEFAULT 'Ordered',

  FOREIGN KEY (UserId) REFERENCES Users(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
);

CREATE TABLE Inventory
(
  UserId INTEGER UNSIGNED NOT NULL,
  ProductId INTEGER UNSIGNED NOT NULL,

  FOREIGN KEY (UserId) REFERENCES Users(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
);
