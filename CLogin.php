<!DOCTYPE html>
<html>
    <head>
        <title>Customer Login</title>

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
    
    <body>
    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "welcome.php" ><strong>FastShop</strong></a>
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
                        <li class = "active"><a href ="CLogin.php">Customer Login</a></li>
                        <li><a href ="GLogin.php">Manager Login</a></li>
                        <li><a href="GLogin.php">Log Out</a></li>
                        <li><a href = "Csignup.php">SignUp</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1 align = center>Welcome to Fast Shop!</h1>
        </div>
    </div>

<?php


	include_once('dbutils.php');
	include_once('config.php');
	
	if (isset($_POST['submit'])) {

	    $email = $_POST['username'];
		$password = $_POST['password'];
	    
	    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
	    
	    $isComplete = true;
	    $errorMessage = "";
	    
	    if (!$email) {
	        $errorMessage .= " Please enter an email.";
	        $isComplete = false;
	    } else {
	        $email = makeStringSafe($db, $email);
	    }
	    if (!$password) {
	        $errorMessage .= " Please enter a password.";
	        $isComplete = false;
	    }	    
		
	    if (!$isComplete) {
	        punt($errorMessage);
	    }
	    
	    // get the hashed password from the user with the email that got entered
	    $query = "SELECT hashedpass FROM users WHERE email='" . $email . "';";
		$result = queryDB($query, $db);
		if (nTuples($result) > 0) {
		    // there is an account that corresponds to the email that the user entered
			// get the hashed password for that account
			$row = nextTuple($result);
			$hashedpass = $row['hashedpass'];
			
				// compare entered password to the password on the database
			if ($hashedpass == crypt($password, $hashedpass)) {
				// password was entered correctly
				
				// start a session
			if (session_start()) {
					$_SESSION['email'] = $email;
					header('Location: store_one_homepage.php');
					exit;
				} else {
					// if we can't start a session
					punt("Unable to start session when loggin in.");
				}
			} else {
				// wrong password
				punt("Wrong password. <a href='CLogin.php'>Try again</a>.");
			}
	    } else {
			// email entered is not in the users table
			punt("This email is not in our system. <a href='CLogin.php'>Try again</a>.");
		}
	}
?>
	
	<body>
	    <div class="container login">
			<form action="CLogin.php" method="post" class="form-signin" id = "login_form" >
                <h2 class="form-signin-heading">Customer Login</h2>
                <input type="text" name="username" size="20" placeholder="Email">
                <input type="password" name="password" size="20" placeholder="Password"></br>
                <button type='submit' class='btn btn-default' name='submit'>Submit</button><br>
                <a href="signup.php">Sign Up</a>
            </form>
        </div>
    </body>
</html>