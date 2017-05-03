<!DOCTYPE html>
<html>
    <head>
        <title>FAST SHOP</title>

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
    
    <body background = "1.png">
    
    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "welcome.php" ><strong>FastShop</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li <?php if($menuActive == 0) { echo 'class="active"'; } ?>><a href="welcome.php">Home</a></li>
                <li <?php if($menuActive == 1) { echo 'class="active"'; } ?>><a href="Stores.php">Stores</a></li>
                <li <?php if($menuActive == 2) { echo 'class="active"'; } ?>><a href="Products.php">Products</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li <?php if($menuActive == 4) { echo 'class="active"'; } ?>><a href ="CLogin.php">Customer Login</a></li>
                        <li <?php if($menuActive == 5) { echo 'class="active"'; } ?>><a href ="GLogin.php">Manager Login</a></li>
                        <li <?php if($menuActive == 6) { echo 'class="active"'; } ?>><a href = "Gsignup.php">Manager Signup</a></li>
                        <li <?php if($menuActive == 7) { echo 'class="active"'; } ?>><a href = "Csignup.php">Customer Signup</a></li>
                        <li ><a href="GLogin.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1><strong><?php echo $header1;?></strong></h1>
        </div>
    </div>