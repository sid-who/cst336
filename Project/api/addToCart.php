<?php
    include '../../inc/dbConnection.php';
    $conn = getDatabaseConnection("junkyard");
    
    $arr = array();
    
    $arr[":pname"] = $_GET["pname"];//name
    $arr[":pimage"] = $_GET["pimage"];//image
    $arr[":pdesc"] = $_GET["pdesc"];//desc
    $arr[":pid"] = $_GET["pid"];//id
    $arr[":pprice"] = $_GET["pprice"];//price
    $arr[":pusername"] = $_GET["pusername"];
    
    
    /*Does not work*///$sql = "INSERT INTO jy_cart (`pName`,`pImage`,`pDescription`,`pId`,`pPrice`,`pQuantity`) SELECT DISTINCT VALUES (:pname,:pimage,:pdesc,:pid,:pprice, 1)";
    /*Does not work*///$sql = "INSERT DISTINCT INTO jy_cart (`pName`,`pImage`,`pDescription`,`pId`,`pPrice`,`pQuantity`) VALUES (:pname,:pimage,:pdesc,:pid,:pprice, 1)";
    $sql = "INSERT INTO jy_cart (`pName`,`pImage`,`pDescription`,`pId`,`pPrice`,`pQuantity`, `uName`) VALUES (:pname,:pimage,:pdesc,:pid,:pprice, 1,:pusername)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($arr);
    
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($records);
    
?>