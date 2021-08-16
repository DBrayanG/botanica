<?php require_once('connection/config.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo APP_NAME; ?>:Contactanos</title>
<script type="text/javascript" src="swf/swfobject.js"></script>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css">
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
  <div id="company_name"><?php echo APP_NAME; ?> Restaurante</div>
</div>
<div id="center">

  <h1>Contactanos</h1>
  
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <table width="500" height="50">
  <tr><td rowspan="11"><img width="500" height="400" src="images/ubicacion.png" /></td></tr>
  <tr><td rowspan="11"></td></tr>
  <tr><td><?php echo APP_NAME ?> Restaurante</td></tr>
  
  <tr><td>Av. San Martin esquina Calle Dr. Marcos Terrazas Santa Cruz de la Sierra, Bolivia</td></tr>  
  <tr><td>Celular: 77313999</td></tr>
  <tr><td>Correo: labotanicascz@gmail.com</td></tr>
  </table>
  </div>
</div>
<?php include 'footer.php'; ?>
</div>

</body>
</html>
