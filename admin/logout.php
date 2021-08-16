<?php
require_once('connection/config.php');
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_ADMIN_ID']);
	unset($_SESSION['SESS_ADMIN_NAME']);
	
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
	$id = session_id();
	$fecha=date("Y-m-d");
    $hora=date("H:i:s");
	$query1 = "SELECT Admin_ID from register ";
	mysqli_query($link,$query1);
	

	$query = "UPDATE register set Fecha_salida='$fecha' and Hora_salida = '$hora' where Admin_ID=''";
	mysqli_query($link,$query);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cerrar sesión</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Cerrar sesión </h1>
<p align="center">&nbsp;</p>
</div>
<h4 align="center" class="err">Usted ha sido desconectado.</h4>
<p align="center"><a href="login-form.php">Haga clic aquí</a> para iniciar sesión</p>
<div id="footer">
<div class="bottom_addr">&copy; <?php echo date('Y'); ?> Restaurante Botánica. Reservados todos los derechos</div>
</div>
</div>
</body>
</html>
