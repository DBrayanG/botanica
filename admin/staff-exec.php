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
		if($opcion==false) {
			$str = stripslashes($str);
		}
		$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
		return mysqli_real_escape_string($link,$str);
	}
	
	//Sanitize the POST values
	$FirstName = clean($_POST['fName']);
	$LastName = clean($_POST['lName']);	
	$StreetAddress = clean($_POST['sAddress']);
	$MobileNo = clean($_POST['mobile']);
	$Turn = clean($_POST['turn']);
	

	//Create INSERT query
	$qry = "INSERT INTO staff(firstname,lastname,Street_Address,Mobile_Tel,turn) VALUES('$FirstName','$LastName','$StreetAddress','$MobileNo','$Turn')";
	$result = @mysqli_query($link,$qry);
	$action="profile.php";
	//Check whether the query was successful or not
	if($result) {
		echo "<html><script language='JavaScript'>alert('Información sobre el personal añadida con éxito.')</script></html>";
		header("location: allocation.php");
		exit();
		
		
	}else {
		die("Fallo en la adición de información sobre el personal ... " . mysqli_error($link));
	}
	
?>