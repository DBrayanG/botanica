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
		
	//checks whether submit is set
	if(isset($_POST['Submit']))
	{
	    $member_id = $_SESSION['SESS_MEMBER_ID']; //gets member id from session
        $food_id = clean($_POST['food']); //gets food id and sanitizes post value
        $scale_id = clean($_POST['scale']); //gets scale id and sanitizes post value
        
        //check whether there is duplication in the polls_details table
        $check = mysqli_query($link,"SELECT * FROM polls_details WHERE member_id='$member_id' AND food_id='$food_id'") or die("Algo no funciona.\n Nuestro equipo está trabajando en ello en este momento.\n Por favor, inténtelo de nuevo después de unos minutos.");
        
        if(mysqli_num_rows($check)>0){
            header("location: ratings-failed.php");
        }
        else{
	        //Create INSERT query
	        $qry = "INSERT INTO polls_details(member_id,food_id,rate_id) VALUES('$member_id','$food_id','$scale_id')";
	        mysqli_query($link,$qry);
	        
            if($qry){
	            header("location: ratings-success.php");
            }
            else{
                die("La valoración ha fallado. Por favor, inténtelo de nuevo después de unos minutos.");
            }
        }

	}else {
		die("La valoración ha fallado. Por favor, inténtelo de nuevo después de unos minutos.");
	}
?>