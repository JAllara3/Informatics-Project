<html>
    <head>
<!-- Bootstrap links -->

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
	
        <title>The Subunion</title>
		
<?php
	
	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	session_start();
	
	if (isset($_POST['storeid'])){
		$storeid = $_POST['storeid'];
	
		$query = "SELECT * from stores where id=$storeid;";
	
	    $result = queryDB($query, $db);
		
	    $row = nextTuple($result);
		
	    $storename = $row['name'];
	
		$storebg = $row['bg'];
		
		$_SESSION['storeid'] = $storeid;
		
		$storeid = $_SESSION['storeid'];
	} else {
	    $storeid = $_SESSION['storeid'];
	
		$query = "SELECT * from stores where id=$storeid;";
	
		$result = queryDB($query, $db);
	
		$row = nextTuple($result);
	
		$storename = $row['name'];
	
		$storebg = $row['bg'];
		
		$_SESSION['storeid'] = $storeid;
		
		$storeid = $_SESSION['storeid'];
	}
	
	$_SESSION['id'] = $storeid;
	$_SESSION['name'] = $storename;
	$_SESSION['bg'] = $storebg;
?>

	<body style = "background:url('<?php echo $storebg;?>'); background-repeat:no-repeat; background-size:100% 100%">


    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "union.php" ><strong>The Union</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="store_one_homepage.php?id=<?php echo $storeid;?>">Home</a></li>
                <li><a href="store_one_shopping.php">My Cart</a></li>
                <li><a href="store_one_orders.php">My Order</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href ="CLogin.php">Customer Login</a></li>
                        <li><a href ="GLogin.php">Manager Login</a></li>
                        <li><a href="logout.php">Log Out</a></li>
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
	} else {
		echo "Welcome GUEST! ";
	};
	
?>	

<?php
	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	if (isset($_POST['submit'])) {
		$amount = $_POST['amount'];
		$productsid = $_POST['id'];

			if(isset($_SESSION['email'])) {
				$query_3 = "SELECT * FROM carts WHERE userid =". $_SESSION['userid'] .";";
				$result_3 = queryDB($query_3,$db);
				if (nTuples($result_3) > 0) {
					$row = nextTuple($result_3);
					$_SESSION['cartid'] = $row['id'];
					$cartid = $_SESSION['cartid'];
				} else {
					$query_4 = "INSERT INTO carts(userid) VALUES (". $_SESSION['userid'] .");";
					$result_4 = queryDB($query_4,$db);
					$query_7 = "SELECT max(id) as NEW from carts;";
					$result_7 = queryDB($query_7,$db);
					$row = nextTuple($result_7);
					$lastid = $row['NEW'];
					$cartid = $lastid;
					$_SESSION['cartid'] = $cartid;
					$cartid = $_SESSION['cartid'];
				}
			
			} else {
					// user not logged in
					if (isset($_SESSION['cartid'])) {
					// if we have a shopping cart for a guest
						$cartid = $_SESSION['cartid'];
						$userid = $_SESSION['userid'];
					} else {
						$query_8 = "SELECT max(id) as NEW from carts;";
						$result_8 = queryDB($query_8,$db);
						$row = nextTuple($result_8);
						$lastid = $row['NEW'];
						$_SESSION['cartid'] = $lastid;
					 	$cartid = $_SESSION['cartid'];
						$query_9 = "SELECT max(userid) as USER from carts;";
						$result_9 = queryDB($query_9,$db);
						$row = nextTuple($result_9);
						$lastuserid = $row['USER'];
						$_SESSION['userid'] = $lastuserid;
					 	$userid = $_SESSION['userid'];
					}	
				}
				$query_6 = "INSERT INTO productorder(cartid, productsid, amount, status) VALUES ($cartid, $productsid, $amount, 'cart');";
				//$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
				$result_6 = queryDB($query_6,$db);
			
				$success = "Your items has been successfully added to cart!";

				unset($amount, $productsid);
		}
	
?>


<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($success)) {
        // for successes after the form was submitted
        echo '<div class="alert alert-success" role="alert">';
        echo ($success);
        echo '</div>';
    } elseif (isset($_GET['successmessage'])) {
        // for successes from another form that redirects users to this page
        echo '<div class="alert alert-success" role="alert">';
        echo ($_GET['successmessage']);
        echo '</div>';        
    }
?>            
    </div>
</div>


<div class="row">
    <div class="col-xs-3">
		<h2>Categories:</h2>

<?php

	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query to get information on the carss from the database
    $query = 'SELECT name as catname, id as catid FROM categories WHERE categories.storesid = '. $storeid .';';
    
    // run the query
    $result = queryDB($query, $db);
	
	if ($result) {
		$numberofrows = nTuples($result);
		
		if ($numberofrows > 0) {
			$leftSideMenu = "\t<div class='col-xs-2'>\n";
			$leftSideMenu .= "\t\t<table class='table table-hover text-left'>\n";
			
			for($i=0; $i < $numberofrows; $i++) {
				$row = nextTuple($result);
				$leftSideMenu .= "\t\t\t<tr><td><a href='store_one_homepage.php?page=" . $row['catid'] . "'>". $row['catname'] ."</a></td></tr>\n";
			}
			$leftSideMenu .= "\t\t</table>\n";
			$leftSideMenu .= "\t</div>\n";	
			echo ($leftSideMenu);
		}
	}
	
?>
    </div>
	<div class="col-xs-9">
		<!-- Title -->
		<div class="row">
		    <div class="col-xs-12">
		        <h1>Welcome to <?php echo $storename;?>!</h1>
		    </div>
		</div>
		
		<div class = "row">
			<div style="text-align:right">
				<form action="store_one_homepage.php" method='post'>
					<input type="search" name="search">
					<button type='submit' class='btn btn-default' name='searchyes'>Search</button>
				</form>
			</div>
		</div>

<?php
	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	if (isset($_POST['searchyes'])) {
		$search=$_POST['search'];
		
		$query_12 = "SELECT DISTINCT * FROM products WHERE name LIKE '%$search%' and products.storesid = $storeid GROUP BY (name);"; 
		$result_12 = queryDB($query_12,$db);
		$numberofrows_1 = nTuples($result_12);
		
				if ($numberofrows_1 > 0) {
					echo "Search results:";
					for($i=0; $i < $numberofrows_1; $i++) {
						if($i == 0){
							$row = nextTuple($result_12);
							$searchMenu .= "\t<div class='row'>\n";
							$searchMenu .= "\t<div class='col-xs-4'>\n";
							$searchMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
							$searchMenu .= "\t<br><br>\n";
							$searchMenu .= "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
							$searchMenu .= "\t\t\t<tr><p>Available amount: ".$row['available']."</p></tr>\n";
							$searchMenu .= "\t\t\t<tr><p>Price: ".$row['prices']."</p></tr>\n";
							$searchMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
								$searchMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
								$searchMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
								$searchMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
								$searchMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
							$searchMenu .= "\t</form>\n";
							$searchMenu .= "\t<br><br>\n";
							$searchMenu .= "\t</div>\n";
							echo ($searchMenu);
						} elseif ($i>2 and $i%3 == 0){
								$row = nextTuple($result_12);
								$searchMenu = "\t</div>\n";
								$searchMenu .= "\t<div class='row'>\n";
								$searchMenu .= "\t<div class='col-xs-4'>\n";
								$searchMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
								$searchMenu .= "\t<br><br>\n";
								$searchMenu .= "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
								$searchMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
								$searchMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
								$searchMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
									$searchMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
									$searchMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
									$searchMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
									$searchMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
								$searchMenu .= "\t</form>\n";
								$searchMenu .= "\t<br><br>\n";
								$searchMenu .= "\t</div>\n";
								echo ($searchMenu);
						} else {
							$row = nextTuple($result_12);
							$searchMenu = "\t<div class='col-xs-4'>\n";
							$searchMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
							$searchMenu .= "\t<br><br>\n";
							$searchMenu .= "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
							$searchMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
							$searchMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
							$searchMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
								$searchMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
								$searchMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
								$searchMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
								$searchMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
							$searchMenu .= "\t</form>\n";
							$searchMenu .= "\t<br><br>\n";
							$searchMenu .= "\t</div>\n";
							echo ($searchMenu);
						}
						$searchMenu .= "\t</div>\n";
					
					}
					echo "\t<br><br>\n";
				} else {
					echo "Sorry, we currently don't have what you want.";
					echo "\t<br><br>\n";
				}
				unset($search);
				echo "\t<br><br>\n";
		}
?>		

<?php

    // set up a query to get information on the carss from the database
	if (isset($_GET['page'])) {
		$categoriesid = $_GET['page'];
	} else {
		$query_13 = "SELECT MIN(id) as Front FROM categories WHERE categories.storesid = $storeid";
		$result_13 = queryDB($query_13, $db);
		$row = nextTuple($result_13);
		$front = $row['Front'];
		$categoriesid = $front;
	}
    $query_2 = "SELECT id, name, available, prices, icon FROM products WHERE products.storesid = $storeid AND products.categoriesid = $categoriesid;";
    
    // run the query
    $result = queryDB($query_2, $db);
	
	if (isset($_POST['searchyes'])) {
			echo "\t<div class='row'>\n";
			echo "\t<div class='col-xs-3'>\n";
			echo "Also check on our other products below ↓";
			echo "\t</div>\n";
			echo "\t</div>\n";
			unset ($searchyes);
	}
	
	if ($result) {
		$numberofrows = nTuples($result);
		
		echo "\t<br><br>\n";
		if ($numberofrows > 0) {
			for($i=0; $i < $numberofrows; $i++) {
				if($i == 0){
				$centerMenu = "\t<br><br>\n";
				$centerMenu .= "\t<div class='row'>\n";
				$centerMenu .= "\t<div class='col-xs-3'>\n";
				$row = nextTuple($result);
				$centerMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
				$centerMenu .= "\t<br><br>\n";
				$centerMenu .= "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>Available amount: ".$row['available']."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>Price: ".$row['prices']."</p></tr>\n";
				$centerMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
					$centerMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
					$centerMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
					$centerMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
					$centerMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
				$centerMenu .= "\t</form>\n";
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
					$centerMenu .= "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
					$centerMenu .= "\t\t\t<tr><p>Available amount: ".$row['available']."</p></tr>\n";
					$centerMenu .= "\t\t\t<tr><p>Price: ".$row['prices']."</p></tr>\n";
					$centerMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
						$centerMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
						$centerMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
						$centerMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
						$centerMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
					$centerMenu .= "\t</form>\n";
					$centerMenu .= "\t<br><br>\n";
					$centerMenu .= "\t</div>\n";
					echo ($centerMenu);
				} else {
				$centerMenu = "\t<div class='col-xs-3'>\n";
				$row = nextTuple($result);
				$centerMenu .= "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
				$centerMenu .= "\t<br><br>\n";
				$centerMenu .= "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>Available amount: ".$row['available']."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>Price: ".$row['prices']."</p></tr>\n";
				$centerMenu .= "\t<form action='store_one_homepage.php' method='post'>\n";
					$centerMenu .= "\t<label for='amount'>Amount wanted:</label>\n";
					$centerMenu .= "\t<input type='number' class='form-control' value='1' name='amount'>\n";
					$centerMenu .= "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
					$centerMenu .= "\t<button type='submit' class='btn btn-default' name='submit'>Add to Cart</button><br>\n";
				$centerMenu .= "\t</form>\n";
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