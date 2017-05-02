<?php
    $name = "Add a New Store or Delete a Current one";
    $menuActive = 1;
    include_once('header.php');
?>

    <div class="row">
		    <div class="col-xs-12" style="text-align:center">
		        <h1>Welcome to Fastshop!</h1>
                <h3>Manage your stores here</h3>
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
		<th>Location</th>
    </thead>

<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $query="SELECT * FROM newStores;";
    
    $result = queryDB($query, $db);
    
    while ($row = nextTuple($result)) {
            $id = $row['id'];
            echo "\n <tr>";
            echo "<td>" . $row['name']. "</td>";
            echo "<td>" . $row['description']. "</td>";
			echo "<td>" . $row['address'] . "</td>";
			echo "<td><form action='welcome.php?id=$id' method='post'>";
				echo "<td><button type='submit' class='btn btn-default' name='newStores'>GO</button></td>";
                echo "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
			echo "</form></td>";
			echo "<td>";
		    echo "</tr> \n";
    }
?>

</table>
    </div>
</div>

<?php
include_once('config.php');
include_once('dbutils.php');

if (isset($_POST['submit'])) {
	
	$name = $_POST['name'];
	$description = $_POST['description'];
	$address = $_POST['address'];
	
	$isComplete = true;
	
	$errorMessage = "";
	
	if (!isset($name)) {
		$errorMessage .= "Please name your store. \n";
		$isComplete = false;
	}
	if (!isset($description)) {
		$errorMessage .= "Please describe what this store offers. \n";
		$isComplete = false;
	}
	if (!isset($address)) {
		$errorMessage .= "Please provide your stores location. \n";
		$isComplete = false;
	}
	if ($isComplete) {
		$query = "INSERT INTO newStores(name, description, address) VALUES ('$name', '$description', '$address');";
		$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
		$result = queryDB($query, $db);
		
		$success = "Successfully created a new store: " . $name;
		
		unset($name, $description, $address);
	}
}
?>

<div class= "row">
	<div class = "col-xs-12">
<?php
	if (isset($success)) {
		echo '<div class = "alert alert-success" role="alert">';
		echo ($success);
		echo'</div>';
	}
?>
	</div>
</div>

<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && !$isComplete) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>            
    </div>
</div>

<!--html form for new stores-->
<div class="row">
	<div class="col-xs-12">

<form action="Stores.php" method="post">
	<div class="form-group">
		<label for="name">Name:</label>
		<input type="text" class="form-control" name="name" value = "<?php if($name) { echo $name; } ?>"/>"
	</div>
	
	<div class="form-group">
		<label for="description">Description: </label>
		<input type="text" class="form-control" name="description" value = "<?php if($description) { echo $description; } ?>"/>"
	</div>
	
	<div class="form-group">
		<label for="address">Address: </label>
		<input type="text" class="form-control" name="address" value = "<?php if($address) { echo $address; } ?>"/>"
	</div>
	
	<button type = "submit" class="btn btn-default" name="submit">Create</button>
	
</form>

	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		
<table class="table table-hover">
	<thead>
		<th>Name</th>
		<th>Description</th>
		<th>Address</th>
	</thead>
	
<?php
	$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
	$query = 'SELECT newStores.id, newStores.name, newStores.description, newStores.address FROM newStores;';
	$result = queryDB($query, $db);
	
	while($row = nextTuple($result)) {
		echo "\n<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
	}
	
?>
	
	
</table>
		
	</div>
</div>


</body>
    <?php $footer = 'Footer';
    include_once("footer.php");
    ?>
</html>