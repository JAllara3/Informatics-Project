<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
        <title>fast shop</title>
    
    <body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "store_one_page.php" ><strong>FastShop</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="store_one_homepage.php">Home</a></li>
                <li class="active"><a href="store_one_shopping.php">My Cart</a></li>
                <li><a href="store_one_shopping.php">My Order</a></li>
                <li><a href="logout.php">Log out</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href = "CLogin.php">Customer Login</a></li>
                        <li><a href = "GLogin.php">Manager Login</a></li>
                        <li><a href = "logout.php">Log Out</a></li>
                        <li><a href = "Csignup.php">SignUp</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

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
    $query = "SELECT cartid, status FROM carts WHERE userid = '". $_SESSION['userid'] ."';";

    // run the query
    $result = queryDB($query, $db);
	
	$query_1 = "SELECT * FROM productorder WHERE cartid = ";
	
	$result_1 = queryDB($query_1, $db);
    
    while($row = nextTuple($result_1)) {
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