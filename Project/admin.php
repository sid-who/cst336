<?php

session_start();

if(!isset($_SESSION['adminName'])){
    header('location: login.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Section </title>
        <link rel="stylesheet" href="css/adminstyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    
    <script>
        function confirmDelete(){
                
                return confirm("Are you sure you want to delete this product?");
                
            }
    
        /* global $ */
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "api/getProducts.php",
                dataType: "json",
                success: function(data, status) {
                   data.forEach(function(product) {
                        $("#products").append("<div class='row'>" +
                            "<div class='col1'>" + 
                            "<a class=\"btn btn-primary\"  href='update.php?productId="+product.productId+"'> Update </a>" +
                            //"[<a href='delete.php?productId="+product.productId+"'> Delete </a>]" +
                            "<form action='delete.php' method='post' onsubmit='return confirmDelete()'>"+
                            "<input type='hidden' name='productId' value='"+ product.productId + "'>" +
                            "<button id = 'delete' class=\"btn btn-danger\">Delete</button></form>" +
                            
                            "<span id = 'product'> " + product.productName + "</span></div>"+
                            "<div class='col2'>" + "$" + product.productPrice + "<img src = '" + product.productImage + "' id = 'Image' width=225 height=150 />" + 
                            "<span id = 'description'>" + product.productDescription + "</span>" + "</div>" +
                            "</div> <br>");
                    });
                    
                },
                complete: function(data, status) { //optional, used for debugging purposes
                    //alert(status);
                }

            }); //ajax 
            
            //Some seriously ugly nested ajax calls
            
            $("#report").on("click", function(){
                $("#reportResults").html("");
                $.ajax({
                type: "GET",
                url: "api/getCount.php",
                dataType: "json",
                success: function(data, status) {
                        $("#reportResults").append("There are currently " + data.total + " products in the database. <br>");
                        
                         $.ajax({
                            type: "GET",
                            url: "api/getMax.php",
                            dataType: "json",
                            success: function(data, status) {
                                    $("#reportResults").append("Most expensive product is " + data.productName + " at $" + data.productPrice + " <br>");
                                    
                                         $.ajax({
                                        type: "GET",
                                        url: "api/getMin.php",
                                        dataType: "json",
                                        success: function(data, status) {
                                                $("#reportResults").append("Least expensive product is " + data.productName + " at $" + data.productPrice + " <br>");
                                        },

                                    }); //ajax 
                                },

                             }); //ajax 
                            },

                     }); //ajax 
                 
                 
                
                 
                
            });
        });// document ready
    </script>

    <style>
        .row {
            display: flex;
            margin-left: 5%;
            margin-right: 5%;
            padding-left: 5px;
        }

        .col1 {
            width: 450px;
            padding-left: 10px;
        }
        
        form{display: inline-block;}
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
        <center>
            
        <br>
        
        Welcome <?=$_SESSION['adminName']?>
        
        </center>
        
        <br>
        
        <center>
        
        <form action="addProducts.php">
            <button id= "add" class = "btn-primary" >Add New Product</button>
        </form>
        
        <button id = "report" class = "btn-info">Data Report</button>
        
        <form action="logout.php">
            <button id = "logout" class = "btn-danger">Logout</button>
        </form>
        
        <br><br>
        
        <div id = "reportResults"></div>
        
        </center>
        
        <br><br>
        
        <div id = "products">
            
        </div>
        
        </div>

    </body>
</html>