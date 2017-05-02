<html>
    <head>
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
        <title>Edit</title>
		
    
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


    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "union.php" ><strong>The Union</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="store_one_homepage.php?id=<?php echo $storeid;?>">Home</a></li>
                <li class="active"><a href="store_one_shopping.php">My Cart</a></li>
                <li><a href="pay.php">My Order</a></li>
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
    				<!-- Title -->
		<div class="row">
		    <div class="col-xs-6" align = 'center'>
		        <h1>Edit product!</h1>
		    </div>
		</div>
<?php

?>

<?php
    include_once('config.php');
    include_once('dbutils.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $id = $_SESSION['Cid'];
    
    $cartid = $_SESSION['cartid'];
    
    $query = "SELECT * from products where id = $id;";
    
    $result = queryDB($query,$db);
    
    while ($row = nextTuple($result)) {
			echo "\t<div class='row'>\n";
			echo "\t<div class='col-xs-6' align = 'center'>\n";
			echo "\t\t\t<tr><img src='".$row['icon']. "' alt='NO PICTURE' style='width:128px;height:128px;'></tr>\n";
			echo "\t<br><br>\n";
			echo "\t\t\t<tr><p>Product: ". $row['name'] ."</p></tr>\n";
			echo "\t\t\t<tr><p>Available amount: ".$row['available']."</p></tr>\n";
			echo "\t\t\t<tr><p>Price: ".$row['prices']."</p></tr>\n";
			echo "\t<form action='edit_cart.php' method='post'>\n";
			echo "\t<label for='amount'>Please enter a new amount:</label>\n";
			    echo "\t<input type='number' class='form-control' value='1' name='amount'>\n";
			    echo "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
				echo "\t<button type='submit' class='btn btn-default' name='update'>Update</button><br>\n";
			echo "\t</form>\n";
			echo "\t<br><br>\n";
			echo "\t</div>\n";
		}
    

    if (isset($_POST['update'])){
        
        $amount = $_POST['amount'];
        $Pid = $_SESSION['Pid'];
        
        $query_1 = "UPDATE productorder SET amount=$amount WHERE productsid = $id AND id = $Pid;";
        
        $result_1 = queryDB($query_1,$db);
        
        header('Location: store_one_shopping.php');       
    }
?>

    </body>
</html>