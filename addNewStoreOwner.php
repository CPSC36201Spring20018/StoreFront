<?php
session_start();
$storeName     = trim( preg_replace("/\t|\R/",' ',$_POST['store_name']) );
$username     = trim( preg_replace("/\t|\R/",' ',$_POST['username'])  );
$password        = trim( preg_replace("/\t|\R/",' ',$_POST['password'])    );

$db = new mysqli('localhost','root','','storefront');
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
            FROM users Where
              UserName = '$username'";

  $result = mysqli_query($db,$query);
  $row = mysqli_fetch_array($result);

  $salt = $row[0];
  //store userID to session 
  $_SESSION['STORE_ID'] = $salt;
}

header("Location: http://localhost/362/storeLanding.php");
exit;
?>
