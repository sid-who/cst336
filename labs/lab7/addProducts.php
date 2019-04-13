<?php
session_start();

//checks whether user has logged in
if (!isset($_SESSION['adminName'])) {
    
    header('location: login.html'); //sends users to login screen if they haven't logged in
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
    </head>
    
    <style>
        
        h1{
            text-align: center;
        }
        
        #formBorder{
            background: #98ffcc;
            color: blue;
            margin-left: 30%;
            margin-right: 30%;
            padding-top: 15px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 15px;
            border-radius:15px;
        }
        
        #totalProducts{
            font-weight: bold;
            color:red;
        }
        
    </style>
    
    
    <body>
       <div id="formBorder"> 
            <h1>Add new product</h1>
            
            <table class= "table table-bordered">
                <tr>
                    Enter Product Name:<input type="text" id = "productName" size="50">
                    <br><br>
                </tr>
                
                <tr>
                    Enter Product Description: <textarea id="productDescription" cols="40" rows="3"></textarea>
                    <br><br>
                </tr>
                
                <tr>
                    Product Image:<input type = "text" id = "productImage">
                    <br><br>
                </tr>
                
                <tr>
                    Product Price: <input type="text" id="productPrice">
                    <br><br>
                </tr>
                
                <tr>
                     Categories Name: <Select id = "catId">
                    <Option> Select One </Option>
                    </Select><br><br>
                <tr>
                    <br><br>
            
                    <button  class="btn btn-primary" id="submitButton">Add Product</button>
                    <br><br>
                </tr>
                
                <tr>
                    <form action="admin.php">
                        <button class="btn btn-primary">Take Me Back</button>
                    </form>
                </tr>
                
                <tr>
                    <br><br>
                    <span id="totalProducts"></span>
                </tr>
                
            </table>
        </div>
    </body>
    
    <script>
    /*global $*/
        $.ajax({
                    type: "GET",
                    url: "../lab6/api/getCategories.php",
                    dataType: "json",
                    success: function(data, status) {
                        data.forEach(function(key) {
                            $("#catId").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
                        });
                    }
                }); 
                
        $("#submitButton").on("click", function(){
                   //alert("test");
                   $.ajax({
                    type: "GET",
                    url: "api/addProductAPI.php",
                    dataType: "json",
                    data : {"productName": $("#productName").val(),
                        "productDescription": $("#productDescription").val(),
                        "productImage": $("#productImage").val(),
                        "productPrice": $("#productPrice").val(),
                        "catId": $("#catId").val()
                        
                    },
                    success: function(data, status) {
                        $("#totalProducts").html(data.totalproducts + " Products");
                    }
                }); 
        });
    </script>
</html>