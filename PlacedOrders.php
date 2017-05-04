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
        <th>User</th>
        <th>Amount</th>
        <th>Price</th>
        <th>Status</th>
		<th>Updates</th>
    </thead>
	
<?php
	
	include_once('dbutils.php');
	include_once('config.php');
	
	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
		$query_3 = "SELECT * FROM productorder WHERE status !='cart';";
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
		        $money = $row['amount']*$row['prices'];
				echo "<td>" . $money. "</td>";
		        echo "<td>" . $row['status']. "</td>";
				echo "<td><a href='edit_status.php?id=$Cid'>Update Status</a></td>";
				echo "<td>";
		        echo "</tr> \n";
			}
		}

?>


</table>
    </div>
</div>
    
</body>
</html>