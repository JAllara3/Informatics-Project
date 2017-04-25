<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
        
        <title>fast shop</title>
    </head>
    
    <body>
        
<?php

?>

<!-- Menu bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="store_one_homepage.php">Home</a></li>
        <li class="active"><a href="store_one_shopping.php">My Cart</a></li>
        <li><a href="store_one_shopping.php">My Order</a></li>
        <li><a href="logout.php">log out</a></li>
     </ul>
  </div>
</nav>

<?php

?>

<div class="row">
    <div class="col-xs-12">
        
<!-- set up html table to show contents -->
<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Product</th>
        <th>Amount</th>
        <th>Total Price</th>
        <th>Status</th>
    </thead>

<?php

	include_once('dbutils.php');
	include_once('config.php');

    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query to get information on the carss from the database
    $query = 'SELECT name, amount, prices, status FROM carts WHERE carts.orderid = 1;';

    // run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['amount']. "</td>";
        echo "<td>" . $row['prices']. "</td>";
        echo "<td>" . $row['status']. "</td>";
        echo "</tr> \n";
    }
?>

</table>
    </div>
</div>

    </body>
</html>