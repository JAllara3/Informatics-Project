<!DOCTYPE html>
<html>
    <head>
        <title>Welcome Page</title>

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
                <li class="active"><a href="welcome.php">Home</a></li>
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
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1><strong>Welcome to Fast Shop!</strong></h1>
            <br>
            <h3>Manage your store here</h3>
        </div>
    </div>
    
    <div class="btn-group btn-group-justified">
        <a href="Categories.php" class="btn btn-primary btn-lg custom">Edit Categories</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="Products.php" class="btn btn-primary btn-lg">Edit Products</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="PlacedOrders.php" class="btn btn-primary btn-lg">Placed Orders</a>
    </div>
    <div class="btn-group btn-group-justified">
        <a href="Completed.php" class = "btn btn-primary btn-lg">Completed Orders</a>
    </div>
    
    </body>

</html>
