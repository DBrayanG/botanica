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
	$ReservationID = clean($_POST['reservationid']);
	$StaffID = clean($_POST['staffid']);
	
    //define a default value for flag
    $flag_1 = 1;
 
     // update the entry
     $result = mysqli_query($link,"UPDATE reservations_details SET StaffID='$StaffID', flag='$flag_1' WHERE ReservationID='$ReservationID'")
     or die("La reserva o el personal no existe ... \n" . mysqli_error($link)); 
     
     //check if query executed
     if($result) {
     // redirect back to the allocation page
     header("Location: allocation.php");
     exit();
     }
     else
     // Gives an error
     {
     die("fallo en la asignación de la reserva ..." . mysqli_error($link));
     }
 
?>