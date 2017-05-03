<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $id = $_SESSION['storesid'];
    
    $query="DELETE FROM stores WHERE id = $id;";
    
    $result=queryDB($query, $db);
    
    header('Location: Stores.php');
?>