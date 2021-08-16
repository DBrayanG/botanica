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
//retrive categories from the categories table
$result=mysqli_query($link,"SELECT * FROM categories")
or die("There are no records to display ... \n" . mysqli_error($link)); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Categorias</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Gestión de categorías</h1>
<a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> | 
<a href="foods.php">Alimentos</a> | <a href="accounts.php">Cuentas</a> | 
<a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | 
<a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | 
<a href="messages.php">Mensajes</a> | <a href="options.php">Opciones</a> | 
<a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
</div>
<div id="container">
<table width="320" align="center">
<CAPTION><h3>AÑADIR UNA NUEVA CATEGORÍA</h3></CAPTION>
<form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
<tr>
    <th>Nombre</th>
    <th>Acción</th>
</tr>
<tr>
    <td><input type="text" name="name" class="textfield" /></td>
    <td><input type="submit" name="Submit" value="Agregar" /></td>
</tr>
</form>
</table>
<hr>
<table width="320" align="center">
<CAPTION><h3>CATEGORIAS DISPONIBLES</h3></CAPTION>
<tr>
<th>nombre de la categoría</th>
<th>Acción</th>
</tr>

<?php
//loop through all table rows
while ($row=mysqli_fetch_array($result)){
echo "<tr>";
echo "<td>" . $row['category_name']."</td>";
echo '<td><a href="delete-category.php?id=' . $row['category_id'] . '">Eliminar Categoria</a></td>';
echo '<td><a href="category-exec.php?id=' . $row['category_id'] . '">Editar Categoria</a></td>';
echo "</tr>";
}
mysqli_free_result($result);
mysqli_close($link);
?>
</table>
<hr>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>