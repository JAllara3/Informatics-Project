<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();

    $id = $_SESSION['Pid'];
    
    $cartid = $_SESSION['cartid'];
    
    $query="DELETE from productorder where id = $id and cartid=$cartid;";
    
    $result=queryDB($query,$db);
    
    header('Location: store_one_shopping.php');
?>