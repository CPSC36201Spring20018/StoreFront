<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<?php
session_start();
$ID = $_SESSION['STORE_ID'];

// get credentials
require_once("dbConnect.php");

//get the db
$db = new mysqli(dbHost, dbUsername, dbPassword, dbName);
  if( mysqli_connect_error() == 0 ){
    $query = "SELECT Orders.ProductId, Orders.Status,
                     Orders.FirstName, Orders.LastName,
                     Orders.Address FROM Orders WHERE
                  UserID = '$ID'";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($prod, $stat,$first, $last, $address);

  }
?>
<h1>Orders List</h1>

<table class="table">
    <thead>
        <tr>
            <th>Products ID</th>
            <th>Status</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Address</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
      <?php
        //$count = 1;
        $stmt->data_seek(0); //
        while($stmt->fetch()){
          $pronum = $prod;
          $pstatus = $stat;
          $pfirst = $first;
          $plast = $last;
          $paddress = $address;

          // $sid = $uid; //userid used for get for store to load the items
          echo "<tr>";
          echo "<td>".$pronum."</td>";
          echo "<td>".$pstatus."</td>";
          echo "<td>".$pfirst."</td>";
          echo "<td>".$plast."</td>";
          echo "<td>".$paddress."</td>";
          echo "</tr>";
        }
      $db->close();
      ?>
    </tbody>
</table>
