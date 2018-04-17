drop   database if exists     StoreFront;
create database if not exists StoreFront;


drop user if exists 'phpWebEngine';
grant select, insert, delete, update, execute on CSPS_431_HW3.* to 'phpWebEngine' identified by 'withheld';

use StoreFront;

CREATE TABLE User
(
  UserId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  UserName VARCHAR NOT NULL,
  Password VARCHAR NOT NULL,
  isStoreOwner BOOLEAN NOT NULL,
  StoreName VARCHAR,

  UNIQUE (UserName, Password)
)

CREATE TABLE Products
(
  ProductId INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ProductName VARCHAR NOT NULL,
  Description VARCHAR
)

CREATE TABLE Orders
(
  OrderId INTEGER NOT NULL AUTO_INCREMENT,
  UserId INTEGER NOT NULL,
  ProductId INTEGER NOT NULL,

  FOREIGN KEY (UserId) REFERENCES User(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
)

CREATE TABLE Inventory
(
  InvetoryId INTEGER NOT NULL AUTO_INCREMENT,
  UserId INTEGER NOT NULL,
  ProductId INTEGER NOT NULL,
  isActive BOOLEAN NOT NULL,

  FOREIGN KEY (UserId) REFERENCES User(UserId) ON DELETE CASCADE,
  FOREIGN Key (ProductId) REFERENCES Products(ProductId) ON DELETE CASCADE
);
