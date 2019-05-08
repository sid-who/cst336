<?php
    include '../../inc/dbConnection.php';
    $dbConn = getDatabaseConnection("junkyard");
    
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql =  "SELECT * FROM jy_product WHERE 1";
    $stmt = $dbConn -> prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    
    shuffle($records);
    
    //print_r($records);
    //print_r("---------------------------------------------------");
    
    echo json_encode($records);
    
    
?>