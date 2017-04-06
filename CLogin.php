<!DOCTYPE html>
<html>

    <head>
        <title>Customer Login Page</title>
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
    
    <!-- Menu bar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="welcome.php">Home</a></li>
                <li><a href="Categories.php">Categories</a></li>
                <li><a href ="CLogin.php">Customer Login</a></li>
                <li><a href ="GLogin.php">Manager Login</a></li>
                <li><a href="logout.php">log out</a></li>
            </ul>
        </div>
    </nav>
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1 align = center>Welcome to Fast Shop!</h1>
        </div>
    </div>

    <body>
        <div class="container login">
            <form action="CLogin.php" method="post" class="form-signin" id = "login_form" >
                <h2 class="form-signin-heading">Customer Login</h2>
                <input type="text" name="username" size="20" placeholder="Username">
                <input type="password" name="password" size="20" placeholder="Password"></br>
                <input type="submit" value="Log In" class="btn btn-large btn-primary">
                <a href="signup.php">Sign Up</a>
            </form>
        </div>
    </body>
</html>



<?php
    if (isset($_POST) && !empty($_POST)) {
        session_start();
        //connecting to the database
        include("config.php");
        include ("dbutils.php");

        
        //Storing username in $username variable.
        $username = ($_POST['username'];

        //Storing password in $password variable.
        $password = ($_POST['password']);


        $match = "SELECT id FROM $table WHERE username = '" . $username . "' and password'" . $password . "';";

        $qry = mysql_query($match);

        $num_rows = mysql_num_rows($qry);

        if ($num_rows <= 0) {

            echo "Sorry, there is no username $username with the specified password.";

            echo "Try again";

            exit;

        } else {

            $_SESSION['user'] = $_POST["username"];
            header("location: welcome.php"); // Page to redirect user after login.
        }
    } //else{}
?>