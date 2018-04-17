drop database if exists StoreFront;
create database if not exists StoreFront;


drop user if exists 'phpWebEngine';
grant select, insert, delete, update, execute on StoreFront.* to 'phpWebEngine' identified by 'withheld';

use StoreFront;

CREATE TABLE Users
(
  UserId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserName VARCHAR NOT NULL,
  Password VARCHAR NOT NULL,
  Address VARCHAR,
  isStoreOwner BOOLEAN NOT NULL,
  StoreName VARCHAR,

  UNIQUE (UserName, Password)
)

CREATE TABLE Products
(
  ProductId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ProductName VARCHAR NOT NULL,
  Description VARCHAR,
  Price FLOAT NOT NULL,
  SKU VARCHAR,
  Count INTEGER NOT NULL,
  isActive BOOLEAN NOT NULL
)

CREATE TABLE Orders
(
  OrderId INTEGER NOT NULL AUTO_INCREMENT,
  UserId INTEGER NOT NULL,
  ProductId INTEGER NOT NULL,
  Status VARCHAR NOT NULL

  FOREIGN KEY (UserId) REFERENCES Users(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
)

CREATE TABLE Inventory
(
  UserId INTEGER NOT NULL,
  ProductId INTEGER NOT NULL,

  FOREIGN KEY (UserId) REFERENCES Users(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
);
