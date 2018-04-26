<h1>Add Product</h1>
<form action="addNewStoreOwner.php" method="post">
<tr>
  <td style="text-align: right; background: lightblue;">Product Name: </td>
 <td><input type="text" name="productname" value="" required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Description  </td>
 <td><input type="textarea" name="description" value="" required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Price  </td>
 <td><input type="text" name="price" value="" required="required" size="25" /></td>
</tr>
<br>

<tr>
  <td style="text-align: right; background: lightblue;">SKU  </td>
 <td><input type="text" name="skunumber" value="" required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Quanity  </td>
 <td><input type="text" name="quantity" value="" required="required" size="25" /></td>
</tr>
<br>
<tr>
  <td style="text-align: right; background: lightblue;">Availability  </td>
<input type ="hidden" name=status value="0"/>
<input type="checkbox" name=status value="1"/>
</tr>
<br>
</form>
