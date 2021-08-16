<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Desconectado</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="index.php">Inicio</a></li>
  <li><a href="foodzone.php">Menu</a></li>
  <li><a href="specialdeals.php">Ofertas Especiales</a></li>
  <li><a href="member-index.php">Mi Cuenta</a></li>
  <li><a href="contactus.php">Contactanos</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name">Food Plaza Restaurante</div>
</div>
<div id="center">
<h1>DESCONECTADO </h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
<p>&nbsp;</p>
<div class="error">Usted ha sido desconectado.</div>
<p><a href="login-register.php">Haga clic aquí</a> para iniciar sesión nuevamente</p>
</div>
</div>
<div id="footer">
    <div class="bottom_menu"><a href="index.php">Inicio Pagina</a>  |  <a href="aboutus.php">Acerca de nosotros </a>  |  <a href="specialdeals.php">Ofertas Especiales</a>  |  <a href="foodzone.php">Menu</a>  |<br>
  | <a href="admin/index.php" target="_blank">Administrador</a> |</div>
  
  <?php include 'footer.php'; ?>
</div>
</div>
</body>
</html>
