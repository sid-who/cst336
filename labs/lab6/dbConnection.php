<?php
    function getDatabaseConnection($dbname = 'ottermart'){
        $host = 'localhost';//cloud9
        //$dbname='tcp';
        $username='root';
        $password='';
        
        //checks whether the URL contains "herokuapp" (using Heroku)
        if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
           $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
           $host = $url["host"];
           $dbName = substr($url["path"], 1);
           $username = $url["b199bb5d371253"];
           $password = $url["65892484"];
        }
        
        //creates db connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        
        //display errors when accessing tables
        $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $dbConn;
    }
?>