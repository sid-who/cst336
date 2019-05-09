<?php

session_start();

if(!isset($_SESSION['adminName'])){
    exit;
}

include 'inc/dbConnection.php';

$conn = getDatabaseConnection("junkyard");

$productId = $_GET['productId'];

$sql = "UPDATE jy_product
        SET productPrice = :productPrice,
        productName = :productName,
        productDescription = :productDescription,
        productImage = :productImage
        WHERE jy_product.productId = " . $_GET['productId'];
        
$arr = array();

$arr[":productName"] = $_GET["productName"];
$arr[":productDescription"] = $_GET["productDescription"];
$arr[":productImage"] = $_GET["productImage"];
$arr[":productPrice"] = $_GET["productPrice"];

echo $arr;

$stmt = $conn->prepare($sql);
$stmt->execute($arr);

$sql = "UPDATE jy_cart
        SET pPrice = :productPrice,
        pName = :productName,
        pDescription = :productDescription,
        pImage = :productImage
        WHERE jy_cart.pId = " . $_GET['productId'];

$stmt = $conn->prepare($sql);
$stmt->execute($arr);        

?>