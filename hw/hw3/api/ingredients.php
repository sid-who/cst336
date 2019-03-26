<?php
    $addon = array();
    
    $addon["ingredient"] = "strawberries";
    $addon["cost"] = 2;
    
    $extras = array();
    array_push($extras, $addon);
    
    $addon["ingredient"] = "caramel";
    $addon["cost"] = 3;
    
    array_push($extras, $addon);
    
    $addon["ingredient"] = "almonds";
    $addon["cost"] = 4;
    
    array_push($extras, $addon);
    
    $addon["ingredient"] = "radioactive cashews";
    $addon["cost"] = 6;
    
    array_push($extras, $addon);
    
    $addon["ingredient"] = "suspicious raisins";
    $addon["cost"] = 10;
    
    array_push($extras, $addon);
    
    $addon["ingredient"] = "rat poison";
    $addon["cost"] = 7;
    
    array_push($extras, $addon);
    
    echo json_encode($extras);

?>