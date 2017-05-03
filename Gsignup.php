<!DOCTYPE html>
<html>

    <head>
        <title>Manager Signup Page</title>
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
        
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <style>		
.center {
    margin: auto;
    width: 40%;
    border: 3px solid #DAF7A6;
    padding: 10px;
    }
    </style>
	
	
	<body style = "background:url('40.png'); background-repeat:no-repeat; background-size:100% 200%">
    
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
	
	    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "union.php" ><strong>The Union</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="welcome.php">Home</a></li>
                <li><a href="Categories.php">Categories</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="PlacedOrders.php">Placed Orders</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href ="CLogin.php">Customer Login</a></li>
                        <li><a href ="GLogin.php">Manager Login</a></li>
                        <li><a href="GLogin.php">Log Out</a></li>
                        <li class = "active"><a href = "Gsignup.php">SignUp</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
<?php

	include_once('dbutils.php');
	include_once('config.php');
	
	
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
    	$password = $_POST['password'];
    	$cpassword = $_POST['cpassword'];
    
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";

    if (!$email) {
        $errorMessage .= " You haven't entered email!";
        $isComplete = false;
    } else {
        $email = makeStringSafe($db, $email);
    }
    
    if (!$password) {
        $errorMessage .= " You haven't entered your password!";
        $isComplete = false;
    }
	
	if (!$cpassword) {
        $errorMessage .= " You haven't entered your password! again.";
        $isComplete = false;
    }
	
	if ($password != $cpassword) {
		$errorMessage .= " Your passwords do not match.";
		$isComplete = false;
	}
	    
	
    if ($isComplete) {
    
		$query = "SELECT hashedpass FROM users WHERE email='" . $email . "';";
		$result = queryDB($query, $db);
		if (nTuples($result) == 0) {

			$hashedpass = crypt($password, getSalt());
			
			$new = "INSERT INTO users(email, hashedpass) VALUES ('" . $email . "', '" . $hashedpass . "');";
		
			// run the insert statement
			$result = queryDB($new, $db);
		
			
		} else {
			$isComplete = false;
			$errorMessage = "Sorry. We already have a user account under email " . $email;
		}
	}
}
?>
        
<!-- Showing successfully entering pizza, if that actually happened -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && $isComplete) {
        echo '<div class="alert alert-success" role="alert">';
        echo ("Welcome user: " ."$username");
        unset($username, $email, $password, $cpassword);
        echo '</div>';
    }
?>            	
		
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

    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1 align = center>Welcome to The Union!</h1>
        </div>
    </div>
            <div class="container login" align="center">
                <form action="Gsignup.php" method="post" class="form-signin" id = "login_form" >
                    <h2 class="form-signin-heading">Customer Signup</h2>
                    <input type="text" name="username" size="20" placeholder="Username"></br></br>
                    <input type="email" name ="email" size="20" placeholder="Email"></br></br>
                    <input type="password" name="password" size="20" placeholder="Password"></br></br>
                    <input type="password" name="cpassword" size="20" placeholder="confirm password"></br></br>
                    <button type='submit' class='btn btn-default' name='submit'>Submit</button><br>
                </form>
                    <a href="GLogin.php">back to login</a>
            </div>
    </body>
</html>