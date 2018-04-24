USE StoreFront;

-- These are just for my testing to view and modify tables
select * from Users;
delete from Users where UserName = 'StoreOwner3';

select * from Products;
delete from Products where ProductName = '';

select * from Inventory;
delete from Inventory where UserId = 2;

select * from Orders;

-- Insert new user normal user
-- Values will be from create account form post
INSERT INTO
	Users (UserName, Password, Address, isStoreOwner)
VALUES
	('TestUser','test','123 test cir., test town, CA 12345', 0);

-- Insert new user Store front user
-- Values will be from create account form
INSERT INTO
	Users (UserName, Password, Address, isStoreOwner, StoreName)
VALUES
	('TestStoreOwner','test','123 test st., test city, CA 12345',1,'test');

-- Check if Username exists based on rows returned 1 or 0
-- UserName will be from create account form
SELECT *
FROM Users
WHERE UserName = 'TestStoreOwner';

-- Inserting a Product
-- Values for Products insert will be from the Form Post
-- Values for Inventory: UserId from session data and ProductId from LAST_INSERT_ID() function
-- BOTH QUERIES NEED TO BE RUN RIGHT AFTER THE OTHER because of the LAST_INSERT_ID() function
INSERT INTO
	Products (ProductName, Description, Price, SKU, Count, isActive)
VALUES
	('Pencil', 'This is litererally the best pencil ever made!', 99.99, '1234567890', 30, 1);
INSERT INTO
	Inventory (UserId, ProductId)
SELECT
	UserId, ProductId
FROM
	Users, Products
WHERE
	UserId = 2 AND ProductId = LAST_INSERT_ID();

-- Buying a Product
-- ProductId should be from Post data
-- Status is by default ordered when first purchased based on DDL contraint
INSERT INTO
	Orders (ProductId, StoreOwnerId)
SELECT
(Select ProductId
	FROM Products
	WHERE ProductId = 2)
	as PID,
(SELECT Users.UserId
	FROM Users LEFT JOIN Inventory
	ON Inventory.UserId = Users.UserId
	WHERE ProductId = 2)
	as UID;
UPDATE Products
	SET Count = (Count - 1)
	WHERE ProductId = 2;

-- Modify Product
-- Changes to the values will be from the Form Post
-- All of the form values should be prepoluated when loading the modify product page
-- ProductId should be from the data that was queried up loading the page
UPDATE
	Products
SET
	ProductName = 'Pen',
	Description = 'Literally the worst pen ever',
	Price = 50.00,
	SKU = '987654321',
	isActive = 1
WHERE
	ProductId = 1;

-- View Orders for Store Owner
-- StoreOwnerId from session data when a store owner logs in
Select
	Orders.StoreOwnerId,
	Orders.OrderId,
    Orders.Status,
    Products.ProductName,
    Products.Price,
    Products.Description
FROM
	Orders
LEFT JOIN
	Products
ON
	Orders.ProductId = Products.ProductId
WHERE
	StoreOwnerId = 2;
