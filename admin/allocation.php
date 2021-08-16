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
    
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff=mysqli_query($link,"SELECT * FROM staff")
    or die("No hay registros para mostrar ... \n" . mysqli_error($link())); 
?>
<?php
    //get order ids from the orders_details table based on flag=0
    $flag_0 = 0;
    $orders=mysqli_query($link,"SELECT * FROM orders_details WHERE flag='$flag_0'")
    or die("No hay registros para mostrar ... \n" . mysqli_error($link())); 
?>
<?php
    //get reservation ids from the reservations_details table based on flag=0
    $flag_0 = 0;
    $reservations=mysqli_query($link,"SELECT * FROM reservations_details WHERE flag='$flag_0'")
    or die("No hay registros para mostrar ... \n" . mysqli_error($link)); 
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_1=mysqli_query($link,"SELECT * FROM staff")
    or die("No hay registros para mostrar ... \n" . mysqli_error($link));
?>
<?php
    //selecting all records from the staff table. Return an error if there are no records in the tables
    $staff_2=mysqli_query($link,"SELECT * FROM staff")
    or die("No hay registros para mostrar ... \n" . mysqli_error($link));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Staff</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Asignación de personal</h1>
<a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> | <a href="foods.php">Alimentos</a> | 
<a href="accounts.php">Cuentas</a> | <a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | 
<a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | <a href="messages.php">Mensajes</a> | 
<a href="options.php">Opciones</a> | <a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
</div>
<div id="container">
<table border="0" width="600" align="center">
<CAPTION><h3>LISTA DE PERSONAL</h3></CAPTION>
<tr>
<th>ID del personal</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Turno</th>
<th>Dirección</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($staff)){
echo "<tr>";
echo "<td>" . $row['StaffID']."</td>";
echo "<td>" . $row['firstname']."</td>";
echo "<td>" . $row['lastname']."</td>";
echo "<td>" . $row['turn']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo '<td><a href="delete-staff.php?id=' . $row['StaffID'] . '">Quitar personal</a></td>';
echo '<td><a href="staff-exec.php?id=' . $row['StaffID'] . '">Editar personal</a></td>';
echo "</tr>";
}
mysqli_free_result($staff);
mysqli_close($link);
?>
</table>
<hr>
<table align="center">
<tr>
<form id="ordersAllocationForm" name="ordersAllocationForm" method="post" action="orders-allocation.php" onsubmit="return ordersAllocationValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0">
  <CAPTION><h3>ASIGNACIÓN DE PEDIDOS</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Campos obligatorios</td>
	</tr>
    <tr>
      <th width="124">Solicitar ID</th>
      <td width="168"><font color="#FF0000">* </font><select name="orderid" id="orderid">
        <option value="select">- seleccione una opción -
        <?php 
        //loop through orders_details table rows
        while ($row=mysqli_fetch_array($orders)){
        echo "<option value=$row[order_id]>$row[order_id]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <th>ID del personal</th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- seleccione una opción -
        <?php 
        //loop through staff table rows
        while ($row=mysqli_fetch_array($staff_1)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Asignar Personal" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form id="reservationsAllocationForm" name="reservationsAllocationForm" method="post" action="reservations-allocation.php" onsubmit="return reservationsAllocationValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
  <CAPTION><h3>ASIGNACIÓN DE RESERVAS</h3></CAPTION>
	<tr>
		<td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Campos obligatorios</td>
	</tr>
    <tr>
      <th>ID de reserva </th>
      <td><font color="#FF0000">* </font><select name="reservationid" id="reservationid">
        <option value="select">- seleccione una opción -
        <?php 
        //loop through reservations_details table rows
        while ($row=mysqli_fetch_array($reservations)){
        echo "<option value=$row[ReservationID]>$row[ReservationID]"; 
        }
        ?>
        </select></td>
    </tr>
	<tr>
      <th>ID del personal</th>
      <td><font color="#FF0000">* </font><select name="staffid" id="staffid">
        <option value="select">- seleccione una opción -
        <?php 
        //loop through staff table rows
        while ($row=mysqli_fetch_array($staff_2)){
        echo "<option value=$row[StaffID]>$row[StaffID]"; 
        }
        ?>
        </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Asignar personal" /></td>
    </tr>
  </table>
</td>
</form>
</tr>
</table>
<p>&nbsp;</p>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>