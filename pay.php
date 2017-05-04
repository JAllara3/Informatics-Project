<html>
    <head>
        <title>Checkout</title>
        
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
<?php
	
	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
	session_start();

    $storeid = $_SESSION['storeid'];
	
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

    <?php
    $pagetitle = 'Checkout';
    //include_once("header.php");
    ?>

<!-- Menu bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="store_one_homepage.php">Home</a></li>
        <li><a href="store_one_shopping.php">My Cart</a></li>
        <li class="active"><a href="store_one_orders.php">My Order</a></li>
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
    
    <body>

<!-- Visible title -->
        <div class="row">
            <div class="col-xs-12">
                <h1>Checkout</h1>
            </div>
        </div>
        
<!-- Processing form input -->        
        <div class="row">
            <div class="col-xs-12">
<?php


// include config and utils files
include_once('config.php');
include_once('dbutils.php');

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
	
       
        
    if(isset($_SESSION['userid'])) {
	$query = "SELECT * FROM payment WHERE usersid =". $_SESSION['userid']. ";";
	$result = queryDB($query,$db);
	if (nTuples($result) > 0) {
        	$row = nextTuple($result);
        	$name = $row['name'];
                $address = $row['address'];
                $payment = $row['payment'];
                $deliver = $row['deliver'];   
        }
    }
    
    
    if (isset($_POST['checkout'])) {
        
        $name = ($_POST['name']);
        $address = ($_POST['address']);
        $payment = ($_POST['payment']);
        $deliver = ($_POST['deliver']);
    
    
      // get payment id
    //$payment = $_POST['payment-id'];
    
    // variable to keep track if the form is complete (set to false if there are any issues with data)
    $isComplete = true;
    
    // error message we'll give user in case there are issues with data
    $errorMessage = "";
    
    // check each of the required variables in the table
    if (!isset($name) || strlen($name) == 0) {
        $errorMessage .= " Please enteryour name.\n";
        $isComplete = false;
    }
    
    if (!isset($address) || strlen($address) == 0) {
        $errorMessage .= " Please enter your address.\n";
        $isComplete = false;
    }
    
    if (!isset($payment)) {
        $errorMessage .= "Please enter card information.\n";
        $isComplete = false;
    } else if (!preg_match("/^[0-9]{16}$/", $payment)) {
        $errorMessage .=" Please enter a card number that is 16 digits long.";
        $isComplete = false;
    }
    
    
    if (!isset($deliver) || strlen($deliver) == 0) {
        $errorMessage .= " Please enter date of delivery.\n";
        $isComplete = false;
    }
    
    
    
        // Stop execution and show error if the form is not complete
    if($isComplete) {
        
     //connect to the database
         $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // put together SQL statement to insert new record
        $query = "INSERT INTO payment(name, address, payment, deliver) VALUES ('$name', '$address', $payment, '$deliver');";
    
        
        // run the insert statement
        $result = queryDB($query, $db);
    
        
        // get the id for the payment we just entered
        $paymentid = mysqli_insert_id($db);
        
        // for each order, enter a record in the payment table
        foreach ($payment as $paymentid) {
            // set up insert query
            $query = "INSERT INTO payment(paymentid) VALUES ($paymentid);";
            
            // run insert query
            $result = queryDB($query, $db);
        }
        
		$cartid = $_SESSION['cartid'];
		$Cid = $_SESSION['Cid'];
		
		$query_1 = "UPDATE productorder SET status='ordered' WHERE productsid = $Cid AND cartid = $cartid;";
        
        $result_1 = queryDB($query_1,$db);
		
        // we have successfully entered the payment
        $success = "Successfully entered payment information: " . $name;
        
        // reset values of variables so the form is cleared
        unset($paymentid, $name, $address, $payment, $deliver);
    }
    }

?>

        </div>
            </div>


<!-- Showing errors, if any -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && !$isComplete) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>            
    </div>
</div>            
            
<!-- form for inputting data -->
        <div class="row">
            <div class="col-xs-12">
                
<form action="pay.php" method="post">
<!-- name -->
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="<?php if(isset($name)) { echo $name; } ?>"/>
    </div>
    
<!-- address -->
    <div class="form-group">
        <label for="address">Address:</label>
        <?php
            if (isset($_SESSION['userid'])) {
                // if user logged in
                echo (generateDropdown($db, "addresses", "addresses", "id", "usersid = " . $_SESSION['userid']));
            }
            
            echo '<input type="number" class="form-control" name="address"/>';
        ?>
        <!-- <input type="text" class="form-control" name="address"/> --!>
    </div>

<!-- payment -->
    <div class="form-group">
        <label for="payment">Payment:</label>
        <?php
            if (isset($_SESSION['userid'])) {
                // if user logged in
                echo (generateDropdown($db, "cards", "cards", "id", "usersid = " . $_SESSION['userid']));
            }
            
            echo '<input type="number" class="form-control" name="payment"/>';
        ?>
        <!-- <input type="number" class="form-control" name="payment"/> -->
    </div>
    
<!-- deliver -->
    <div class="form-group">
        <label for="deliver">Deliver:</label>
        <input type="date" class="form-control" name="deliver"/>
    </div>
    
    <button type="checkout" class="btn btn-default" name="checkout">Checkout</button>
</form>
                
            </div>
        </div>
    </body>
    
</html>