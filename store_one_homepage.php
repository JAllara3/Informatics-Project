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
	
        <title>fast shop</title>
    
    <body background="1.png">


    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "store_one_homepage.php" ><strong>FastShop</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="store_one_homepage.php">Home</a></li>
                <li><a href="store_one_shopping.php">My Cart</a></li>
                <li><a href="store_one_shopping.php">My Order</a></li>
                <li><a href="logout.php">Log out</a></li>
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
		echo "Current user: ". $_SESSION['email'] ."";
		$query_10 = "SELECT id as USER from users WHERE email = '". $_SESSION['email'] ."';";
		$result_10 = queryDB($query_10,$db);
		$row_2 = nextTuple($result_10);
		$lastuserid = $row_2['USER'];
		$_SESSION['userid'] = $lastuserid;
	 	$userid = $_SESSION['userid'];
	}
	
?>

<!-- Title -->
<div class="row">
    <div class="col-xs-6">
        <h1>Welcome to fast shop!</h1>
    </div>
</div>

<?php
	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	if (isset($_POST['submit'])) {
		$amount = $_POST['amount'];
		$productsid = $_POST['id'];

			if(isset($_SESSION['email'])) {
				$query_3 = "SELECT * FROM carts WHERE userid =". $_SESSION['userid'] ." and status='cart';";
				$result_3 = queryDB($query_3,$db);
				if (nTuples($result_3) > 0) {
					$row = nextTuple($result_3);
					$cartid = $row['id'];
				} else {
					$query_4 = "INSERT INTO carts(userid, status) VALUES (". $_SESSION['userid'] .", 'cart');";
					$result_4 = queryDB($query_4,$db);
					$query_7 = "SELECT max(id) as NEW from carts;";
					$result_7 = queryDB($query_7,$db);
					$row = nextTuple($result_7);
					$lastid = $row['NEW'];
					$cartid = $lastid;
				}
			
			} else {
					// user not logged in
					if (isset($_SESSION['cartid'])) {
					// if we have a shopping cart for a guest
						$cartid = $_SESSION['cartid'];
					} else {
						echo "Welcome GUEST! ";
						$query_5 = "INSERT INTO carts(status) VALUES ('cart');";
						$result_5 = queryDB($query_5,$db);
						$query_8 = "SELECT max(id) as NEW from carts;";
						$result_8 = queryDB($query_8,$db);
						$row = nextTuple($result_8);
						$lastid = $row['NEW'];
						$_SESSION['cartid'] = $lastid;
					 	$cartid = $_SESSION['cartid'];
					}	
				}
				$query_6 = "INSERT INTO productorder(cartid, productsid, amount) VALUES ($cartid, $productsid, $amount);";
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
					$centerMenu .= "\t\t\t<tr><p href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</p></tr>\n";
					$centerMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
					$centerMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
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
				$centerMenu .= "\t\t\t<tr><p href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
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