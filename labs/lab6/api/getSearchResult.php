<?php
    
    include '../dbConnection.php';
    $conn = getDatabaseConnection("ottermart");
    
    $product = $_GET['productKeyword'];
    $description = $_GET['description'];
    $prodcat = $_GET['productCategory'];
    
    $namedParameters = array();
    $sql = "SELECT * FROM om_product WHERE 1";
    
    //check whether user has typed something in the "product" text box
    
    //$sql = "SELECT * FROM `om_product` WHERE 1"; //Retrieves ALL records
    
    //check the product text box
    if (!empty($product)) { //user entered a product keyword
        $sql .=  " AND productName LIKE :product";
        $namedParameters[":product"] = "%$product%";
    }
    
    if (!empty($description)) { //user entered a product keyword
    $sql .=  " AND productDescription LIKE :description";
    $namedParameters[":description"] = "%$description%";
    }
    
    
    //check whether the category has been selected
    if(!empty($GET['productCategory'])) {
        
        /*if($prodcat == 1)
        {
            $sql .= " AND catId = :'1'";
        }
        else if($prodcat == 2)
        {
            $sql .= " AND catId = '2'";
        }
        else if($prodcat == 3)
        {
            $sql .= " AND catId = '3'";
        }
        else if($prodcat == 4)
        {
            $sql .= " AND catId = '4'";
        }
        else if($prodcat == 5)
        {
            $sql .= " AND catId = '5'";
        }
        else if($prodcat == 6)
        {
            $sql .= " AND catId = '6'";
        }*/
        $sql .= " AND catId = :categoryId";
        $namedParameters[":categoryId"] = $_GET['productCategory'];
    }
   
    if(!empty($_GET['priceFrom'])){
        $sql .= " AND price >= :priceFrom";
        $namedParameters[":priceFrom"] = $_GET['priceFrom'];
    }
    
    if(!empty($_GET['priceTo'])){
        $sql .= " AND price <= :priceTo";
        $namedParameters[":priceTo"] = $_GET['priceTo'];
    }
    
    if(isset($_GET['orderBy'])){
        if($_GET['orderBy'] == "price"){
            $sql .= " ORDER BY price";
        }
        else if($_GET['orderBy'] == "name"){
            $sql .= " ORDER BY productName";
        }
    }
    
    $stmt = $conn -> prepare($sql);  //$connection MUST be previously initialized
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); //use fetch for one record, fetchAll for multiple
    
    //print_r($records); //debugging    
    
    echo json_encode($records);


?>
