<?php
    
    include '../../../inc/dbConnection.php';
    
    $conn = getDatabaseConnection("hw4");
    
    $arr = array();
    
    $arr[":name"] = $_GET["name"];
    $arr[":url"] = $_GET["url"];
    
    if($arr[":name"] != null && $arr[":url"] != null)
    {
        $sql = "INSERT INTO hw4_prev (`url`, `name`) VALUES (:url, :name)";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
    
?>