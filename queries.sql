USE StoreFront;

select * from Users;
delete from Users where UserName = 'test';

select * from Products;
delete from Products where ProductName = '';

-- Insert new user normal user
-- Values will be from create account form
INSERT INTO Users (UserName, Password, Address, isStoreOwner)
VALUES ('TestUser','test','123 test cir., test town, CA 12345', 0);

-- Check if Username exists based on rows returned 1 or 0
-- UserName will be from create account form
select * from Users where UserName = 'TestStoreOwner';

-- Insert new user Store front user
-- Values will be from create account form
INSERT INTO Users (UserName, Password, Address, isStoreOwner, StoreName)
VALUES ('TestStoreOwner','test','123 test st., test city, CA 12345',1,'test');

-- Insert Product
-- Values for Products insert will be from form
-- Values for Inventory
INSERT INTO Products (ProductName, Description, Price, SKU, Count, isActive)
VALUES ('Pencil', 'This is litererally the best pencil ever made!', 99.99, '1234567890', 30, 1);

-- SET @productid := SELECT ProductId FROM Products GROUP BY ProductId DESC LIMIT 1;
SELECT @last_id := LAST_INSERT_ID();

INSERT INTO Inventory VALUES (5, 7);
