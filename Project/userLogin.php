<?php

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title> User Login Screen </title>
        <link rel="stylesheet" href="css/styles.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <style>
        #padding{
                padding-left: 50px;
            }
    </style>
    
    </head>
    <body>
        <img src = "img/logo2.png" width = 100% /><br>
        <nav class="mynav">
            <a id="padding" href="home.php"><i class="fa fa-home"></i> Home </a>
            <a id="padding" href="directLogin.html"><i class="fa fa-user"></i> Login </a>
            <a id="padding" href="search.php"><i class="fa fa-search"></i> Search </a>
            <a id="padding" class="currentCart" href="cart.php"><i class="fa fa-shopping-cart"> Cart </i></a>
            <a id="padding" class="logout" href="logout.php"><i class="fa fa-times"></i> Logout </i></a>
        </nav>
        <div id = "mainBody">
        <br>
        
        <form method = "POST" action = "userLogProcess.php" id = "login2">
            
            Username: <input type="text" name="username" id = "username"/><br><br>
            Password: <input type="password" name="password" id = "password"/><br><br>
            
            
            <input class="btn btn-primary" type = "submit" value = "Login!">
            
        </form>
        
        <br><center id = "error"><?=$_SESSION['error']?></center>
        
        </div>

    </body>
</html>