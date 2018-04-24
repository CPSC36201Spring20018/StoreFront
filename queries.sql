USE StoreFront;

-- These are just for my testing to view and modify tables
select * from Users;
delete from Users where UserName = 'StoreOwner3';

select * from Products;
delete from Products where ProductName = '';

select * from Orders;

-- Insert new user Store front user
-- Values will be from create account form
INSERT INTO
	Users (UserName, Password, StoreName)
VALUES
	('TestStoreOwner','test','test');

-- Check if Username exists based on rows returned 1 or 0
-- UserName will be from create account form
SELECT *
FROM Users
WHERE UserName = 'TestStoreOwner';

-- Inserting a Product
-- Values for Products inserted will be from the Form Post
-- UserId value is from session data
INSERT INTO
	Products (UserId, ProductName, Description, Price, SKU, Count, isActive)
VALUES
	(1, 'Pencil', 'This is litererally the best pencil ever made!', 99.99, '1234567890', 30, 1);

-- Buying a Product
-- ProductId should be from Post data
-- Status is by default ordered when first purchased based on DDL contraint
INSERT INTO
	Orders (UserId, ProductId, FirstName, LastName, Address)
Values
	(1,2,'cameron', 'test', '666 not test cir, not test town, TX 54321');
UPDATE
	Products
SET
	Count = (Count - 1)
WHERE
	ProductId = 2;

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

-- View Orders for Store Owner IN PROGRESS
-- StoreOwnerId from session data when a store owner logs in
Select
	Orders.UserId,
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
	Orders.UserId = 1;
