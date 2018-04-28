<?php
session_start();
$productID = $_SESSION['PRODUCT_ID'];

$product     = trim( preg_replace("/\t|\R/",' ',$_POST['productname']) );
$desc    = trim( preg_replace("/\t|\R/",' ',$_POST['description'])  );
$price       = trim( preg_replace("/\t|\R/",' ',$_POST['price'])    );
$sku     = trim( preg_replace("/\t|\R/",' ',$_POST['skunumber']) );
$quantity    = trim( preg_replace("/\t|\R/",' ',$_POST['quantity'])  );

$db = new mysqli('localhost','root','','storefront');
  //Add Store Owner information from accoutCreate.php to database
  if( mysqli_connect_error() == 0 ){
    $query = "UPDATE products SET
	             ProductName = ?,
	             Description = ?,
	             Price = ?,
	             SKU = ?,
               Count = ?
               WHERE
               ProductId = ?;";

    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssss', $product, $desc, $price, $sku, $quantity, $productID);
    $stmt->execute();
  }
  header("Location: http://localhost/362/storeLanding.php");
  exit;
?>
