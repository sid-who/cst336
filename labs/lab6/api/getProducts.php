<?php

//header('Access-Control-Allow-Origin: *');

/*$host = "localhost";
$dbname = "ottermart";
$username = "root";
$password = "";*/

include '../dbConnection.php';
$conn = getDatabaseConnection("ottermart");

// Establishing a connection
//$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Setting Errorhandling to Exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sql = "SELECT * FROM om_product ORDER BY productPrice";
$stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple

//print_r($records); //displays array content

echo json_encode($records);

//echo $records[0]['productName'];
?>