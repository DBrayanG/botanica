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
//selecting all records from almost all tables. Return an error if there are no records in the tables
$result=mysqli_query($link,"SELECT members.member_id, members.firstname, members.lastname, billing_details.Street_Address, billing_details.Mobile_No, orders_details.*, food_details.*, cart_details.*, quantities.* FROM members, billing_details, orders_details, quantities, food_details, cart_details WHERE members.member_id=orders_details.member_id AND billing_details.billing_id=orders_details.billing_id AND orders_details.cart_id=cart_details.cart_id AND cart_details.food_id=food_details.food_id AND cart_details.quantity_id=quantities.quantity_id")
or die("There are no records to display ... \n" . mysqli_error($link)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pedidos</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="page">
<div id="header">
<h1>Gestión de pedidos </h1>
<a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> | <a href="foods.php">Alimentos</a> | <a href="accounts.php">Cuentas</a> | <a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | <a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | <a href="messages.php">Mensajes</a> | <a href="options.php">Opciones</a> | <a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
</div>
<div id="container">
<table border="0" width="970" align="center">
<CAPTION><h3>LISTA DE PEDIDOS</h3></CAPTION>
<tr>
<th>Solicitar ID</th>
<th>Nombres de clientes</th>
<th>Nombre de la comida</th>
<th>Precio de la comida</th>
<th>Cantidad</th>
<th>Coste total</th>
<th>Fecha de entrega</th>
<th>Dirección de entrega</th>
<th>Nº de Celular</th>
<th>Acción</th>
</tr>

<?php
//loop through all tables rows
while ($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>" . $row['order_id']."</td>";
echo "<td>" . $row['firstname']."\t".$row['lastname']."</td>";
echo "<td>" . $row['food_name']."</td>";
echo "<td>" . $row['food_price']."</td>";
echo "<td>" . $row['quantity_value']."</td>";
echo "<td>" . $row['total']."</td>";
echo "<td>" . $row['delivery_date']."</td>";
echo "<td>" . $row['Street_Address']."</td>";
echo "<td>" . $row['Mobile_No']."</td>";
echo '<td><a href="delete-order.php?id=' . $row['order_id'] . '">Eliminar Perdido</a></td>';
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