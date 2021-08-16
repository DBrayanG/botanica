<?php
	require_once('connection/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Failed</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Error de inicio de sesion</h1>
<p align="center">&nbsp;</p>
</div>
<h4 align="center" class="err">¡Error de inicio de sesion!</h4>
<p align="center">Comprueba tu nombre de usuario y contraseña e <a href="login-form.php">inténtalo de nuevo.</a></p>
<?php include 'footer.php'; ?>
</div>
</body>
</html>
