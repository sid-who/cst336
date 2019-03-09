<?php
    
    //validates that username is not contained in the password.
    
    $username = $_GET['username'];
    $password = $_GET['pwd'];
    
    $data = array();
    //$data = "";
    
    if(stripos($password, $username) !== false)
    {
        $data["validPwd"] = false;
        //$data = "false";
    } else {
        //echo "Username is NOT included in password!";
        $data["validPwd"] = true;
        //$data = "true";
    }
    
    echo json_encode($data);

?>