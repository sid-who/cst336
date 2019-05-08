<?php
    include '../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("junkyard");
    
    $dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    $username = $_GET['username'];
    $productId = $_GET['productId'];
    
    //print_r($username);
    
    //$sql = "SELECT * FROM jy_cart WHERE uName = :username";
    $sql = "DELETE FROM `jy_cart` WHERE (uName='$username') AND (pId='$productId')";
    
    
    
    $stmt = $dbConn -> prepare($sql);  //$connection MUST be previously initialized
    $stmt->execute();
    //$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
    
    //print_r($records);
    
    //echo json_encode($records);
    //header("Location: cart.php");

?>