<html>
    <head>
<!-- Bootstrap links -->

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
	
    
        <title>The Union</title>
    
    <body background="5.png">

    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "union.php"><strong>The Union</strong></a>
            </div>
        </div>
    </nav>
<?php

	include_once('dbutils.php');
	include_once('config.php');

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
?>

    	<div class="row">
		    <div class="col-xs-12" style="text-align:center">
		        <h1>Welcome to The Union!</h1>
                <h3>You can view our store options here!</h3>
		    </div>
		</div>
		

<div class="row">
    <div class="col-xs-12">
        
<!-- set up html table to show contents -->
<table class="table table-hover" style="background-color:#fff2e6">
    <!-- headers for table -->
    <thead>
        <th>Store name</th>
        <th>Key features</th>
        <th>Address</th>
    </thead>

<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $query="SELECT * FROM stores;";
    
    $result = queryDB($query, $db);
    
    while ($row = nextTuple($result)) {
            $storeid = $row['id'];
            echo "\n <tr>";
            echo "<td>" . $row['name']. "</td>";
            echo "<td>" . $row['description']. "</td>";
            echo "<td>" . $row['address']. "</td>";
			echo "<td><form action='store_one_homepage.php?id=$storeid' method='post'>";
				echo "<td><button type='submit' class='btn btn-default' name='goshopping'>GO</button></td>";
                echo "\t<input type='hidden' name='storeid' value='" . $row['id'] . "'>\n";
			echo "</form></td>";
			echo "<td>";
		    echo "</tr> \n";
    }
?>

</table>
    </div>
</div>

    </body>
</html>