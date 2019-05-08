<!DOCTYPE html>
<html>
    <head>
        <title> Update Product </title>
        
         <link rel="stylesheet" href="css/addProductStyles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

         <script>
         $(document).ready(function(){
             $.ajax({
                    type: "GET",
                    url: "api/getProductInfo.php",
                    dataType: "json",
                    data:{"productId": <?=$_GET['productId']?>},
                    success: function(data, status) {
                         $("#productName").val(data["productName"]);
                         $("#productDescription").val(data["productDescription"]);
                         $("#productPrice").val(data["productPrice"]);
                         $("#productImage").val(data["productImage"]);
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                          //alert(status);
                      }
                    
                });
                
                $("#submitButton").on("click",function(){
                      $.ajax({
                            type: "GET",
                            url: "api/updateProductAPI.php",
                            dataType: "json",
                            data:{"productId": <?=$_GET['productId']?>,
                                "productDescription": $("#productDescription").val(),
                                "productPrice": $("#productPrice").val(),
                                "productName": $("#productName").val(),
                                "productImage": $("#productImage").val()
    
                            },
                            success: function(data, status) {
                                
                            }
                            
                        });//ajax
                        $("#updated").html("Product Updated Successfully");
                });
             
         });
         
         
        </script>
        
        
    </head>
    <body>
 <center>
             <img src = "img/logo2.png" width = 100% />
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
       
       <br>
       </div>
       <button id = "submitButton">Update Product</button> 
       
       <br><br>
       
       <span id = "updated"></span><br>
       
       </center>
    
    
    </div>
    
    
    
    </body>
</html>