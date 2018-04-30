<?php
session_start();
$storeName     = trim( preg_replace("/\t|\R/",' ',$_POST['store_name']) );
$username     = trim( preg_replace("/\t|\R/",' ',$_POST['username'])  );
$password        = trim( preg_replace("/\t|\R/",' ',$_POST['password'])    );

// get credentials
require_once("dbConnect.php");

//get the db
$db = new mysqli(dbHost, dbUsername, dbPassword, dbName);
  //Add Store Owner information from accoutCreate.php to database
  if( mysqli_connect_error() == 0 ){
    $query = "INSERT INTO Users SET
                UserName = ?,
                Password  = ?,
                StoreName = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param('sss', $username, $password, $storeName);
    $stmt->execute();
  }

if( mysqli_connect_error() == 0 ){
  //Grab userID from database for later use
  $query = "SELECT
            UserId
            FROM Users Where
              UserName = '$username'";

  $result = mysqli_query($db,$query);
  $row = mysqli_fetch_array($result);

  $salt = $row[0];
  //store userID to session
  $_SESSION['STORE_ID'] = $salt;
  $_SESSION['STORE_NAME'] = $storeName;
}

header("Location:storeLanding.php");
exit;
?>
