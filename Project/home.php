<?php
//session_destroy();
session_start();

//session_destroy();

if(!isset($_SESSION['userName'])){
    $_SESSION['userName'] = "no_user";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Home Page </title>
        <link rel="stylesheet" href="css/adminstyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    
    
    <style>
        body{
            background-color:white;
        }
        #formBorder{
                background-color:#efefef;
                /*background: white;*/
                color: blue;
                
                padding-top: 15px;
                padding-left: 20px;
                padding-right: 20px;
                padding-bottom: 15px;
                border-radius:15px;
            }
        #added{
            text-align:center;
        }
        #centered{
            margin-left:30%;
            margin-right:30%;
        }
        #centered1{
            margin-left:25%;
            margin-right:30%;
        }
        .mynav{
            text-align:center;
            background-color: orange;
            padding-bottom: 20px;
            padding-top: 20px;
        }
        #featured{
            text-align:center;
        }
        .carousel-control-next {
            filter: invert(100%);
        }
        .carousel-control-prev {
            filter: invert(100%);
        }
        a{
            padding-right:5px;
        }
        #prid0, #prid1, #prid2, #prid3, #prid4{
            display:none;
        }
        #padding{
            padding-left: 50px;
        }
        #main{
            background-color:#efefef;
            padding-bottom: 20px;
        }
    </style>
    
    <script>
    /*global $*/
        var userVar = '<?php echo $_SESSION['userName']?>';
        
        $(".logout").hide();
        //alert(userVar);
        var myCart = [];
        
        function getCarousel(){//setTimeout(function(){
               $.ajax({
                  type: "GET",
                  url: "api/getFeatured.php",
                  dataType: "json",
                  success: function(data, status){
                      feat = [];
                      let htmlstring = "";
                      for(let i=0;i<5;i++){
                          if(i==0)
                          {
                              /*htmlstring+="<div class='carousel-item active'>";
                              htmlstring+="<img src='" + data[i].productImage + "'width='300' height='280'>";
                              htmlstring+="</div>";*/
                              htmlstring+="<div class='carousel-item active'>";
                              //htmlstring+="<div id='centered1'>";
                              htmlstring+="<center>";
                              htmlstring+="<div class='card' style='width: 28rem;'>";
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
                                      //alert(data[i].productName + "is in the cart!!")
                                      htmlstring+="<button class='btn btn-success' value='" + data[i].productId + "'> <i class='fa fa-check'></i>" + " In Cart! " + "</Button>";
                                      //<i class='fa fa-check'> In cart!</i>
                                  }
                                  else
                                  {
                                      htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                  }
                              }
                              //htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                              htmlstring+="<div id='prid" + i + "'>" + data[i].productId + "</div>";
                              htmlstring+="</div>";//end card image
                              //htmlstring+="</div>";
                              htmlstring+="</center>";
                              htmlstring+="</div>";//end card style
                              htmlstring+="</div>";//end carousel style
                              
                              feat.push(data[i].productId);
                              
                          }
                          else
                          {
                              /*htmlstring+="<div class='carousel-item'>";
                              htmlstring+="<img src='" + data[i].productImage + "'width='300' height='280'>";
                              htmlstring+="</div>";*/
                              htmlstring+="<div class='carousel-item'>";
                              htmlstring+="<center>";
                              //htmlstring+="<div id='centered1'>";
                              htmlstring+="<div class='card' style='width: 28rem;'>";
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
                                      //alert(data[i].productName + "is in the cart!!")
                                      htmlstring+="<button class='btn btn-success' value='" + data[i].productId + "'> <i class='fa fa-check'></i>" + " In Cart! " + "</Button>";
                                      //<i class='fa fa-check'> In cart!</i>
                                  }
                                  else
                                  {
                                    htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                                  }
                              }
                              //htmlstring+="<button class='btn btn-danger' value='" + data[i].productId + "' id='atc'> <i class='fa fa-shopping-cart'></i>" + " Add to Cart" + "</Button>";
                              htmlstring+="<div id='prid" + i +"'>" + data[i].productId + "</div>";
                              htmlstring+="</div>";//end card image
                              //htmlstring+="</div>";
                              htmlstring+="</center>";
                              htmlstring+="</div>";//end card style
                              htmlstring+="</div>";//end carousel style
                              
                              feat.push(data[i].productId);
                             
                          }
                      }
                      $("#added").append(htmlstring);
                      
                  }
               });//end ajax to get featured products
            //},300);
           }
        
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
                            getCarousel();
                        }
                        else{
                            $(".currentCart").html("<i class='fa fa-shopping-cart'> Cart (" + "0" + ")" + "</i>");
                            getCarousel();
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
               getCarousel();
           }
        }
        
    
        $(document).ready(function(){
           $(".logout").hide();
           
           //alert(userVar);
           var feat = [];
           getCart();
           
           
           
           $("#added").on("click", "#atc",function(){
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
            
            
           //setTimeout(function(){ alert("Hello"); }, 3000);
           
        });
        
        /**Glyph Reference**/
        // https://fontawesome.bootstrapcheatsheets.com/#
        /***/
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
        
        <div id="featured">
            <h2> Featured Products </h2>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div id="centered">
                <div class="carousel-inner" id="formBorder">
                    <div id="added">
                        
                    </div>
                  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
        </div>

    </div>
    </body>
</html>