
<?php

//assign the input to variables
$fname = preg_replace("/\t|\R/",' ', $_POST['cust_fname']);
$lname = preg_replace("/\t|\R/",' ', $_POST['cust_lname']);
$address = preg_replace("/\t\R/", ' ', $_POST['cust_address']);
//$city = preg_replace("/\t\R/", ' ', $_POST['city']);
//$state = preg_replace("/\t\R/", ' ', $_POST['state']);
$price = preg_replace("/\t\R/", ' ', $_POST['p_price']);
$productid = preg_replace("/\t\R/", ' ', $_POST['p_id']);
$userid = preg_replace("/\t\R/", ' ', $_POST['p_uid']);
$productname = preg_replace("/\t\R/", ' ', $_POST['p_name']);

//open the Address.php
//require('Address.php');
//create a new Address object for the input from the form
//$newAddress = new Address($lname, $name ,$street, $city, $state, $zip, $country);
//adds the address to the mysql db

//open the db
// get credentials
require_once("dbConnect.php");

//get the db
$db = new mysqli(dbHost, dbUsername, dbPassword, dbName);

//if did not successfully open db
if (mysqli_connect_errno()){
  echo '<p>Error: Could not connect to Database.<br/>
  Please Try again later </p>';
  die();
}

$firstname = $fname;
$lastname = $lname;
$orderaddress = $address;
$orderprice = $price;
$orderpid = $productid;
$orderpuid = $userid;

//set up query to insert data
$query = "INSERT INTO Orders (UserId, ProductId, FirstName, LastName, Address)
VALUES (?,?,?,?,?);";
//prepare query
$stmt = $db->prepare($query);
//$namePart = explode(",", $newAddress->name() );
//set parameters for the query
$stmt->bind_param('iisss',$orderpuid,$orderpid, $firstname, $lastname, $orderaddress);
//execute the query
$stmt->execute();
//$stmt->store_result();
//$stmt->
//check to confirm data has been added to the database



if($stmt->affected_rows > 0){

  $qu = "UPDATE
  	Products
  SET
  	Count = (Count - 1)
  WHERE
  	ProductId = ".$orderpid.";";

  $check = $db->prepare($qu);
  $check->execute();

  echo "<h1>Your Order has been recieved!</h1>";
  echo "<h2>Order Details</h2>";

  $que = "SELECT OrderId FROM Orders WHERE FirstName =\"".$firstname."\" AND LastName = \"".$lastname."\" AND ProductId = \"".$orderpid."\"AND UserId = ".$orderpuid." ORDER BY OrderId desc;";

  $min = $db->prepare($que);
  $min->execute();
  $min->store_result();
  $min->bind_result($orderstatusnumber);
  $min->fetch();


  echo "<div class = \"container\" style = \"border: 1px solid black;\">";
  echo "Please save your order ID to check on the status of your order: ".$orderstatusnumber;
  //echo "<h3>Product being purchased:</h3>";
  echo "<h4>Name: ".$firstname." ".$lastname."</h4>";
  echo "<h4>Address: ".$orderaddress."</h4>";
  echo "<h4>Product: ".$productname."</h4>";
  echo "<h4>Price: $".$orderprice."</h4>";

  echo "</div>";

  echo "<button><a href=\"store.php?nid=".$orderpuid."\">Return to store products</a></button>";




}else{
  echo "<p>An error as occured <br/>
  Your order has not been processed correctly. Please try again later.</p>";
  echo "<button><a href=\"store.php?nid=".$orderpuid."\">Return to store products</a></button>";
}

// if(! empty($name)){
//
//     file_put_contents('./data/roster.txt', $newAddress->toTSV()."\n", FILE_APPEND | LOCK_EX);
//
//
// }

//update page
//require('home_page.php');


?>
