<?php

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Add New Product </title>
        <link rel="stylesheet" href="css/addProductStyles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
    <body>
        
      
        
        
        <center>
             <img src = "img/logo2.png" width = 100% />
        
        <br>
        <nav class="mynav">
            <a id="padding" href="home.php"><i class="fa fa-home"></i> Home </a>
            <a id="padding" href="directLogin.html"><i class="fa fa-user"></i> Login </a>
            <a id="padding" href="search.php"><i class="fa fa-search"></i> Search </a>
            <a id="padding" class="currentCart" href="cart.php"><i class="fa fa-shopping-cart"> Cart </i></a>
            <a id="padding" class="logout" href="logout.php"><i class="fa fa-times"></i> Logout </i></a>
        </nav>
        
        <div id = "main">
        <br>
        
        
        
        <form action="admin.php">
       <button id = "back">Back to Admin Page</button>
       </form>
       <br>
       
        <div id = "mainbody">
       Enter Product Name: <input type = "text" id = "productName" size = "50"> <br><br>
       <p id = "description">Enter Product Description:</p> <textarea id = "productDescription" cols = "50" rows = "2"></textarea><br><br>
       Enter Image URL: <input type = "text" id = "productImage"><br><br>
       Enter Product Price: <input type = "text" id = "productPrice"><br><br>
       Select Product Category: <select id="categories"></select><br><br>
       
       <br>
       </div>
       <button id = "submitButton">Add Product</button> 
       
       
       <br><br>
       
       <span id = "feedback"></span><br>
       
       </center>
       </div>
    </body>
    <script>
    /* global $ */
            $(document).ready(function(){
                $("#feedback").html("");
                
                /**added by Gurpreet**/
                $.ajax({
                    type:"GET",
                    url:"api/getCategories.php",
                    dataType:"json",
                    data:{},
                    success: function(data, status){
                        for(let i=0; i<data.length; i++)
                        {
                            $("#categories").append("<option value='" + data[i].catId + "'>" + data[i].catId
                            + ". " + data[i].catName + "</option>");
                        }
                    },
                    complete: function(data, status){
                        
                    }
                });//end select filling ajax    
                /**added by Gurpreet**/
                
            $("#submitButton").on("click", function(){
                if($("#productName").val() == "" || $("#productDescription").val() == "" || $("#productImage").val() == "" || $("#productPrice").val() == ""){
                    alert("Please fill out the necessary fields before proceeding!");
                }
                else{
                    $.ajax({
                type: "GET",
                url: "api/addProductAPI.php",
                dataType: "json",
                data : {"productName": $("#productName").val(),
                    "productDescription": $("#productDescription").val(),
                    "productImage": $("#productImage").val(),
                    "productPrice" : $("#productPrice").val(),
                    "catId": $("#categories").val(),
                    
                },
                success: function(data, status) {
                    $("#feedback").html($("#productName").val() + " has been added to the list!");
                }
            }); //ajax 
                    
                }
               
            });
            
            });
           
    </script>
</html>