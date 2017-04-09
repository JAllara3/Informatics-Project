<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
    table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 5px;
}
</style>
        <title>Categories</title>
    </head>
    
    
<style>		
.center {
    margin: auto;
    width: 40%;
    border: 3px solid #DAF7A6;
    padding: 10px;
}
</style>

<body>
<!-- Menu bar -->
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <a class="navbar-brand"><strong>FastShop</strong></a>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="welcome.php">Home</a></li>
                <li class="active"><a href="Categories.php">Categories</a></li>
                <li><a href ="CLogin.php">Customer Login</a></li>
                <li><a href ="GLogin.php">Manager Login</a></li>
                <li><a href="logout.php">log out</a></li>
                
            </ul>
        </div>
    </nav>
    
    <!-- Title -->
    <div class="row">
        <div class="col-xs-12">
            <h1>Categories</h1>
        </div>
    </div>
    
    <!-- Add php here for dbutils, config, and creating tables linked to customer side -->
    <?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($dbhost, $dbuser, $dbpasswd, $dbname);
    
    $query = 'SELECT categories FROM database;');
    
    $result = queryDB($query, $db);
    
    while ($row = nextTuple($result)){
        echo '<p>';
        echo 'Name:' . $row['name'];
        echo '<p>';
    }
    ?>

</body>

</html>