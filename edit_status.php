
<?php
    $header1 = "Manage customer orders here";
    $menuActive = 8;
    include_once('header.php');
?>


<title>Updates</title>
<body background="storepic.jpg">

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

<?php

?>


<?php
    include_once('config.php');
    include_once('dbutils.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $id = $_SESSION['Cid'];
    
    
    $cartid = $_SESSION['cartid'];
    
    $query = "SELECT * from products where id = $id;";
    
    $result = queryDB($query,$db);
    
    while ($row = nextTuple($result)) {
			echo "\t<div class='row'>\n";
			echo "\t<div class='col-xs-6' align = 'center'>\n";
			echo "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
			echo "\t<br><br>\n";
			echo "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
			echo "\t\t\t<tr><p>Available amount: ".$row['available']."</p></tr>\n";
			echo "\t\t\t<tr><p>Price: ".$row['prices']."</p></tr>\n";
			echo "\t<form action='edit_status.php' method='post'>\n";
			echo "\t<label for='amount'>Change the status:</label>\n";
			    echo "\t<input type='text' class='form-control' value='ordered' name='status'>\n";
			    echo "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
				echo "\t<button type='submit' class='btn btn-default' name='update'>Update</button><br>\n";
			echo "\t</form>\n";
			echo "\t<br><br>\n";
			echo "\t</div>\n";
		}
    

    if (isset($_POST['update'])){
        
        $status = $_POST['status'];
        
        $query_8 = "UPDATE productorder SET status='$status' WHERE productsid = $id AND cartid = $cartid;";
		    
		$result_8 = queryDB($query_8,$db);
        
        header('Location: PlacedOrders.php');       
    }
?>

    </body>
</html>