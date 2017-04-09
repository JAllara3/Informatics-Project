<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
        
        <title>fast shop</title>
    </head>
    
    <body background="1.png">
<style>		
.center {
    margin: auto;
	width: 80%;
    padding: 10px;
}
</style>

<!-- Menu bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="store_one_homepage.php">Home</a></li>
        <li><a href="store_one_shopping.php">My Cart</a></li>
        <li><a href="store_one_shopping.php">My Order</a></li>
        <li><a href="logout.php">Log out</a></li>
     </ul>
  </div>
</nav>
        
<!-- Title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Welcome to fast shop!</h1>        
    </div>
</div>

<button type="submit" class="btn btn-default pull-right" name="submit">Add to Cart</button>
<?php

	include_once('dbutils.php');
	include_once('config.php');

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query to get information on the carss from the database
    $query = 'SELECT name FROM categories WHERE categories.storesid = 1;';
    
    // run the query
    $result = queryDB($query, $db);
	
	if ($result) {
		$numberofrows = nTuples($result);
		
		if ($numberofrows > 0) {
			$leftSideMenu = "\t<div class='col-xs-2'>\n";
			$leftSideMenu .= "\t\t<table class='table table-hover text-left'>\n";
			
			for($i=0; $i < $numberofrows; $i++) {
				$row = nextTuple($result);
				$leftSideMenu .= "\t\t\t<tr><td><a href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</a></td></tr>\n";
			}
			$leftSideMenu .= "\t\t</table>\n";
			$leftSideMenu .= "\t</div>\n";	
			echo ($leftSideMenu);
		}
	}
	
?>

<?php

    // set up a query to get information on the carss from the database
    $query_2 = 'SELECT name, available, prices FROM products WHERE products.storesid = 1 AND products.categoriesid = 1;';
    
    // run the query
    $result = queryDB($query_2, $db);
	
	if ($result) {
		$numberofrows = nTuples($result);
		$centerMenu = "\t<div class='.col-xs-6 .col-md-4'>\n";
		
		if ($numberofrows > 0) {
			for($i=0; $i < $numberofrows; $i++) {
				$centerMenu .= "\t<div class='row'>\n";
				$centerMenu .= "\t<div class='center'>\n";
				$row = nextTuple($result);
				$centerMenu .= "\t\t\t<tr><a href='store_one_homepage.php?page=" . $row[$result] . "'>". $row['name'] ."</a></tr>\n";
				$centerMenu .= "\t</div>\n";
				$centerMenu .= "\t\t\t<tr><p>available amount: ".$row['available']."</p></tr>\n";
				$centerMenu .= "\t\t\t<tr><p>price: ".$row['prices']."</p></tr>\n";
				$centerMenu .= "\t<label class='radio-inline'>\n";
					$centerMenu .= "\t<input type='radio'>\n";
				$centerMenu .= "\t</label>\n";
			}
			$centerMenu .= "\t</div>\n";
			echo ($centerMenu);
		}
		$centerMenu .= "\t</div>\n";
	}
	
?>


    </body>
</html>