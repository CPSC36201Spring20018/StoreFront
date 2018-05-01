<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </head>


    <body>
      <div class = "container">
      <?php
      // get credentials
      require_once("dbConnect.php");

      //get the db
      $db = new mysqli(dbHost, dbUsername, dbPassword, dbName);;

        //if unable to connect to the db
        if(mysqli_connect_errno()){
          echo '<p>Error: Could not connect to Database.<br/>
          Please Try again later </p>';
          die();
        }

        //use userID for get
        $productId = htmlspecialchars($_GET["proid"]);
        $storeId = htmlspecialchars($_GET["sid"]);
        //echo $storeID;

        $query = "SELECT Products.ProductName, Products.Price, Products.SKU, Users.StoreName, Products.ProductId, Products.UserId from Products LEFT JOIN Users ON Products.UserId = Users.UserId WHERE Products.productId =".$productId.";";

        $stmt = $db->prepare($query);

        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($pname, $pprice, $psku, $storenme, $pid, $uid);

        $stmt->fetch(); // gets the result

        echo "<h2>".$storenme." Purchase</h2>"; //outputs the name of the store

        echo "<div class = \"container\" style = \"border: 1px solid black;\">";
        echo "<h3>Product being purchased:</h3>";

        echo "<h4>Name: ".$pname."</h4>";
        echo "<h4>Price: $".$pprice."</h4>";
        echo "<h4>Sku: ".$psku."</h4>";
        echo "</div>";

        echo "</br>";

      ?>

      <div class = "container">
        <h3></h3>
      </div>

        <div class = "container">
          <form action = "confirmPurchase.php" method = "post">
                <div class="form-group">
                    <label for="cust_fname">First Name</label>
                    <input class="form-control" name="cust_fname" required = "required" />
                </div>
                <div class="form-group">
                    <label for="cust_lname">Last Name</label>
                    <input class="form-control" name="cust_lname" required = "required" />
                </div>
                <div class="form-group">
                    <label for="cust_address">Address (Full)</label>
                    <input class="form-control" name="cust_address" required = "required"/>
                </div>
                <?php
                  $stmt->data_seek(0);
                  $stmt->fetch(); // gets the result
                  //echo "<input type = \"hidden\" name = \"p_name\" value =\"".$pname."\">";
                  echo "<input type = \"hidden\"  name = \"p_price\" value=\"".$pprice."\">";
                  echo "<input type = \"hidden\"  name = \"p_id\" value=\"".$pid."\">";
                  echo "<input type = \"hidden\"  name = \"p_uid\" value=\"".$uid."\">";
                  echo "<input type = \"hidden\"  name = \"p_name\" value=\"".$pname."\">";
                ?>

                <input class="form-control" type="Submit" value="Submit Purchase" />
            </form>

          <?php //get all the products of this storefront and add Buy buttons for purchasing them
          //   $query = "SELECT Products.ProductId, Products.ProductName, Products.Description,
          //   Products.Price, Products.SKU, Products.Count FROM products WHERE Products.UserId = 1 AND Products.isActive = 1;";
          //
          //   $stmt = $db->prepare($query);
          //
          //   $stmt->execute();
          //
          //   $stmt->store_result();
          //
          //   $stmt->bind_result($pnum, $pname, $pdesc, $pprice, $psku, $pcount);
          //
          // ?>

          <!-- <table class="table">
              <thead>
                  <tr>
                      <th>Products ID</th>
                      <th>Product Name</th>
                      <th>Product Description</th>
                      <th>Product Sku</th>
                      <th>Product Price</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody> -->
                <?php
                //   //$count = 1;
                //   $stmt->data_seek(0); //
                //
                //   while($stmt->fetch()){
                //     $pronum = $pnum;
                //     $proname = $pname;
                //     $prodesc = $pdesc;
                //     $proprice = $pprice;
                //     $prosku = $psku;
                //     $procount = $pcount;
                //     // $sid = $uid; //userid used for get for store to load the items
                //
                //     echo "<tr>";
                //
                //     echo "<td>".$pronum."</td>";
                //     echo "<td>".$proname."</td>";
                //     echo "<td>".$prodesc."</td>";
                //     echo "<td>".$prosku."</td>";
                //     echo "<td>$".$proprice."</td>";
                //
                //     if($pcount != 0){
                //       echo "<td width=\"100px\"><button><a href=\"buy.php?proid=".$pnum."&sid=".$storeID."\">Purchase</a></button></td>";
                //     }else{
                //       echo "<td width=\"100px\"><button diabled><a href=\"buy.php?proid=".$pronum."&sid=".$storeID."\">Purchase</a></button></td>";
                //     }
                //
                //
                //
                //     echo "</tr>";
                //   }
                //
                // $db->close();
                ?>
              <!-- </tbody>
          </table> -->


        </div>
      </div>
    </body>
  </html>
