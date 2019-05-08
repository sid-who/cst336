<?php

include '../../inc/dbConnection.php';
    
$conn = getDatabaseConnection("junkyard");

$keyword = $_GET['keyword'];
$catId = $_GET['catId'];

$sort = $_GET['sort'];
$order = $_GET['order'];

//echo json_encode($sort);


 
// both search criteria from user
if ($keyword && $catId) {
  $sql = "SELECT * FROM `jy_product` WHERE (categoryNum = $catId) AND (productName LIKE '%$keyword%') ORDER BY $sort $order";
}

// only the category is selected
elseif (!$keyword && $catId) {
   $sql = "SELECT * FROM `jy_product` WHERE categoryNum = $catId ORDER BY $sort $order";
}

// only a keyword is given, no category 
elseif ($keyword && !$catId) {
   $sql = "SELECT * FROM `jy_product` WHERE (productName LIKE '%$keyword%') OR (productDescription LIKE '%$keyword%') ORDER BY $sort $order";

}

// neither category nor keyword given
else {
   $sql = "SELECT * FROM `jy_product` WHERE 1 ORDER BY $sort $order";
}

$stmt = $conn->prepare($sql);
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($records)) {
    echo "No search results found";
}

else {
    echo json_encode($records);
}

?>