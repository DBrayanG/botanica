<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('connection/config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
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
	$login = clean($_POST['login']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Username missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: login-form.php");
		exit();
	}

	
	//Create query
	$qry="SELECT * FROM pizza_admin WHERE Username='$login' AND Password='$password'";
	$result=mysqli_query($link,$qry);
	$user1="admin";
	$user2="brayan";
	$user3="raul";
	$id1 = 3;
	$id2 = 4;
	$id3 = 5;
	$count = 3;
	$i=0;
	//Check whether the query was successful or not
	
	while($count >=$i){
		if($login==$user1){
			$id=$id1;
			$i=4;
		}else{
			if($login==$user2){
				$id=$id2;
				$i=4;
			}else{
				if($login==$user3){
					$id=$id3;
					$i=4;
				}
			}
		}
		
	}	
	
	if($result) {
		if(mysqli_num_rows($result) == 1) {
			//Login Successful
			$fecha=date("Y-m-d");
    		$hora=date("H:i:s");
    		
			session_regenerate_id();
			$member = mysqli_fetch_assoc($result);
			//$member1=mysqli_fetch_assoc($result1);
			
			$_SESSION['SESS_ADMIN_ID'] = $member['Admin_ID'];
			$_SESSION['SESS_ADMIN_NAME'] = $member['Username'];
			//$user;
			$qry1 = "INSERT INTO register(Admin_ID,Fecha_entrada,Hora_entrada,Fecha_salida,Hora_salida) VALUES('$id','$fecha','$hora','','')";
			mysqli_query($link,$qry1);
			session_write_close();
			header("location: index.php");
			exit();
		}else {
			//Login failed
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Consulta fallida");
	}	
	
	
?>