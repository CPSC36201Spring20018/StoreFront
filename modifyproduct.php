<?php
session_start();
$productID = htmlspecialchars($_GET["proid"]);
$_SESSION['PRODUCT_ID'] = $productID;

require_once("dbConnect.php");

//get the db
$db = new mysqli(dbHost, dbUsername, dbPassword, dbName);
  //Add Store Owner information from accoutCreate.php to database
  if( mysqli_connect_error() == 0 ){
    $query = "SELECT Products.ProductId, Products.ProductName, Products.Description,
    Products.Price, Products.SKU, Products.Count FROM Products WHERE Products.ProductId =$productID;";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($pnum, $pname, $pdesc, $pprice, $psku, $pcount);
  }
  $stmt->data_seek(0); //
  while($stmt->fetch()){
    $pronum = $pnum;
    $proname = $pname;
    $prodesc = $pdesc;
    $proprice = $pprice;
    $prosku = $psku;
    $procount = $pcount;
  }
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>

<h1>Modify Product</h1>
<form action="uploadMod.php" method="post">
<tr>
  <td style="text-align: right; background: lightblue;">Product Name: </td>
 <td><input type="text" name="productname" value=<?php echo $proname?> required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Description  </td>
 <td><input type="textarea" name="description" value=<?php echo $prodesc?> required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Price  </td>
 <td><input type="text" name="price" value=<?php echo $proprice?> required="required" size="25" /></td>
</tr>
<br>

<tr>
  <td style="text-align: right; background: lightblue;">SKU  </td>
 <td><input type="text" name="skunumber" value=<?php echo $prosku?> required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Quanity  </td>
 <td><input type="text" name="quantity" value=<?php echo $procount?> required="required" size="25" /></td>
</tr>
<br>
<input type ="submit" name = "add_product" value = "Confirm Changes">

<br>
</form>
