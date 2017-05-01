<html>
<head>
    <title>Order Complete!</title>
            
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
    <?php
    $pagetitle = 'Order Complete';
    ?>

<!-- Menu bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="store_one_homepage.php">Home</a></li>
        <li><a href="store_one_shopping.php">My Cart</a></li>
        <li class="active"><a href="pay.php">My Order</a></li>
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
                <h1>Order Comeplete!</h1>
            </div>
        </div>
        
<!-- Processing form input -->        
        <div class="row">
            <div class="col-xs-12">
                
<div class="row">
    <div class="col-xs-12">
        <p style="font-size:120%;">Thank you <?php echo $_SESSION['name']; ?>! Your order will be delivered <?php echo $_SESSION['deliver']; ?>! </p>
    </div>
</div>

</body>
</html>
