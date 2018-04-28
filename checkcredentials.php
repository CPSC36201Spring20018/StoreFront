<?php
session_start();
$username     = trim( preg_replace("/\t|\R/",' ',$_POST['username'])  );
$password        = trim( preg_replace("/\t|\R/",' ',$_POST['password'])    );

$db = new mysqli('localhost','root','','storefront');

if( mysqli_connect_error() == 0 ){
  $query = "SELECT
            UserName, Password, UserId
            FROM users Where
              UserName = '$username'
              AND
              Password = '$password'";

  $result = mysqli_query($db,$query);
  $row = mysqli_fetch_array($result);

  $login_name = $row[0];
  $login_pass = $row[1];
  $login_ID = $row[2];
}
if ($login_name==null) {        //IF QUERY DID NOT RETURN ANYTHING
                          //ACCOUNT DOES NOT EXIST, RETURN TO LOGIN PAGE
  header("Location: http://localhost/362/login.php");
  exit;
}
else {
  $_SESSION['STORE_ID'] = $login_ID;
  $_SESSION['STORE_NAME'] = $username;
  header("Location: http://localhost/362/storeLanding.php");
  exit;
}




?>
