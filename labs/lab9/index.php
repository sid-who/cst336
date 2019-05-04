<?php

 if (!empty($_FILES)) {

    print_r($_FILES);
    
    echo "Image size: " . $_FILES['myFile']['size'];
    
    if($_FILES['file']['size'] > 1048576)
    {
        $error = "File too large, must be smaller than 1MB";
        echo "<script type='text/javascript'>alert(<?php echo $error; ?>);</script>";
        unlink( $_FILES['myfile']['tmp_name']);
        
    }
    else
    {
        move_uploaded_file( $_FILES['myFile']['tmp_name'], "gallery/" . $_FILES['myFile']['name']);
    }
    
    //move_uploaded_file( $_FILES['myFile']['tmp_name'], "gallery/" . $_FILES['myFile']['name']);

}


    function displayImagesUploaded() {

        $images = scandir("gallery"); //returns all file names within a folder
        
        //print_r($images);
        
        for ($i = 2; $i < count($images); $i++) {
            
            echo "<img src='gallery/$images[$i]' width='50' />";
            
        }//for
    
    }//function


?>


<!DOCTYPE html>
<html>
    
    <head>
        <title> Lab 9: File Upload </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            
            img { padding: 10px; }
            
            img:hover { width: 250px; }
            
            #formBorder{
                /*background: #98ffcc;*/
                color: blue;
                
                padding-top: 15px;
                padding-left: 20px;
                padding-right: 20px;
                padding-bottom: 15px;
                border-radius:15px;
            }
            
        </style>
    </head>
    <body>
        
        <br><br><br><br>
        <center>
        <form  method="POST" enctype="multipart/form-data" class="btn btn-warning">
        
            <input type="file" name="myFile" />
            <button class="btn btn-primary"> Upload File! </button>
            
        </form>
        </center>

        <hr>
        <center><h3> Images uploaded: </h3></center>
        
        <center>
        <div id="formBorder" class="btn btn-warning">
            <?= displayImagesUploaded() ?>
        </div>
        </center>
        
        <?php
        
        
        //$conn = dbConnection();
        
        ?>
    </body>
</html>


<!--<!DOCTYPE html>
<html>
    <head>
        <title> File Upload </title>
    </head>
    <body>


        <h1>File Upload </h1>
        
        
        <form method="POST" enctype="multipart/form-data"> 
        
            Select file: <input type="file" name="fileName" /> <br />
            <input type="submit"  name="uploadForm" value="Upload File" /> 
            
        
        </form>

    </body>
</html>-->