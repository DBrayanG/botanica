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
//selecting all records from the reservations_details table based on table ids. Return an error if there are no records in the table
$tables=mysqli_query($link,"SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.table_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, tables.table_id, tables.table_name FROM members, reservations_details, tables WHERE members.member_id = reservations_details.member_id AND tables.table_id=reservations_details.table_id")
or die("There are no records to display ... \n" . mysqli_error($link)); 

//selecting all records from the reservations_details table based on partyhall ids. Return an error if there are no records in the table
$partyhalls=mysqli_query($link,"SELECT members.firstname, members.lastname, reservations_details.ReservationID, reservations_details.partyhall_id, reservations_details.Reserve_Date, reservations_details.Reserve_Time, partyhalls.partyhall_id, partyhalls.partyhall_name FROM members, reservations_details, partyhalls WHERE members.member_id = reservations_details.member_id AND partyhalls.partyhall_id=reservations_details.partyhall_id")
or die("There are no records to display ... \n" . mysqli_error($link)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reservaciones</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Gestión de reservas </h1>
<a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> | <a href="foods.php">Alimentos</a> | <a href="accounts.php">Cuentas</a> | <a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | <a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | <a href="messages.php">Mensajes</a> | <a href="options.php">Opciones</a> | <a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
</div>
<div id="container">
<table border="0" width="900" align="center">
<CAPTION><h3>MESAS RESERVADAS</h3></CAPTION>
<tr>
<th>ID de reserva</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Nombre de la Mesa</th>
<th>Fecha reservada</th>
<th>Hora reservada</th>
<th>Acción</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($tables)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['table_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Eliminar Reserva</a></td>';
echo "</tr>";
}
mysqli_free_result($tables);
//mysql_close($link);
?>
</table>
<hr>
<table border="0" width="900" align="center">
<CAPTION><h3>SALAS DE FIESTA RESERVADAS</h3></CAPTION>
<tr>
<th>ID de reserva</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Nombre del salón de fiestas</th>
<th>Fecha reservada</th>
<th>Hora reservada</th>
<th>Acción</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($partyhalls)){
echo "<tr>";
echo "<td>" . $row['ReservationID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['partyhall_name']."</td>";
echo "<td>" . $row['Reserve_Date']."</td>";
echo "<td>" . $row['Reserve_Time']."</td>";
echo '<td><a href="delete-reservation.php?id=' . $row['ReservationID'] . '">Eliminar Reserva</a></td>';
echo "</tr>";
}
mysqli_free_result($partyhalls);
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