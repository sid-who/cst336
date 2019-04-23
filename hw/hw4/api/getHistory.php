<?php
    include '../../../inc/dbConnection.php';
    
    $conn = getDatabaseConnection("hw4");
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM hw4_prev WHERE 1";
    $stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
    
    rsort($records);
    echo json_encode($records);


?>