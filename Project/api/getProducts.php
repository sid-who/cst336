
<?php

/*$host = "localhost";
$dbname = "ottermart";
$username = "root";
$password = "";*/

//SELECT AVG(productPrice) FROM `jy_product` WHERE 1 //gets the average price of all products
//SELECT * FROM `jy_product` ORDER BY `productPrice` DESC LIMIT 1  //gets the product with the highest price

include 'inc/dbConnection.php';
$dbConn = getDatabaseConnection("junkyard");

//Connecting to database
//$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

//Error Handling
$dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM jy_product ORDER BY productPrice LIMIT 50";
$stmt = $dbConn -> prepare($sql);  //$connection MUST be previously initialized
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple

//print_r($records);

echo json_encode($records);

?>
