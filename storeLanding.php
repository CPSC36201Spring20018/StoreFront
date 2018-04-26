<?php
session_start();

 $ID = $_SESSION['STORE_ID'];



?>

<html>
<body>
<h1>Store Front Homepage</h1>
<h2>Welcome <?php echo $ID; ?> </2>
<form action="viewOrders.php" method="post">
  <input type = "submit" name = "ordersview" value = "View Orders">
</form>

<form action="addProduct.php" method="post">
  <input type = "submit" name = "addproduct" value = "Add New Product">
</form>

</body>
</html>
