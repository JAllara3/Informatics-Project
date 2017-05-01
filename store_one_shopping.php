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
        <title>Cart</title>

<?php
	
	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	session_start();

    $storeid = $_SESSION['id'];
	
    $query = "SELECT * from stores where id=$storeid;";
	
    $result = queryDB($query, $db);
	
    $row = nextTuple($result);
	
    $storename = $row['name'];
	
	$storebg = $row['bg'];
	
	$_SESSION['id'] = $storeid;
	$_SESSION['name'] = $storename;
	$_SESSION['bg'] = $storebg;
?>
	
	<body style = "background:url('<?php echo $storebg;?>'); background-repeat:no-repeat; background-size:100% 100%">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "union.php" ><strong>The Union</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="store_one_homepage.php?=<?php echo $storeid;?>">Home</a></li>
                <li class="active"><a href="store_one_shopping.php">My Cart</a></li>
                <li><a href="store_one_orders.php">My Order</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href = "CLogin.php">Customer Login</a></li>
                        <li><a href = "GLogin.php">Manager Login</a></li>
                        <li><a href = "logout.php">Log Out</a></li>
                        <li><a href = "Csignup.php">Sign Up</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

	
<?php

	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	session_start();
	
	if(isset($_SESSION['email'])) {
		echo "Current account: ". $_SESSION['email'] ."";
		$query = "SELECT id as userid FROM users WHERE email = '". $_SESSION['email'] ."';";
		$result = queryDB($query,$db);
		$row = nextTuple($result);
		$_SESSION['userid'] = $row['userid'];
		$userid = $_SESSION['userid'];
		$cartid = $_SESSION['cartid'];
	}
?>

<div class="row">
    <div class="col-xs-12">
        
<!-- set up html table to show contents -->
<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Product</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Status</th>
		<th>Delete</th>
		<th>Update</th>
    </thead>

<?php

	include_once('dbutils.php');
	include_once('config.php');

    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	if(isset($_SESSION['email'])) {
		$query_3 = "SELECT * FROM carts WHERE userid =". $_SESSION['userid'] ." and status='cart';";
		$result_3 = queryDB($query_3,$db);
		if (nTuples($result_3) > 0) {
			$row = nextTuple($result_3);
			$query_1 = "SELECT DISTINCT products.name as name, productorder.amount as amount, products.prices as prices, carts.status as status, productorder.id as Pid, productorder.productsid as Cid FROM products, productorder, carts WHERE productorder.cartid = carts.id AND carts.userid = ". $_SESSION['userid'] ." AND productorder.productsid = products.id;";
			$result_1 = queryDB($query_1, $db);
		    while($row = nextTuple($result_1)) {
				$_SESSION['Pid'] = $row['Pid'];
				$Pid = $_SESSION['Pid'];
				$_SESSION['Cid'] = $row['Cid'];
				$Cid = $_SESSION['Cid'];
		        echo "\n <tr>";
		        echo "<td>" . $row['name'] . "</td>";
		        echo "<td>" . $row['amount']. "</td>";
		        echo "<td>" . $row['prices']. "</td>";
		        echo "<td>" . $row['status']. "</td>"; 
				echo "<td><a href='delete_cart_product.php?id=$Pid'>Delete</a></td>";
				echo "<td><a href='edit_cart.php?id=$Cid'>Edit</a></td>";
				echo "<td><form action='pay.php?id=$Pid' method='post'>";
				echo "<td><button type='submit' class='btn btn-default' name='placeorder'>Place Order</button></td>";
				echo "</form></td>";
				echo "<td>";
		        echo "</tr> \n";
			}
		} else {
			echo "User: ". $_SESSION['email'] .". Your Shopping Cart is empty! Add some items first! ";
		}
	} else {
			// user not logged in
			if (!isset($_SESSION['cartid'])) {
				echo "Dear Guest! Your Shopping Cart is empty! ";
				// if we have a shopping cart for a guest
			} else {
				$cartid = $_SESSION['cartid'];
				echo "Dear Guest! View your shopping cart here! ";
				$query_4 = "SELECT DISTINCT products.name as name, productorder.amount as amount, products.prices as prices, carts.status as status, productorder.id as Pid, productorder.productsid as Cid FROM products, productorder, carts WHERE productorder.cartid =". $_SESSION['cartid'] ." AND productorder.productsid = products.id;";
				$result_4 = queryDB($query_4, $db);
				while($row = nextTuple($result_4)) {
					$_SESSION['Pid'] = $row['Pid'];
					$Pid = $_SESSION['Pid'];
					$_SESSION['Cid'] = $row['Cid'];
					$Cid = $_SESSION['Cid'];
				    echo "\n <tr>";
				    echo "<td>" . $row['name'] . "</td>";
				    echo "<td>" . $row['amount']. "</td>";
				    echo "<td>" . $row['prices']. "</td>";
				    echo "<td>" . $row['status']. "</td>";
					echo "<td><a href='delete_cart_product.php?id=$Pid'>Delete</a></td>";
					echo "<td><a href='edit_cart.php?id=$Cid'>Edit</a></td>";
					echo "<td><form action='pay.php?id=$Pid' method='post'>";
					echo "<td><button type='submit' class='btn btn-default' name='placeorder'>Place Order</button></td>";
					echo "</form></td>";
					echo "<td>";
				    echo "</tr> \n";
				}
			}	
		}
?>


</table>
    </div>
</div>

    </body>
</html>