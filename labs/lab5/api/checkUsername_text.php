<?php
    //echo $_GET['username'];
    $usernames = array("eeny", "meeny");
    $usernames[] = "miny";
    array_push($usernames, "maria", "john");
    
    //print_r($usernames);
    
    if(in_array(strtolower($_GET['username']), $usernames)){
        echo "Not Available!!";
    }
    else
    {
        echo "Available!";
    }
?>