<?php
    //Start session
    session_start();
    
    //checking connection and connecting to a database
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
        $opcion = false;
        if($opcion==false) {
            $str = stripslashes($str);
        }
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
        return mysqli_real_escape_string($link,$str);
    }
    
    // check if Delete is set in POST
     if (isset($_POST['Delete'])){
         // get id value of category and Sanitize the POST values
         $category_id = clean($_POST['category']);
         
         // delete the entry
         $result = mysqli_query($link,"DELETE FROM categories WHERE category_id='$category_id'")
         or die("Hubo un problema al borrar la categoría ... \n" . mysqli_error($link)); 
         
         // redirect back to options
         header("Location: options.php");
     }
     
         else
            // if id isn't set, redirect back to options
         {
            header("Location: options.php");
         }
     
 
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // delete the entry
         $result = mysqli_query($link,"DELETE FROM categories WHERE category_id='$id'")
         or die("Hubo un problema al borrar la categoría ... \n" . mysqli_error($link)); 
         
         // redirect back to the categories
         header("Location: categories.php");
     }
     else
        // if id isn't set, redirect back to the categories
     {
        header("Location: categories.php");
     }
 
?>