<?php
session_start();
    
include 'api/inc/dbConnection.php';
    
$conn = getDatabaseConnection("junkyard");

$username = $_POST['username']; //contains what has been entered at the login
$password = sha1($_POST['password']);
//$password = $_POST['password'];

$sql = "SELECT * FROM jy_users WHERE username = :username AND password = :password";

$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;

$stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
$stmt->execute($namedParameters);
$record = $stmt->fetch(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple

if (empty($record)){
    echo "Username or Password are incorrect!";
    header('location: userLogin.php');
    $Color = "red";
    $Text = "Username or password is incorrect!";
    $_SESSION['error'] = '<div style="Color:'.$Color.'">'.$Text.'</div>' ;
}
else{
    echo $record['username'];
    header('location: home.php');
    $_SESSION['error'] = "";
    
    $_SESSION['userName'] = $record['username'];
}

?>