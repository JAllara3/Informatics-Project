<?php
    $menuActive = 1;
	$header1 = "Store Management";
    include_once('header.php');
?>

<title>Store Management</title>

<?php
	include_once('config.php');
	include_once('dbutils.php');

	session_start();
//process inputs from forms
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$description = $_POST['description'];
	$address = $_POST['address'];
	
	$isComplete = true;
	
	$errorMessage = "";
	
	//check if each of the required variables is in the table
	if (!isset($name)) {
		$errorMessage .= "please give a name to your store.\n";
		$isComplete = false;
	}
	
	if($isComplete) {
		$query = "INSERT INTO stores(name, description, address) VALUES ('$name', '$description', '$address');";
		$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
		
		// run the insert statement
		$result = queryDB($query, $db);
		
		$storesid = mysqli_insert_id($db);
		$success = "Succesfully created a new store: " . $name;
		
		unset($name, $description, $address);
	}
}

?>
<body background="storepic.jpg">
<div class="row">
	<div class="col-xs-12" style="text-align:center">
		<h1>Welcome to The Union!</h1>
		<h3>Manage your stores here</h3>
	</div>
</div>

<!--Show successfully creating new store-->
<div class="row">
	<div class = "col-xs-12">
<?php
	if(isset($success)) {
		echo '<div class = "alert alert-success" role="alert">';
		echo ($success);
		echo '</div>';
	}/* elseif (isset($_GET['successmessage'])) {
		echo '<div class="alert alert-success" role="alert">';
		echo ($_GET['successmessage']);
		echo '</div>';
	}*/
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

<form action="Stores.php" method="post" enctype="multipart/form-data">
<!--name-->
<div class = "form-group">
	<label for="name">Name:</label>
	<input type="text" class="form-control" name="name" value ="<?php if($name) { echo $name; } ?>"/>
</div>
<!--Description-->
<div class = "form-group">
	<label for="description">Description:</label>
	<input type="text" class="form-control" name="description" value ="<?php if($description) { echo $description; } ?>"/>
</div>
<!--address-->
<div class = "form-group">
	<label for="address">Address:</label>
	<input type="text" class="form-control" name="address" value ="<?php if($address) { echo $address; } ?>"/>
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
		<th>Store name</th>
        <th>Description </th>
		<th>Location</th>
    </thead>
	
<?php
	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	$query = 'SELECT * FROM stores;';
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n <tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td><form action='Categories.php?id=$storeid' method='post'>";
			echo "<td><button type='submit' class = 'btn btn-default' name=add categories'>Edit Categories</button></td>";
			//echo "<td><a href='deleteStores.php?id=$id'>Delete</a></td>";
			echo "\t<input type='hidden' name='storeid' value='" . $row['id'] . "'>\n";
		echo "</form></td>";
		echo "<td><a href='deleteStores.php?id=$id'>Delete</a></td>";

		echo "</tr> \n";
		
		//echo "<td><a href = "updateStores.php?id=" . $row['id'] . "'>edit</a></td>";
		
		//echo "<td><a href = "deleteStores.php?id=" . $row['id'] . "'>delete</a></td>";
		
		echo "</tr> \n";
	}
?>
	</table>
	</div>
</div>


</body>
</html>

