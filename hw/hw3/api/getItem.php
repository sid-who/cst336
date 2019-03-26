<?php
    $ice = array();
    
    $ice["specialty"] = "Super Sundae Surprise";
    $ice["cost"] = 4;
    
    $specialties = array();
    
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Roasted Strawberry Sundae";
    $ice["cost"] = 4;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Banana Bread Sundae";
    $ice["cost"] = 7;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Sundae Cupcakes";
    $ice["cost"] = 3;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Raspberry Rose Caramel Sundae";
    $ice["cost"] = 12;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Chocolate Waffle Sundae";
    $ice["cost"] = 6;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Salted Caramel Sundae with Cinnamon Almonds";
    $ice["cost"] = 9;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Potato Chip Sundae";
    $ice["cost"] = 7;
    array_push($specialties, $ice);
    
    $ice["specialty"] = "Peppermint Bark Sundae";
    $ice["cost"] = 8;
    array_push($specialties, $ice);
    
    echo json_encode($specialties)

?>