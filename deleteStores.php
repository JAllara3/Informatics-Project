<?php
    include_once('config.php');
    include_once('dbutils.php');
    
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    session_start();
    
    $query_1 = "SELECT max(id) as NEW FROM stores;";
    
    $result_1 =queryDB($query_1, $db);
    
    $row = nextTuple($result_1);
    
    $id = $row['NEW'];
    
    $query="DELETE FROM stores WHERE id = $id;";
    
    $result=queryDB($query, $db);
    
    header('Location: Stores.php');
?>