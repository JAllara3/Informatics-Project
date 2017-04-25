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
    
    <body background="1.png">


<!-- Menu bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="store_one_homepage.php">Home</a></li>
        <li><a href="store_one_shopping.php">My Cart</a></li>
        <li><a href="store_one_shopping.php">My Order</a></li>
        <li><a href="logout.php">Log out</a></li>
     </ul>
  </div>
</nav>
        
<!-- Title -->
<div class="row">
    <div class="col-xs-6">
        <h1>Welcome to fast shop!</h1>        
    </div>
</div>
productorder(ordersid, productsid, amount)
<?php if (isset($_POST['submit'])) {
		$amount = $_POST['amount'];
		$productsid = $_POST['id'];
		$max = $_POST[''];
		
	/*    if (!isset($amount)) {
        $errorMessage .= "Please enter the amount.\n";
        $isComplete = false;
    } else if ($amount > $max || $amount < 1) {
        $errorMessage .="Please enter a valid amount.\n";
        $isComplete = false;
    }
	*/
	    if($isComplete) {

        $query = "INSERT INTO carts(cartsid, productsid, storesid, name, amount, prices, status) VALUES (1, $productid, 1, '$name' ,'$amount', '$totalprice', 'not paid');";
        
        // connect to the database
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        // run the insert statement
        $result = queryDB($query, $db);
							}
		$success = "Successfully added to cart: " . $name;
		
		unset($amount);
		}
?>

<div class="row">
    <div class="col-xs-3">
		<p>Categories:</p>
<?php

	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query to get information on the carss from the database
    $query = 'SELECT name, id FROM categories WHERE categories.storesid = 1;';
    
    // run the query
    $result = queryDB($query, $db);
	
	if ($result) {
		$numberofrows = nTuples($result);
		
		if ($numberofrows > 0) {
			$leftSideMenu = "\t<div class='col-xs-2'>\n";
			$leftSideMenu .= "\t\t<table class='table table-hover text-left'>\n";
			
			for($i=0; $i < $numberofrows; $i++) {
				$row = nextTuple($result);
				$leftSideMenu .= "\t\t\t<tr><td><a href='store_one_homepage.php?page=" . $row['id'] . "'>". $row['name'] ."</a></td></tr>\n";
			}
			$leftSideMenu .= "\t\t</table>\n";
			$leftSideMenu .= "\t</div>\n";	
			echo ($leftSideMenu);
		}
	}
	
?>
    </div>
	<div class="col-xs-9">
<?php

    // set up a query to get information on the carss from the database
	if (isset($_GET['page'])) {
		$categoriesid = $_GET['page'];
	} else {
		$categoriesid = 1;
	}
    $query_2 = "SELECT id, name, available, prices, icon FROM products WHERE products.storesid = 1 AND products.categoriesid = $categoriesid;";
    
    // run the query
    $result = queryDB($query_2, $db);
	
	if ($result) {
		$numberofrows = nTuples($result);
		
		if ($numberofrows > 0) {
			for($i=0; $i < $numberofrows; $i++) {
				if($i == 0){
				$centerMenu = "\t<div class='row'>\n";
				$centerMenu .= "\t<div class='col-xs-3'>\n";
				$row = nextTuple($result);
				$centerMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
				$centerMenu .= "\t<br><br>\n";
				$centerMenu .= "\t\t\t<tr><p href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
				$centerMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
					$centerMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
					$centerMenu .= "\t<input type='number' class='form-control' value='1'>\n";
					$centerMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
				$centerMenu .= "\t</form>\n";
				$centerMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
				$centerMenu .= "\t<br><br>\n";
				$centerMenu .= "\t</div>\n";
				echo ($centerMenu);
				} elseif ($i>2 and $i%3 == 0){
					$centerMenu = "\t</div>\n";
					$centerMenu .= "\t<div class='row'>\n";
					$centerMenu .= "\t<div class='col-xs-3'>\n";
					$row = nextTuple($result);
					$centerMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
					$centerMenu .= "\t<br><br>\n";
					$centerMenu .= "\t\t\t<tr><p href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</p></tr>\n";
					$centerMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
					$centerMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
					$centerMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
						$centerMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
						$centerMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
						$centerMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
					$centerMenu .= "\t</form>\n";
					$centerMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
					$centerMenu .= "\t<br><br>\n";
					$centerMenu .= "\t</div>\n";
					echo ($centerMenu);
				} else {
				$centerMenu = "\t<div class='col-xs-3'>\n";
				$row = nextTuple($result);
				$centerMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
				$centerMenu .= "\t<br><br>\n";
				$centerMenu .= "\t\t\t<tr><p href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
				$centerMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
					$centerMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
					$centerMenu .= "\t<input type='number' class='form-control' value='1'>\n";
					$centerMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
				$centerMenu .= "\t</form>\n";
				$centerMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
				$centerMenu .= "\t<br><br>\n";
				$centerMenu .= "\t</div>\n";
				echo ($centerMenu);
			}
			$centerMenu .= "\t</div>\n";
		}
	}
}	
?>
	</div>
</div>

    </body>
</html>