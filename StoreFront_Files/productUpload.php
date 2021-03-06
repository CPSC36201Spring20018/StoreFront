<?php
session_start();
$ID = $_SESSION['STORE_ID'];

$product     = trim( preg_replace("/\t|\R/",' ',$_POST['productname']) );
$desc    = trim( preg_replace("/\t|\R/",' ',$_POST['description'])  );
$price       = trim( preg_replace("/\t|\R/",' ',$_POST['price'])    );
$sku     = trim( preg_replace("/\t|\R/",' ',$_POST['skunumber']) );
$quantity    = trim( preg_replace("/\t|\R/",' ',$_POST['quantity'])  );
$avail       = trim( preg_replace("/\t|\R/",' ',$_POST['status'])    );

// get credentials
require_once("dbConnect.php");

//get the db
$db = new mysqli(dbHost, dbUsername, dbPassword, dbName);
  //Add Store Owner information from accoutCreate.php to database
  if( mysqli_connect_error() == 0 ){
    $query = "INSERT INTO Products SET
                UserId = ?,
                ProductName  = ?,
                Description = ?,
                Price = ?,
                SKU = ?,
                Count = ?,
                isActive = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param('sssssss', $ID, $product, $desc, $price, $sku, $quantity, $avail);
    $stmt->execute();
  }
echo $product . " has been uploaded";

?>

<input type="submit" onclick="location.href='storeLanding.php'" value="Return to Home">
