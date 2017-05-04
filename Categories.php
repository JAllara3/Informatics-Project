<?php
    $menuActive = 2;
	$header1 = "Store Management";
    include_once('header.php');
?>
<title>Edit Categories</title>

<?php
    include_once('config.php');
    include_once('dbutils.php');

//process inputs from forms
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$storeid = $_POST['storeid'];
	
	$isComplete = true;
	
	$errorMessage = "";
	
	//check if each of the required variables is in the table
	if (!isset($name)) {
		$errorMessage .= "please give a name to your category.\n";
		$isComplete = false;
	}
	
	
	if($isComplete) {
		$query = "INSERT INTO categories(name, storesid) VALUES ('$name', $storeid);";
		$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
		
		// run the insert statement
		$result = queryDB($query, $db);
		
		$categoriesid = mysqli_insert_id($db);
		$success = "Succesfully created a new category: " . $name;
		
		unset($name, $storeid);
	}
}

?>

<?php
	if (isset($_POST['storeid'])){
		include_once('dbutils.php');
		include_once('config.php');

		$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	
		session_start();

		$storeid = $_SESSION['storeid'];

		if (isset($_POST['storeid'])){
			$storeid = $_POST['storeid'];

		}
	
		$query = "SELECT * from stores where id=$storeid;";
	
		$result = queryDB($query, $db);
		
		$row = nextTuple($result);
		
		$storename = $row['name'];
	
		$storebg = $row['bg'];
	
		$_SESSION['id'] = $storeid;
		$_SESSION['name'] = $storename;
		$_SESSION['bg'] = $storebg;
	} else {
		echo "Select a store to edit!";
	}

?>

<body background="storepic.jpg">
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h1>Welcome to <?php if($storename) { echo $storename; } ?>!</h1>
		<h3>Create Store Categories here</h3>
	</div>
</div>

<!--Show successfully creating new category-->
<div class="row">
	<div class = "col-xs-12">
<?php
	if(isset($success)) {
		echo '<div class = "alert alert-success" role="alert">';
		echo ($success);
		echo '</div>';
	} elseif (isset($_GET['successmessage'])) {
		echo '<div class="alert alert-success" role="alert">';
		echo ($_GET['successmessage']);
		echo '</div>';
	}
?>
	</div>
</div>

<!--errors?-->
<div class="row">
	<div class = "col-xs-12">
<?php
	if (isset($isComplete) && !$isComplete) {
		echo '<div class="alert alert-danger" role="alert">';
		echo ($errorMessage);
		echo '</div>';
	}
?>
	</div>
</div>


<!--form to create new stores-->
<div class="row">
	<div class="col-xs-12">

<form action="Categories.php" method="post" enctype="multipart/form-data">
<!--name-->
<div class = "form-group">
	<label for="name">Name:</label>
	<input type="text" class="form-control" name="name" value =""/>
</div>

<!--Description-->
<div class = "form-group">
	<label for="storesid">Store name:</label>
	<input type="text" class="form-control" name="storename" value ="<?php if($storename) { echo $storename; } ?>"/>
	<input type='hidden' name='storeid' value='<?php if($storeid) { echo $storeid; } ?>'>

</div>

<button type = "submit" class= "btn btn-default" name="submit">Create</button>
	
</form>
		
	</div>
</div>

<!--Show contents of new store-->
<div class="row">
    <div class="col-xs-12">
        
<!-- set up html table to show contents -->
	<table class="table table-hover">
    <!-- headers for table -->
	<thead>
		<th>Category name</th>
    </thead>
	
<?php
	if (isset($_POST['storeid'])){

	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	$query = 'SELECT * FROM categories WHERE storesid = '. $storeid .';';
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td><form action='Products.php?id=$categoriesid' method='post'>";
			echo "<td><button type='submit' class = 'btn btn-default' name=add categories'>Edit Products</button></td>";
            echo "<td><a href='deleteCategories.php?id=$id'>Delete</a></td>";
			echo "\t<input type='hidden' name='catid' value='" . $row['id'] . "'>\n";
			echo "\t<input type='hidden' name='storeid' value='" . $row['storesid'] . "'>\n";
		echo "</form></td>";
		echo "</tr> \n";
		
		//echo "<td><a href = "updateStores.php?id=" . $row['id'] . "'>edit</a></td>";
		
		//echo "<td><a href = "deleteStores.php?id=" . $row['id'] . "'>delete</a></td>";
		
		echo "</tr> \n";
	}
	} else {
		echo "STORE HAVEN'T BEEN SELECTED!";
	}
?>
	</table>
	</div>
</div>


</body>
</html>