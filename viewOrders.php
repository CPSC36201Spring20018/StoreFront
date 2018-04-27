<?php
session_start();
$ID = $_SESSION['STORE_ID'];

$db = new mysqli('localhost','root','','storefront');
  if( mysqli_connect_error() == 0 ){
    $query = "SELECT Orders.ProductId, Orders.Status,
                     Orders.FirstName, Orders.LastName,
                     Orders.Address FROM orders WHERE
                  ProductID = '$ID'";

    $stmt = $db->prepare($query);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($prod, $stat,$first, $last, $address);

  }
?>
<h1>Orders List</h1>

<?php
$stmt->data_seek(0);
while ($stmt->fetch()) {
  $input = "                             ";
  $ProIDView = $prod;
  $StatusView = $stat;
  $FirstNameView = $first;
  $LastNameView = $last;
  $AddressView = $address;




  echo "Product ID:  " . str_pad($input, 10) . $ProIDView . str_pad($input, 10) . "Status:  " . $StatusView . str_pad($input, 10) ."Customer Name:  ". $FirstNameView . $LastNameView . str_pad($input, 10) . "Address:  " . $AddressView;
}

?>
