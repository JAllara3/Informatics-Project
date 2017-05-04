<?php
    $header1 = "Manage customer orders here";
    $menuActive = 8;
    include_once('header.php');
?>
<title>Placed Orders</title>

<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    session_start();
    $storeid = $_SESSION['storeid'];
    $query = "SELECT * FROM stores where id =$storeid;";
    $result = queryDB($query, $db);
    $row = nextTuple($result);
    $storename = $row['name'];
    $storebg = $row['bg'];
    
    $_SESSION['id'] = $storeid;
    $_SESSION['name'] = $storename;
    $_SESSION['bg'] = $storebg;
?>
<body background="storepic.jpg">

<div class="row">
    <div class="col-xs-12">
<table class="table table-hover">
    <thead>
        <th>Cart</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Status</th>
    </thead>
	
<?php
	
	include_once('dbutils.php');
	include_once('config.php');
	
	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	if(isset($_SESSION['email'])) {
		$query_3 = "SELECT * FROM productorder WHERE cartid =". $_SESSION['cartid'] ." and status !='cart';";
		$result_3 = queryDB($query_3,$db);
		if (nTuples($result_3) > 0) {
			$row = nextTuple($result_3);
			$query_1 = "SELECT DISTINCT products.name as name, productorder.amount as amount, products.prices as prices, productorder.status as status, productorder.id as Pid, productorder.productsid as Cid FROM products, productorder, carts WHERE productorder.cartid = carts.id AND carts.userid = ". $_SESSION['userid'] ." AND productorder.status != 'cart' AND productorder.productsid = products.id;";
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
				echo "<td>";
		        echo "</tr> \n";
			}
		} else {
			echo "User: ". $_SESSION['email'] .". You haven't place any orders yet! ";
		}
	} else {
			// user not logged in
			if (!isset($_SESSION['cartid'])) {
				echo "Dear Guest! You haven't place any orders yet! ";
				// if we have a shopping cart for a guest
			} else {
				$cartid = $_SESSION['cartid'];
				echo "Dear Guest! View your orders here! ";
				$query_4 = "SELECT DISTINCT products.name as name, productorder.amount as amount, products.prices as prices, productorder.status as status, productorder.id as Pid, productorder.productsid as Cid FROM products, productorder, carts WHERE productorder.cartid =". $_SESSION['cartid'] ." AND productorder.status != 'cart' AND productorder.productsid = products.id;";
				$result_4 = queryDB($query_4, $db);
				while($row = nextTuple($result_4)) {
					$_SESSION['Pid'] = $row['Pid'];
					$Pid = $_SESSION['Pid'];
					$_SESSION['Cid'] = $row['Cid'];
					$Cid = $_SESSION['Cid'];
				    echo "\n <tr>";
				    echo "<td>" . $row['name'] . "</td>";
				    echo "<td>" . $row['amount']. "</td>";
					$money = $row['amount']*$row['prices'];
				    echo "<td>" . $money. "</td>";
				    echo "<td>" . $row['status']. "</td>";
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