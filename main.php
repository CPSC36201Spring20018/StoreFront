<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        // require('team.php');
        // require('../league/league.php');

        // $conn->close()
        ?>
        <div class="container">
            <h2> Stores to shop </h2>
            <?php
            // get credentials
            require_once("dbConnect.php");

            //get the db
            $db = new mysqli(dbHost, dbUsername, dbPassword, dbName);
            //$db = new mysqli('localhost', 'root', 'Eagles79!', 'StoreFront');

            //if unable to connect to the db
            if(mysqli_connect_errno()){
              echo '<p>Error: Could not connect to Database.<br/>
              Please Try again later </p>';
              die();
            }

            //prep query to bring up the list of stores that are available to shop at
            $query = "SELECT Users.StoreName, Users.UserId FROM Users ORDER BY Users.StoreName;";

            $stmt = $db->prepare($query);

            $stmt->execute();

            $stmt->store_result();

            $stmt->bind_result($strnm, $uid); //stores the store name available

          //  $numrow = $stmt->num_rows;
            ?>

            <?php
            //  echo "<p>Number of records: ".$numrw."</p>";
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Stores</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    //$count = 1;
                    $stmt->data_seek(0); //

                    while($stmt->fetch()){
                      $storeName = $strnm; // takes the store name
                      $sid = $uid; //userid used for get for store to load the items

                      echo "<tr>";

                      echo "<td>".$storeName."</td>";
                      echo "<td width=\"100px\"><button><a href=\"store.php?nid=".$sid."\">Visit Store</a></button></td>";
                    }

                  $db->close();
                  ?>
                </tbody>
            </table>



        </div>
    </body>
</html>
