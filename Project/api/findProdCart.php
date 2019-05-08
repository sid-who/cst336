<?php
    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("junkyard");
    
    $productId = $_GET['pid'];
    $sql = "SELECT * FROM jy_product WHERE productId = $productId";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($product);

?>
