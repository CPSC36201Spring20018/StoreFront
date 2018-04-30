<?php
  // get credentials
  require_once("dbConnect.php");

  //get the db
  $db = new mysqli(dbHost, dbUsername, dbPassword, dbName);

  //if unable to connect to the db
  if(mysqli_connect_errno()){
    echo '<p>Error: Could not connect to Database.<br/>
    Please Try again later </p>';
    die();
  }
  //use userID for get
  $productId = htmlspecialchars($_GET["proid"]);
  $isActiveId = htmlspecialchars($_GET["active"]);
  //echo $storeID;
  $query = "UPDATE Products SET
             isActive = ?
             WHERE
             ProductId = ?;";
  $stmt = $db->prepare($query);
  //Flip active status, if 0 -> 1, if 1->0
  $isActiveId = (int)!$isActiveId;
  echo $isActiveId;
  $stmt->bind_param('ss',$isActiveId, $productId);
  $stmt->execute();
  header("Location:storeLanding.php");
  exit;
  ?>
