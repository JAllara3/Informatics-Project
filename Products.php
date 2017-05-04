<?php
    $header1 = "Add products to categories.";
    $menuActive = 2;
    include_once('header.php');
?>
    <?php
        include_once('config.php');
        include_once('dbutils.php');
        
        if(isset($_POST['submit'])) {
            //if here, the form was submitted and we need to process form data
            
            //get data
            $name = $_POST['name'];
            $available = $_POST['available'];
            $prices = $_POST['prices'];
            $icon = $_POST['icon'];
            $categoriesid = $_POST['categoriesid'];
            $storesid = $_POST['storesid'];
            
            $isComplete = true;
            
            $errorMessage = "";
            
            //check each required variables in the table
            if(!isset($name)) {
                $errorMessage .= "Please enter a name for the product\n";
                $isComplete = false;
            }
            if(!isset($available)){
                $errorMessage .= "please specify how much available\n";
                $isComplete = false;
            }
            if(!isset($prices)){
                $errorMessage .= "please specify a price for the product.\n";
                $isComplete = false;
            }
            else {
                
                //connect to the database
                $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
                
                $query = "SELECT name FROM products WHERE name='$name';";
                
                if(nTuples($result) > 0) {
                    $isComplete = false;
                    $errorMessage .= "The product $name is already in the database.\n";
                }
            }
            
        //stop execution and show error.
        if($isComplete) {
            $query = "INSERT INTO products(name, available, prices, icon, categoriesid, storesid) VALUES ($name, $available, $prices, $icon, $categoriesid, $storesid);";
            
            $result = queryDB($query, $db);
            
            echo ("Created new product: " . $name);
            
            unset($isComplete, $errorMessage, $name, $available, $prices, $icon, $categoriesid, $storesid);
        }
        
        }

    ?>
    
<div class ="row">
    <div class ="col-xs-12">
<?php
    if(isset($isComplete) && !$isComplete) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>
    </div>
</div>

<!--form to enter new products-->
<div class="row">
    <div class = "col-xs-12">
<form action="Products.php" method="post">
    <!--name-->
    <div class = "form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" name="name" value="<?php if($name) { echo $name; } ?>"/>
    </div>
    
    <!--Available-->
    <div class = "form-group">
        <label for="available">Available:</label>
        <input type="number" class="form-control" name="available" value="<?php if($available) { echo $available; }?>"/>
    </div>
    
    <!--prices-->
    <div class = "form-group">
        <label for="prices">Prices:</label>
        <input type="number" class="form-control" name="prices" value="<?php if($prices) { echo $prices; }?>"/>
    </div>
    
    <!--ICON-->
    <div class="form-group">
        <label for="icon">Icon:</label>
        <input type="text" class="form-control" name="icon" value="<?php if($icon) { echo $icon; }?>"/>
    </div>
    
    <div class="form-group">
        <label for="categoriesid">Categories-ID:</label>
        <input type = "number" class="form-control" name="categoriesid" value="<?php if($categoriesid) { echo $categoriesid; }?>"/>
    </div>
    
    <div class="form-group">
        <label for="storesid">Stores-ID:</label>
        <input type = "number" class="form-control" name="storesid" value="<?php if($storesid) { echo $storesid; }?>"/>
    </div>
    
    <button type="submit" class="btn btn-default" name="submit">Save Product</button>
    
</form>

    </div>
</div>

<!--Show contents of products table-->
<div class="row">
    <div class="col-xs-12">

<table class="table table-hover">
    <thead>
        <th>Name</th>
        <th>Available</th>
        <th>Prices</th>
        <th>Icon</th>
        <th>CategoriesID</th>
        <th>StoresID</th>
    </thead>
    
<?php

    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    $query = 'SELECT products.name FROM products ORDER BY name;';
    
    $result = queryDB($query, $db);
    
    while($row= nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['available'] . "</td>";
        echo "<td>" . $row['prices'] . "</td>";
        echo "<td>" . $row['icon'] . "</td>";
        echo "<td>" . $row['categoriesid'] . "</td>";
        echo "<td>" . $row['storesid'] . "</td>";
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