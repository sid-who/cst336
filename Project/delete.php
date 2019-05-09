<?php

session_start();

if(!isset($_SESSION['adminName'])){
    exit;
}

include '../inc/dbConnection.php';

$conn = getDatabaseConnection("junkyard");

$sql = "DELETE FROM `jy_product` WHERE `jy_product`.`productId` = " . $_POST['productId'];

$stmt = $conn->prepare($sql);
$stmt->execute();

$sql = "DELETE from `jy_cart` WHERE `jy_cart`.`pId` = " . $_POST['productId'];

$stmt = $conn->prepare($sql);
$stmt->execute();

//echo $sql;

header("Location: admin.php");

?>