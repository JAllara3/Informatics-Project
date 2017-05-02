<?php
    $name = "Add a New Category or Delete a Current one";
    $menuActive = 1;
    include_once('header.php');
?>
    
    <div class="row">
		    <div class="col-xs-12" style="text-align:center">
		        <h1>Welcome to Fastshop!</h1>
                <h3>Create your stores here</h3>
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
    </thead>

<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $query="SELECT * FROM stores;";
    
    $result = queryDB($query, $db);
    
    while ($row = nextTuple($result)) {
            $id = $row['id'];
            echo "\n <tr>";
            echo "<td>" . $row['name']. "</td>";
            echo "<td>" . $row['description']. "</td>";
			echo "<td><form action='Categories.php?id=$id' method='post'>";
				echo "<td><button type='submit' class='btn btn-default' name='goshopping'>GO</button></td>";
                echo "\t<input type='hidden' name='id' value='" . $row['id'] . "'>\n";
			echo "</form></td>";
			echo "<td>";
		    echo "</tr> \n";
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