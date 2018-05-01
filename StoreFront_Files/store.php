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
      $db = new mysqli(dbHost, dbUsername, dbPassword, dbName);

        //if unable to connect to the db
        if(mysqli_connect_errno()){
          echo '<p>Error: Could not connect to Database.<br/>
          Please Try again later </p>';
          die();
        }

        //use userID for get
        $storeID = htmlspecialchars($_GET["nid"]);
        //echo $storeID;

        $query = "SELECT Users.StoreName from Users WHERE Users.UserId = ".$storeID.";";

        $stmt = $db->prepare($query);

        $stmt->execute();

        $stmt->store_result();

        $stmt->bind_result($storeName);

        $stmt->fetch(); // gets the result

        echo "<h2>".$storeName."</h2>"; //outputs the name of the store
      ?>
        <div class = "container">
            <input type="submit" onclick="location.href='main.php'" value="Go Back to Main" style="float: right;">


          <?php //get all the products of this storefront and add Buy buttons for purchasing them
            $query = "SELECT Products.ProductId, Products.ProductName, Products.Description,
            Products.Price, Products.SKU, Products.Count FROM Products WHERE Products.UserId =".$storeID." AND Products.isActive = 1;";

            $stmt = $db->prepare($query);

            $stmt->execute();

            $stmt->store_result();

            $stmt->bind_result($pnum, $pname, $pdesc, $pprice, $psku, $pcount);

          ?>

          <table class="table">
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
              <tbody>
                <?php
                  //$count = 1;
                  $stmt->data_seek(0); //

                  while($stmt->fetch()){
                    $pronum = $pnum;
                    $proname = $pname;
                    $prodesc = $pdesc;
                    $proprice = $pprice;
                    $prosku = $psku;
                    $procount = $pcount;
                    // $sid = $uid; //userid used for get for store to load the items

                    echo "<tr>";

                    echo "<td>".$pronum."</td>";
                    echo "<td>".$proname."</td>";
                    echo "<td>".$prodesc."</td>";
                    echo "<td>".$prosku."</td>";
                    echo "<td>$".$proprice."</td>";

                    if($pcount != 0){
                      echo "<td width=\"100px\"><button><a href=\"buy.php?proid=".$pronum."&sid=".$storeID."\">Purchase</a></button></td>";
                    }else{
                      echo "<td width=\"100px\"><button diabled>SOLD OUT</button></td>";
                    }



                    echo "</tr>";
                  }

                $db->close();
                ?>
              </tbody>
          </table>


        </div>
      </div>
    </body>
  </html>
