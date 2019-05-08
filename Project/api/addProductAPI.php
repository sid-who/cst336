<?php

include 'inc/dbConnection.php';

$conn = getDatabaseConnection("junkyard");

$arr = array();

$arr[":productName"] = $_GET["productName"];
$arr[":productDescription"] = $_GET["productDescription"];
$arr[":productImage"] = $_GET["productImage"];
$arr[":productPrice"] = $_GET["productPrice"];
$arr[":catId"] = $_GET["catId"];
$arr[":inCart"] = "FALSE";

$sql = "INSERT INTO jy_product ( `productName`, `productDescription`, `productImage`, `productPrice`, `categoryNum`, `inCart` ) VALUES ( :productName, :productDescription, :productImage,
:productPrice, :catId, :inCart )";

$stmt = $conn->prepare($sql);
$stmt->execute($arr);
$sql = "SELECT COUNT(1) totalproducts FROM jy_product";
$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetch(PDO::FETCH_ASSOC);
echo json_encode($records);
?>