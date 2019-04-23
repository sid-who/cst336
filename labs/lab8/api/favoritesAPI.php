<?php

//receives these parameters: action, url, keyword

//TO GET THE 2 EXTRA POINTS IN THE HANDS-ON PORTION OF THE FINAL EXAM
//1. Add favorites to database
//2. Remove favorites from database
//3. Display the keyword list from database (use DISTINCT)

  include '../../../inc/dbConnection.php';
  $conn = getDatabaseConnection("pixabayFavorites");
  
  $arr = array();

  switch (action) {
      
      case "add":
        $arr[":url"] = $_GET["url"];
        $arr[":keyword"] = $_GET["keyword"];
        
        $sql = "INSERT INTO fave ( `url`, `keyword`) VALUES (:url, :keyword)";
                 break;
                 

      case "delete":
        $arr[":url"] = $_GET["url"];
        
        $sql = "DELETE FROM `fave` WHERE `fave`.`url` = :url";
        
                 break;
                 
      
  }//switch
  
        $stmt = $conn->prepare($sql);
        $stmt->execute($arr);
        $sql ="SELECT COUNT(1) totalproducts FROM fave";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($records);

?>