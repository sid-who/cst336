<?php
    
    $tkey = $_GET['t'];
    $ykey = $_Get['y'];
    $dkey = $_GET['d'];
    
    $curl = curl_init();
      curl_setopt_array($curl, array(
      CURLOPT_URL => "http://www.omdbapi.com/?t=$tkey&y=$ykey&d=$dkey&plot=full&i=tt3896198&apikey=9c8d0509",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
      "cache-control: no-cache"
      ),
   ));
   
    $jsonData = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    
    $data = json_decode($jsonData, true);  //from JSON format to an Array
    
    //print_r($data);
    
    $image = $data[Poster];//0
    $title = $data[Title];//1
    $year = $data[Year];//2
    $rating = $data[Rated];//3
    $release = $data[Released];//4
    $genre = $data[Genre];//5
    $writer = $data[Writer];//6
    $director = $data[Director];//7
    $plot = $data[Plot];//8
    
    /*print_r($image);
    print_r($title);
    print_r($year);
    
    print_r($rating);
    print_r($release);
    print_r($genre);
    
    print_r($writer);
    print_r($director);
    print_r($plot);*/
    
    $results = array($image,$title,$year,$rating,$release,$genre,$writer,$director, $plot);
    
    //print_r("********************\n");
    //print_r($results);
    
    echo json_encode($results);
    
?>