
<?php

//assign the input to variables
$name = preg_replace("/\t|\R/",' ', $_POST['firstName']);
$lname = preg_replace("/\t|\R/",' ', $_POST['lastName']);
$street = preg_replace("/\t\R/", ' ', $_POST['street']);
$city = preg_replace("/\t\R/", ' ', $_POST['city']);
$state = preg_replace("/\t\R/", ' ', $_POST['state']);
$zip = preg_replace("/\t\R/", ' ', $_POST['zipCode']);
$country = preg_replace("/\t\R/", ' ', $_POST['country']);

//open the Address.php
//require('Address.php');
//create a new Address object for the input from the form
//$newAddress = new Address($lname, $name ,$street, $city, $state, $zip, $country);
//adds the address to the mysql db

//open the db
$db = new mysqli('localhost', 'manager', 'a1258unyma', 'Roster');

//if did not successfully open db
if (mysqli_connect_errno()){
  echo '<p>Error: Could not connect to Database.<br/>
  Please Try again later </p>';
  die();
}

$streetAdd = $street;
$cityAdd = $city;
$stateAdd = $state;
$countryAdd = $country;
$zipAdd = $zip;

//set up query to insert data
$query = "INSERT INTO Roster.TeamRoster (Name_first, Name_last, Street, City, State, Country, ZipCode)
VALUES (?,?,?,?,?,?,?);";
//prepare query
$stmt = $db->prepare($query);
//$namePart = explode(",", $newAddress->name() );
//set parameters for the query
$stmt->bind_param('sssssss',$name,$lname, $streetAdd, $cityAdd, $stateAdd, $countryAdd, $zipAdd );
//execute the query
$stmt->execute();
//$stmt->store_result();
//$stmt->
//check to confirm data has been added to the database
if($stmt->affected_rows > 0){
  echo "<p>New Player added to the Roster</p>";
}else{
  echo "<p>An error as occured <br/>
  The new player was not added.</p>";
}

// if(! empty($name)){
//
//     file_put_contents('./data/roster.txt', $newAddress->toTSV()."\n", FILE_APPEND | LOCK_EX);
//
//
// }
//update page
require('home_page.php');


?>
