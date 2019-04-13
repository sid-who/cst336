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
        <title> Ottermart - Admin Section </title>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <script>
        
            function confirmDelete(){
                
                return confirm("Are you sure you want to delete this product?");
                
            }
            
            function openModal(){
                $('#productModal').modal("show"); //opens the modal
            }
            
            $(document).ready(function(){
                
                //Gets first 10 products from the database and displays them
                $.ajax({

                    type: "GET",
                    url: "../lab6/api/getProducts.php",
                    dataType: "json",
                    success: function(data,status) {
                      //alert(data[0].productName);
                      data.forEach(function(product){
                          $("#products").append("<div class='row'>" + 
                                                "<div class='col1'>" + 
                                                "<a class=\"btn btn-primary\"  href='update.php?productId="+product.productId+"'> Update </a>" +
                                                //"[<a href='delete.php?productId="+product.productId+"'> Delete </a>]" +
                                                "<form action='delete.php' method='post' onsubmit='return confirmDelete()'>"+
                                                "<input type='hidden' name='productId' value='"+ product.productId + "'>" +
                                                "<button class=\"btn btn-outline-danger\">Delete</button></form>" +
                                                "<a target='productIframe' onclick='openModal()' href='productInfo.php?productId="+product.productId+"'> " + product.productName + "</a></div>"+
                                                "<div class='col2'>"+"$" + product.productPrice + "</div>"+
                                                "</div><br>");
                      })
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                });//ajax
                
               
                
            });//documentReady
            
        </script>
        
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     

        <style>
        
            .row  { 
                display:flex;
                
            }
        
            .col1 { width:350px; }
            
            form { display: inline-block; }
            
            #products {
                 margin: 35px;
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

        </style>   
        
        
        
    </head>
    <body>

        <h1> Ottermart - Admin Section </h1>

        <div id="here">Welcome <?=$_SESSION['adminName']?></div>
        
    <br><hr><br>
    
    <div id="buttons">
        <form action="addProducts.php">
            <button class="btn btn-primary">Add New Product</button>
        </form>
        
        <form action="logout.php">
            <button class="btn btn-primary">Logout</button>
        </form>
        
        <br><br>
    </div>
    
     <div id="products"></div>
     
     
   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>

<!-- Modal -->
<div>
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Product Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe name="productIframe"  width="400" height="400"></iframe>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
</div>


    </body>
</html>