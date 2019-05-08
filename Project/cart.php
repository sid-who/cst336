<?php

session_start();

if(!isset($_SESSION['userName'])){
    header('location: userLogin.php');
}
if($_SESSION['userName'] == "no_user")
{
    header('location: userLogin.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Cart </title>
            <link rel="stylesheet" href="css/adminstyles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        
        <style>
            #heading{
                padding-left:10px;
            }
            
            #thumb{
                width:100px;
                height:100px;
            }
            #mytable{
                
                color: blue;
                
                padding-top: 15px;
                padding-left: 200px;
                padding-right: 200px;
                padding-bottom: 15px;
                border-radius:15px;
            }
            #padding{
                padding-left: 50px;
            }
            
            #main{
                background-color: #efefef;
            }
            
        </style>
        
        <script>
            var userVar = '<?php echo $_SESSION['userName']?>';
            
            var total = 0;
            
            var myCart = [];
            
            function confirmDelete(){
                
                return confirm("Are you sure you want to delete this product?");
                
            }
            
            function getCart()
            {
                $.ajax({
                    type: "GET",
                    url: "api/getCartInfo.php",
                    dataType: "json",
                    data:{"username":userVar},
                    success: function(data,status) {
                        //alert("you are here");
                        let htmlstring="";
                        if(data.length > 0)
                        {
                            for(let i = 0; i < data.length; i++)
                            {
                                htmlstring += "<tr>";
                                htmlstring += "<td>  <img id='thumb' src='" + data[i].pImage + "'>" +"</td>";
                                htmlstring += "<td>" + data[i].pName + "</td>";
                                htmlstring += "<td> $" + data[i].pPrice + "</td>";
                                htmlstring += "<td>" + "<button class='btn btn-warning' value='" + data[i].pId + "' id='removeItem'> <i class='fa fa-times'></i>" + " Remove Item" + "</Button>";
                                htmlstring += "</tr>";
                                total += Number.parseFloat(data[i].pPrice, 2);
                                myCart.push(data[i].pId);
                            }
                            let fTotal = 0;
                            fTotal = parseFloat(Math.round(total)).toFixed(2);
                            htmlstring += "<tr><td></td><td><h3> Total Cost </h3></td> <td><h3> $" + fTotal +"</h3></td><td><button class='btn btn-danger' id='removeAll'> <i class='fa fa-times'></i> Empty the Cart </buton></td>";
                            $("#cartItems").append(htmlstring);
                            let cartlen = myCart.length;
                            $(".currentCart").html("<i class='fa fa-shopping-cart'> Cart (" + cartlen + ")" + "</i>");
                        }
                        else
                        {
                             $("#empty").html("The cart is empty.")
                             $(".currentCart").html("<i class='fa fa-shopping-cart'> Cart (" + "0" + ")" + "</i>");
                        }
                        
                    
                    },
                    complete: function(data,status) { //optional, used for debugging purposes
                    //alert(status);
                    }
                    
                });//ajax
                
            }
        
            $(document).ready(function(){
                $("#heading").html(userVar + "'s Cart");
                var url = location.href;
                if(userVar != "no_user")
                {
                    getCart();
               
                }
                else
                {
                    var url = location.href;
                    url = url.replace(/\/[^\/]*$/, '/directLogin.html');
                    window.location = url;
                }
                
                $("#cartItems").on("click", "#removeItem", function(){
                   //confirmDelete();
                   if(confirmDelete() == true)
                   {
                       let temp = $(this).attr("value");
                       //lert(temp);
                        $.ajax({
                            type: "GET",
                            url: "removeFromCart.php",
                            dataType: "json",
                            data:{"username":userVar,
                                "productId":temp,
                            },
                            success: function(data,status) {
                                //location.reload();
                            },
                            complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                            }
                        });//end ajax
                        location.reload();
                   }
                });//end click   
                
                
                $("#cartItems").on("click", "#removeAll", function(){
                    
                   //confirmDelete();
                   if(confirmDelete() == true)
                   {
                       let temp = $(this).attr("value");
                       //lert(temp);
                        $.ajax({
                            type: "GET",
                            url: "api/emptyCart.php",
                            dataType: "json",
                            data:{"username":userVar,
                                "productId":temp,
                            },
                            success: function(data,status) {
                                //location.reload();
                            },
                            complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                            }
                        });//end ajax
                        location.reload();
                   }
                });//end click  
               
            });
        </script>
        
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
        
        <div id = "main">
        
        <div id="mytable">
            <table class="table">
            <thead>
                <th id="heading" scope="col"></th>
                <th scope="col">Item</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </thead>
            <tbody id="cartItems"></tbody>
            
        </table>
        <center><div id="empty"></div></center>
        </div>
        
        </div>

    </body>
</html>