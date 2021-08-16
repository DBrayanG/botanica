<?php
    //Start session
    session_start();
    
    //Include database connection details
    require_once('connection/config.php');
    
    //Connect to mysql server
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if(!$link) {
        die('Failed to connect to server: ' . mysqli_error($link()));
    }
    
    //Select database
    $db = mysqli_select_db($link,DB_DATABASE);
    if(!$db) {
        die("Unable to select database");
    }
    
    //Function to sanitize values received from the form. Prevents SQL injection
    function clean($str) {
        $str = @trim($str);
        $opcion=false;
        if($opcion=false) {
            $str = stripslashes($str);
        }
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
        return mysqli_real_escape_string($link,$str);
    }
    
    //setup a directory where images will be saved 
    $target = "../images/"; 
    $target = $target . basename( $_FILES['photo']['name']); 
    
    //Sanitize the POST values
    $name = clean($_POST['name']);
    $description = clean($_POST['description']);
    $price = clean($_POST['price']);
    $start_date = clean($_POST['start_date']);
    $end_date = clean($_POST['end_date']);
    $photo = clean($_FILES['photo']['name']);

    //Create INSERT query
    $qry = "INSERT INTO specials(special_name, special_description, special_price, special_start_date, special_end_date, special_photo) VALUES('$name','$description','$price','$start_date','$end_date','$photo')";
    $result = @mysqli_query($link,$qry);
    
    //Check whether the query was successful or not
    if($result) {
            //Writes the photo to the server 
         $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
         
         if($moved) 
         {      
             //everything is okay
             echo "The photo ". basename( $_FILES['photo']['name']). " se ha cargado, y su información se ha añadido al directorio"; 
         } else {  
             //Gives an error if its not okay 
             echo "Lo siento, ha habido un problema al subir tu foto. "  . $_FILES["photo"]["error"]; 
         }
        header("location: specials.php");
        exit();
    }else {
        die("Consulta fallida " . mysqli_error($link));
    } 
 ?>