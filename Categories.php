<!DOCTYPE html>
<html>
    <head>
        <title>Categories</title>

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
    <!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class = "navbar-header">
            <a class="navbar-brand" href = "welcome.php" ><strong>FastShop</strong></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="welcome.php">Home</a></li>
                <li class="active"><a href="Categories.php">Categories</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="PlacedOrders.php">Placed Orders</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">User Options
                    <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href ="CLogin.php">Customer Login</a></li>
                        <li><a href ="GLogin.php">Manager Login</a></li>
                        <li><a href="GLogin.php">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1>Categories</h1>
        </div>
    </div>
    
    <?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    if (isset($_POST['submit'])){
        
        //get data
        $name = $_POST['name'];
        $storeid = $_POST['storeid'];
        
        $isComplete = true;
        
        $errorMessage = "";
        
        
        if (!isset($name)){
            $errorMessage .= "please enter a category name. \n";
            $isComplete = false;
        }
        
        if (!isset($storeid)){
            $errorMessage .= "please specifiy the storeid for this category\n";
            $isComplete = false;            
            }
        
        if($isComplete){
            
            $query = "INSERT INTO categories(name, storeid) VALUES ('$name', '$storeid');";
            
            $result = queryDB($query, $db);
            
            $success = "successfully added category: " .$name;
            
            $categoriesid = mysqli_insert_id($db);
            
            unset($name, $storeid);
        }
    }
    ?>
    
    <div class = "row">
        <div class = "col-xs-12">
<?php
    if (isset($success)){
        echo "<div class = 'alert alert-success' role = 'alert'>";
        echo ($success);
        echo "</div>";
    }

?>
        </div>
    </div>
    
    <!--errors?-->
    <div class="row">
        <div class = "col-xs-12">
            <?php
            if (isset($isComplete) && !$isComplete){
                echo "<div class= 'alert alert-danger' role='alert'> ">;
                echo ($errorMessage);
                echo "</div>";
            }
            ?>
        </div>
    </div>
    
    <!--form to enter new categories-->
    <div class= "row">
        <div class = "col-xs-12">
            <form action = "Categories.php" method = "post">
                <!--name-->
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="name" value="<?php if($name) {echo $name;}?>">
                </div>
                
                <!--storeid-->
                <div class="form-gorup">
                    <label for="storeid">Storeid:</label>
                    <input type="number" class = "form-control" name="storeid" value="<?php if($storeid) {echo $storeid;}?>">
                    <?php
                    if (!isset($db)){
                        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
                    }
                    echo(generateDropdown($db, "name", "storeid" $storeid));
                    ?>
                </div>
                
                <button type = "submit" class="btn btn-inverse" name="submit">Create Category</button>
            </form>
        </div>
    </div>
    
    <!--Display contents of new category-->
    
    <div class="row">
        <div class="col-xs-12">
            <!--HTML TABLE-->
            <table class = "table table-hover">
                <thead>
                    <th>Name</th>
                    <th>Storeid</th>
                </thead>
                <?php
                //connect to db
                $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
                
                $query = 'SELECT categories.id, categories.name, FROM categories'
                
                $result = queryDB($query, $db);
                
                while($row = (nextTuple($result)){
                    echo "\n <tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['storeid'] ."</td>";
                    echo "</tr> \n";
                }
                ?>
                
            </table>
        </div>
    </div>
</body>
</html>