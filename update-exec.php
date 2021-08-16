<?php
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
		$opcion=false;
		if($opcion==false) {
			$str = stripslashes($str);
		}
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
		return mysqli_real_escape_string($link,$str);
	}
	
	//Sanitize the POST values
	$OldPassword = clean($_POST['opassword']);
	$NewPassword = clean($_POST['npassword']);
	$ConfirmNewPassword = clean($_POST['cpassword']);
	
     // check if the 'id' variable is set in URL
     if (isset($_GET['id']))
     {
         // get id value
         $id = $_GET['id'];
         
         // update the entry
         $result = mysqli_query($link,"UPDATE members SET passwd='".md5($_POST['npassword'])."' WHERE member_id='$id' AND passwd='".md5($_POST['opassword'])."'")
         or die("No se ha podido cambiar la contraseña. Por favor, inténtelo de nuevo después de unos minutos"); 
         
         if($result){
             // redirect back to the member profile
             header("Location: member-profile.php");
         }
         else{
            header("Location: reset-failed.php"); // failed to update password
         }
     }
     else
     // if id isn't set, give an error
     {
        die("No se ha podido cambiar la contraseña. Por favor, inténtelo de nuevo después de unos minutos");
     } 
?>