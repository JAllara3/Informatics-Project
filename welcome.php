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
        
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    
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
            <h1>Welcome to Fast Shop!</h1>
            <br>
            <h3>Manage your store here</h3>
        </div>
    </div>
    
    <div class="btn-group btn-group-justified">
        <a href="Categories.php" class="btn btn-primary">Categories</a>
        <a href="Items.php" class="btn btn-primary">Items</a>
        <a href="PlacedOrders.php" class="btn btn-primary">Placed Orders</a>
        <a href="Delivered.php" class = "btn btn-primary">Deliverd Orders</a>
    </div>
    
    </body>

</html>
