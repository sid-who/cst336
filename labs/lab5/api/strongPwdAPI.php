<?php

//echo "topS3cr3t!";

//$lettersArray = array("a", "b", "c"...);

$pwdLength = $_GET['length'];

$lettersArray = range("a","z");

//print_r($lettersArray); //displays all elements in an Array, for debugging purposes

$password = "";

for ($i = 0; $i < $pwdLength; $i++) {
    $randomIndex = rand(0,25); //generates random number from 0 to 25, inclusive
    $password = $password . $lettersArray[$randomIndex ]; //Use a DOT to concatanate strings
    //$password .=  $lettersArray[$randomIndex ]; /
}

$password[0] = rand(0,9);
$password = str_shuffle($password); //shuffles the letters of the password
//echo $password;

print_r($password);

$data = array();
$data["suggestedPwd"] = $password;

//echo json_encode($data);



?>
