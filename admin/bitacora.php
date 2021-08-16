<?php
    require_once('auth.php');
?>
<?php
//checking connection and connecting to a database
include_once 'connection/config.php';
//$objeto = new conexion();
//$conexion = $objeto->conectar();
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

    $consult =mysqli_query($link, "SELECT id,Admin_ID,Fecha_entrada, Hora_entrada, Fecha_salida, Hora_salida from register");
   ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bitacora</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
    <div id="page">
       <div id="header">
       <h1>Bitacora </h1>
        <a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> | <a href="foods.php">Alimentos</a> | <a href="accounts.php">Cuentas</a> | <a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | <a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | <a href="messages.php">Mensajes</a> | <a href="options.php">Opciones</a> | <a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
       </div> 
       <hr>
<table width="950" align="center">
<CAPTION><h3>Bitacora</h3></CAPTION>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Fecha de ingreso</th>
<th>Hora de ingreso</th>
<th>Fecha de salida</th>
<th>Hora de salida</th>
</tr>
    </div>
   <?php
    while ($row = mysqli_fetch_array($consult)){
        echo "<tr>";
        echo "<td>". $row['id']."</td>";
        echo "<td>". $row['Admin_ID']."</td>";
        echo "<td>". $row['Fecha_entrada']."</td>";
        echo "<td>". $row['Hora_entrada']."</td>";
        echo "<td>". $row['Fecha_salida']."</td>";
        echo "<td>". $row['Hora_salida']."</td>";
        echo "</tr>";
    }
    mysqli_free_result($consult);
    mysqli_close($link);
   ?>

</body>