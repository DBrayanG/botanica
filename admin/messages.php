<?php
	require_once('auth.php');
?>
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
//selecting all records from the messages table. Return an error if there is a problem
$result=mysqli_query($link,"SELECT * FROM messages")
or die("There are no records to display ... \n" . mysqli_error($link)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Mensajes</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Gestión de mensajes </h1>
<a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> | <a href="foods.php">Alimentos</a> | <a href="accounts.php">Cuentas</a> | <a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | <a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | <a href="messages.php">Mensajes</a> | <a href="options.php">Opciones</a> | <a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
</div>
<div id="container">
<form id="messageForm" name="messageForm" method="post" action="message-exec.php" onsubmit="return messageValidate(this)">
  <table width="540" border="0" cellpadding="2" cellspacing="0" align="center">
  <CAPTION><h3>ENVIAR UN MENSAJE</h3></CAPTION>
    <tr>
      <th width="200">Sujeto</th>
      <td width="168"><input type="text" name="subject" id="subject" class="textfield" /></td>
    </tr>
    <tr>
      <th width="200">Buzon de mensaje</th>
      <td width="168"><textarea name="txtmessage" class="textfield" rows="5" cols="60"></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><input type="submit" name="Submit" value="Enviar Mensaje" />
	  <input type="reset" name="Reset" value="Borrar Campos" /></td>
    </tr>
  </table>
</form>
<hr>
<table border="0" width="1000" align="center">
<CAPTION><h3>MENSAJES ENVIADOS</h3></CAPTION>
<tr>
<th>ID de mensaje</th>
<th>Fecha de envío</th>
<th>Hora de enviado</th>
<th>Asunto del mensaje</th>
<th>Mensaje de texto</th>
<th>Acción</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['message_id']."</td>";
echo "<td>" . $row['message_date']."</td>";
echo "<td>" . $row['message_time']."</td>";
echo "<td>" . $row['message_subject']."</td>";
echo "<td width='300' align='left'>" . $row['message_text']."</td>";
echo '<td><a href="delete-message.php?id=' . $row['message_id'] . '">Eliminar Mensaje</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($link);
?>
</table>
<hr>
</div>
<?php
  include 'footer.php';
?>
</div>
</body>
</html>