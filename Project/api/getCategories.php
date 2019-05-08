<?php

    include 'inc/dbConnection.php';
    
    $conn = getDatabaseConnection("junkyard");
    
    $sql = "SELECT catId, catName FROM jy_category ORDER BY catId";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($records);
?>