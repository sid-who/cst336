<?php
session_start();

//session_destroy();

if(!isset($_SESSION['userName'])){
    $_SESSION['userName'] = "no_user";
}
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Search for Products </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <style>
            #container {
                text-align:center;
            }
            
            #searchForm {
                display:inline-block;
            }
            
            #main{
                background-color:#efefef;
                padding-bottom: 200px;
            }
            #padding{
                padding-left: 50px;
            }
       
        </style>
        
        
        <script>
        /*global $*/
            
            var userVar = '<?php echo $_SESSION['userName']?>';
            var myCart = [];
            
            function inCart(productNumber)
            {
                //alert(productNumber);
                let temp = productNumber;
                //alert(myCart.length)
                for(let x=0; x<myCart.length; x++)
                {
                    if(myCart[x] == temp)
                    {
                        //alert(true);
                        return true;
                    }
                }
                //return false;
            }
            
            function getCart(){
                if(userVar != "no_user")
                {
                       $(".logout").show();
                       //alert("you are here");
                       $.ajax({
                            type: "GET",
                            url: "api/getCartInfo.php",
                            dataType: "json",
                            data:{"username":userVar},
                            success: function(data,status) {
                                //alert("you are here");
                                if(data.length > 0)
                                {
                                    for(let i = 0; i < data.length; i++)
                                    {
                                        myCart.push(data[i].pId);
                                    }
                                    //alert(myCart.length);
                                    let cartlen = myCart.length;
                                    //alert(cartlen);
                                    $(".currentCart").html("<i class='fa fa-shopping-cart'> Cart (" + cartlen + ")" + "</i>");
                                }
                            
                            },
                            complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                            }
                            
                        });//ajax
                       
                   }
                   else
                   {
                       $(".currentCart").html("<i class='fa fa-shopping-cart'> Cart (" + "0" + ")" + "</i>");
                   }
                }
            
            
            function viewAllProducts() {
                
                $.ajax({
                    
                    method: "GET",
                    url: "api/getAllProductsAPI.php",
                    dataType: "json",
                    success: function(data, status){
                        
                        $("#products").html("");
                        
                        let htmlstring = "";
                        let i=0;
                        let rowsize = 0;
                        let iterations = 0;
                        
                        //htmlstring+="<div class='container'>";
                        htmlstring+="<div class='card-deck'>";
                        for(let i=0;i<data.length;i++){
                            if(iterations == data.length)
                            {
                                break;
                            }
                            else
                            {
                                if(rowsize < 4)
                                {
                                  htmlstring+="<div class='card'>";
                                  htmlstring+="<img class='card-img-top' src='" + data[i].productImage + "'>";
                                  htmlstring+="<div class='card-body'>";
                                  htmlstring+="<h5 class='card-title'>" + data[i].productName + "</h5>" ;
                                  htmlstring+="<p class='card-text'> Price: $" + data[i].productPrice + "</p>";
                                  htmlstring+="<p class='card-text'> Description: " + data[i].productDescription + "</p>";
                                  
                                      if(userVar == "no_user")
                                      {
                                          htmlstring+="<button class='btn btn-primary' value='" + data[i].productId + "' id='nouser'> <i class='fa fa-user'></i>" + " Please Login" + "</Button>";
                                      }
                                      else
                                      {
                                          if(inCart(data[i].productId) == true)
                                          {
                                              htmlstring+="<button class='btn btn-success' value='" + data[i].productId + "'> <i class='fa fa-check'></i>" + " In Cart! " + "</Button>";
                                              //<i class='fa fa-check'> In cart!</i>
                                          }
                                          else
                                          {
                                              htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                          }
                                       }
                                  
                                  //htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                  //htmlstring+="<div id='prid" + i + "'>" + data[i].productId + "</div>";
                                  htmlstring+="</div>";//end card image
                                  //htmlstring+="</div>";
                                  htmlstring+="</div>";//end card style
                                  rowsize+=1;
                                }
                                else if(rowsize == 4)
                                {
                                    htmlstring+="</div>";
                                    htmlstring+="<br><div class='card-deck'>";
                                  htmlstring+="<div class='card'>";
                                  htmlstring+="<img class='card-img-top' src='" + data[i].productImage + "'>";
                                  htmlstring+="<div class='card-body'>";
                                  htmlstring+="<h5 class='card-title'>" + data[i].productName + "</h5>" ;
                                  htmlstring+="<p class='card-text'> Price: $" + data[i].productPrice + "</p>";
                                  htmlstring+="<p class='card-text'> Description: " + data[i].productDescription + "</p>";
                                  
                                      if(userVar == "no_user")
                                      {
                                          htmlstring+="<button class='btn btn-primary' value='" + data[i].productId + "' id='nouser'> <i class='fa fa-user'></i>" + " Please Login" + "</Button>";
                                      }
                                      else
                                      {
                                          if(inCart(data[i].productId) == true)
                                          {
                                              htmlstring+="<button class='btn btn-success' value='" + data[i].productId + "'> <i class='fa fa-check'></i>" + " In Cart! " + "</Button>";
                                              //<i class='fa fa-check'> In cart!</i>
                                          }
                                          else
                                          {
                                              htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                          }
                                       }
                                  
                                  //htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                  //htmlstring+="<div id='prid" + i + "'>" + data[i].productId + "</div>";
                                  htmlstring+="</div>";//end card image
                                  //htmlstring+="</div>";
                                  htmlstring+="</div>";//end card style
                                  rowsize=0;
                                }
                            }
                                  
                        }
                        
                        $("#products").append(htmlstring);
                            
                    },
                    complete: function(data, status){
                        
                    }
                });//end of ajax
            }//end of function viewAllProducts
                  
                  
            
            
            function search() {
                
                //alert("hey the button works");
                //alert($("#catSelect").val());
                
                $.ajax({
                    
                    method: "GET",
                    url: "api/specialSearchAPI.php",
                    dataType: "json",
                    data: {
                            "keyword": $("#keyword").val(),
                            "catId": $("#catSelect").val(),
                            "sort": $("input[name=sort]:checked").val(),
                            "order": $("input[name=order]:checked").val()
                           },
                    success: function(data, status) {
                      //  alert(data);
                    
                        $("#products").html("");
                        
                        let htmlstring = "";
                        let i=0;
                        let rowsize = 0;
                        let iterations = 0;
                        
                        //htmlstring+="<div class='container'>";
                        htmlstring+="<div class='card-deck'>";
                        for(let i=0;i<data.length;i++){
                            if(iterations == data.length)
                            {
                                break;
                            }
                            else
                            {
                                if(rowsize < 4)
                                {
                                  htmlstring+="<div class='card'>";
                                  htmlstring+="<img class='card-img-top' src='" + data[i].productImage + "'>";
                                  htmlstring+="<div class='card-body'>";
                                  htmlstring+="<h5 class='card-title'>" + data[i].productName + "</h5>" ;
                                  htmlstring+="<p class='card-text'> Price: $" + data[i].productPrice + "</p>";
                                  htmlstring+="<p class='card-text'> Description: " + data[i].productDescription + "</p>";
                                  
                                  if(userVar == "no_user")
                                      {
                                          htmlstring+="<button class='btn btn-primary' value='" + data[i].productId + "' id='nouser'> <i class='fa fa-user'></i>" + " Please Login" + "</Button>";
                                      }
                                      else
                                      {
                                          if(inCart(data[i].productId) == true)
                                          {
                                              htmlstring+="<button class='btn btn-success' value='" + data[i].productId + "'> <i class='fa fa-check'></i>" + " In Cart! " + "</Button>";
                                              //<i class='fa fa-check'> In cart!</i>
                                          }
                                          else
                                          {
                                              htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                          }
                                       }
                                  
                                  //htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                  //htmlstring+="<div id='prid" + i + "'>" + data[i].productId + "</div>";
                                  htmlstring+="</div>";//end card image
                                  //htmlstring+="</div>";
                                  htmlstring+="</div>";//end card style
                                  rowsize+=1;
                                }
                                else if(rowsize == 4)
                                {
                                    htmlstring+="</div>";
                                    htmlstring+="<br><div class='card-deck'>";
                                  htmlstring+="<div class='card'>";
                                  htmlstring+="<img class='card-img-top' src='" + data[i].productImage + "'>";
                                  htmlstring+="<div class='card-body'>";
                                  htmlstring+="<h5 class='card-title'>" + data[i].productName + "</h5>" ;
                                  htmlstring+="<p class='card-text'> Price: $" + data[i].productPrice + "</p>";
                                  htmlstring+="<p class='card-text'> Description: " + data[i].productDescription + "</p>";
                                  
                                  if(userVar == "no_user")
                                      {
                                          htmlstring+="<button class='btn btn-primary' value='" + data[i].productId + "' id='nouser'> <i class='fa fa-user'></i>" + " Please Login" + "</Button>";
                                      }
                                      else
                                      {
                                          if(inCart(data[i].productId) == true)
                                          {
                                              htmlstring+="<button class='btn btn-success' value='" + data[i].productId + "'> <i class='fa fa-check'></i>" + " In Cart! " + "</Button>";
                                              //<i class='fa fa-check'> In cart!</i>
                                          }
                                          else
                                          {
                                              htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                          }
                                       }
                                  
                                  //htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                  //htmlstring+="<div id='prid" + i + "'>" + data[i].productId + "</div>";
                                  htmlstring+="</div>";//end card image
                                  //htmlstring+="</div>";
                                  htmlstring+="</div>";//end card style
                                  rowsize=0;
                                }
                            }
                                  
                        }
                        
                        $("#products").append(htmlstring);
                            
                    },
                    
                    error: function(data, status) {
                        //alert("We don't sell that...!");
                        $("#products").html("<center><font color='red'> No results found </font></center>");
                        //alert(data);
                    },
                }); // ajax
            } // specialSearch()
            
            $(document).ready(function(){
                $(".logout").hide();
                
                getCart();
                
                //this call will recieve the categories and insert the category options into the select input 
                $.ajax({
                   
                   method: "GET",
                   url: "api/getCategories.php",
                   dataType: "json",
                   success: function(data, status) {
                       
                       //alert(data[1].catId);
                       
                       data.forEach(function(category) {
                           
                           $("#catSelect").append("<option value='" + category.catId + "'>" + category.catName + "</option>");
                           
                       }); // forEach
                   } // success
                }); // ajax
                
                /*********************ADDED BY GURPREET, 5.6.19*******/
                $("#products").on("click", "#atc",function(){
                    //let temp = $(this).attr("prid");
                    //alert(temp);
                    
                    let temp = $(this).attr("value");
                    //alert(temp);
                    addCart(temp);
                    $(this).hide();
                    $(this).html("<i class='fa fa-check'> In cart!</i>");
                    $(this).attr("class", "btn btn-success");
                    $(this).show();
                });
            
                $("#added").on("click", "#nouser",function(){
                    //alert(location.href);
                    var url = location.href;
                    url = url.replace(/\/[^\/]*$/, '/directLogin.html');
                    window.location = url;
                });
            
                function addCart(value){
                    //alert("this started");
                    let idtemp = value;
                    //alert("Passed in:" + idtemp);
                    $.ajax({
                        type:"GET",
                        url:"api/findProdCart.php",
                        dataType: "json",
                        data:{"pid": idtemp},
                        success: function(data, status){
                            //alert(data["productName"]);
                            let pname = data["productName"];
                            let pimage = data["productImage"];
                            let pdesc = data["productDescription"];
                            let pid = data["productId"];
                            let pprice = data["productPrice"];
                            
                            addCart2(pname,pimage,pdesc,pid,pprice);
                        },
                        complete: function(data, status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    });//end outer ajax, 
                }
                
                function addCart2(name,image,desc,id,price){
                    let pname = name;
                    let pimage = image;
                    let pdesc = desc;
                    let pid = id;
                    let pprice = price;
                    
                    $.ajax({
                        type: "GET",
                        url: "api/addToCart.php",
                        dataType: "",
                        data: 
                        { 
                            "pname":pname,
                            "pimage":pimage,
                            "pdesc":pdesc,
                            "pid":pid,
                            "pprice":pprice,
                            "pusername":userVar,
                            
                        },
                        success: function(data,status) {
                            //alert(data);
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                            //alert(status);
                        }
                    
                    });//ajax
                }
            
            /*********************ADDED BY GURPREET, 5.6.19*******/
                
                
            }); // document ready
                
            
            
        </script>
        
    </head>
    <body>
        <img src = "img/logo2.png" width = 100% /><br>
        
        <!--<h1>Search for Products</h1>-->
        
        <nav class="mynav">
            <a id="padding" href="home.php"><i class="fa fa-home"></i> Home </a>
            <a id="padding" href="directLogin.html"><i class="fa fa-user"></i> Login </a>
            <a id="padding" href="search.php"><i class="fa fa-search"></i> Search </a>
            <a id="padding" class="currentCart" href="cart.php"><i class="fa fa-shopping-cart"> Cart </i></a>
            <a id="padding" class="logout" href="logout.php"><i class="fa fa-times"></i> Logout </i></a>
        </nav>
        <div id = "main">
        
        <!--<button type="button" id="allProductsButton" onclick="viewAllProducts()">View All Products</button>-->
        <!--<button type="button" id="specialSearchButton" onclick="specialSearch()">Special Search</button>-->
        <br>
        
        <div class="container" id="container">
            <div id="searchForm">
                
                Categories: 
                <select id="catSelect">
                    <option value="">All Categories</option>
                </select>
                <br><br>
                
                Keyword: <input type="text" id="keyword">
                <br><br>
                
                
                Sort By: 
                <input checked="checked" type="radio" id="nameSort" name="sort" value="productName"><label for="nameSort">Name</label>
                <input type="radio" id="priceSort" name="sort" value="productPrice"><label for="priceSort">Price</label>
                <br><br>
                
                Order: 
                <input checked="checked" type="radio" id="ascending" name="order" value="ASC"><label for="ascending">Ascending</label>
                <input type="radio" id="descending" name="order" value="DESC"><label for="descending">Descending</label>
                <br><br>
                
                <button class="btn btn-primary" onclick="search()">Search!</button>
                
            </div>
        </div>
        
        <hr>
        
        
        <!--table will be hidden upon loading into the page-->
        <!--will then be filled with values based on search-->
        <!--<table class="table">-->
        <!--  <thead>-->
        <!--    <tr>-->
        <!--      <th scope="col">Price</th>-->
        <!--      <th scope="col">Product Name</th>-->
        <!--      <th scope="col">Decription</th>-->
        <!--      <th scope="col">Image</th>-->
        <!--    </tr>-->
        <!--  </thead>-->
        <!--  <tbody id="resultsTable">-->
        <!--  </tbody>-->
        <!--</table>-->
        
        
        <div id="products" class="container">
            
        </div>
    </div>    
    
    </body>
    
</html>

