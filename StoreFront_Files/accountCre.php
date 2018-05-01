<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</head>
<body>

<h1>Store Owner Account Creation</h1>
<form action="addNewStoreOwner.php" method="post">
<tr>
  <td style="text-align: right; background: lightblue;">Store Name</td>
 <td><input type="text" name="store_name" value="" required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Username  </td>
 <td><input type="text" name="username" value="" required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Password  </td>
 <td><input type="password" name="password" value="" required="required" size="25" /></td>
</tr>
<br>
<input type ="submit" name = "acc_creation" value = "Create Account">
</form>


</body>
</html>
