<!DOCTYPE html>
<html>
    <head>
        <title>Manager Login</title>

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

	<body style = "background:url('40.png'); background-repeat:no-repeat; background-size:100% 200%">
            
        <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "union.php" ><strong>The Union</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="welcome.php?id=<?php echo $storeid;?>">Home</a></li>
                <li><a href="Categories.php">Categories</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="PlacedOrders.php">Placed Orders</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href ="CLogin.php">Customer Login</a></li>
                        <li class = "active"><a href ="GLogin.php">Manager Login</a></li>
                        <li><a href="GLogin.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
        
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1 align = center>Logging in for managing: <?php echo $storename;?></h1>
        </div>
    </div>
<?php
    include_once('dbutils.php');
    include_once('config.php');
    
    if(isset($_POST['submit'])){
        $email = $_POST['username'];
        $password = $_POST['password'];
        
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        $isComplete = true;
        $errorMessage="";
        
        if(!$email){
            $errorMessage .= " Please enter an email.";
            $isComplete = false;
        } else{
            $email = makeStringSafe($db, $email);
        }
        if(!$password){
            $erroMessage .= " Please enter a password.";
            $isComplete = false;
        }
        if(!$isComplete){
            punt($errorMessage);
        }
        
        $query = "SELECT hashedpass FROM users WHERE email='".$email."';";
        $result = queryDB($query,$db);
        if(nTuples($result) > 0){
            $row=nextTuple($result);
            $hashedpass = $row['hashedpass'];
            
            if($hashedpass == crypt($password, $hasehdpass)){
                
                if(session_start()){
                    $_SESSION['email'] = $email;
                    header('Loction: welcome.php');
                    exit;
                } else{
                    punt("unable to start session when logging in.");
                }
            } else{
                punt("Wrong password. <a href='GLogin.php'>Try Again</a>.");
            }
        } else {
            punt("This email is not in our system.<a href='GLogin.php'>Try again</a>.");
        }
    }
?>
    <body>
	    <div class="container login" align="center">
			<form action="GLogin.php" method="post" class="form-signin" id = "login_form" >
                <h2 class="form-signin-heading">Manager Login</h2>
                <input type="text" name="username" size="20" placeholder="Email"></br></br>
                <input type="password" name="password" size="20" placeholder="Password"></br></br>
                <button type='submit' class='btn btn-default' name='submit'>Submit</button></br></br>
                <a href="Gsignup.php">Sign Up</a>
            </form>
        </div>

    </body>
</html>