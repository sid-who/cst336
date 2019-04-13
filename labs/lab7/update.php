<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
         
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
            
            #updated{
                font-weight:bold;
                color:red;
            }
            
        </style>

         <script>
                $.ajax({
                    type: "GET",
                    url: "../lab6/api/getCategories.php",
                    dataType: "json",
                    success: function(data, status) {
                        data.forEach(function(key) {
                            $("#catId").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
                        });
                        getProductInfo();
                    }
                }); 
                
                
                 
            function getProductInfo() {    
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
                         $("#catId").val(data["catId"]).change();
                    }
                });
                
            }    
                
                $(document).ready(function(){  
                    
                    $("#submitButton").on("click",function(){
                        
                        $.ajax({
                            type: "GET",
                            url: "api/updateProductAPI.php",
                            dataType: "json",
                            data:{"productId": <?=$_GET['productId']?>,
                                "productDescription": $("#productDescription").val(),
                                "productPrice": $("#productPrice").val(),
                                "productName": $("#productName").val(),
                                "catId": $("#catId").val(),
                                "productImage": $("#productImage").val()
    
                            },
                            success: function(data, status) {
                                //$("#updated").html("Product Updated");
                            }
                            
                        });//end
                        $("#updated").html("Product Updated");
                    });
                    
                });//documentReady
                
                </script>
        
        
    </head>
    <body>
        <div id="formBorder">
            <h1> Update Product</h1>
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
                                 <button class="btn btn-primary" id="submitButton">Update Product</button>
                            
                            <br><br>
                        </tr>
                        
                        <tr>
                            <form action="admin.php">
                                <button class="btn btn-primary">Take Me Back</button>
                            </form>
                        </tr>
                        
                        <tr>
                            <br><br>
                            <span id="updated"></span>
                        
                    </table>
        </div>
    </body>
</html>