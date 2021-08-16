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
$categories=mysqli_query($link,"SELECT * FROM categories")
or die("There are no records to display ... \n" . mysqli_error($link)); 

//retrieve quantities from the quantities table
$quantities=mysqli_query($link,"SELECT * FROM quantities")
or die("Something is wrong ... \n" . mysqli_error($link)); 

//retrieve currencies from the currencies table (deleting)
$currencies=mysqli_query($link,"SELECT * FROM currencies")
or die("Something is wrong ... \n" . mysqli_error($link)); 

//retrieve currencies from the currencies table (updating)
$currencies_1=mysqli_query($link,"SELECT * FROM currencies")
or die("Something is wrong ... \n" . mysqli_error($link)); 

//retrieve polls from the ratings table
$ratings=mysqli_query($link,"SELECT * FROM ratings")
or die("Something is wrong ... \n" . mysqli_error($link));

//retrieve timezones from the timezones table (deleting)
$timezones=mysqli_query($link,"SELECT * FROM timezones")
or die("Something is wrong ... \n" . mysqli_error($link)); 

//retrieve timezones from the timezones table (updating)
$timezones_1=mysqli_query($link,"SELECT * FROM timezones")
or die("Something is wrong ... \n" . mysqli_error($link));  

//retrieve tables from the tables table
$tables=mysqli_query($link,"SELECT * FROM tables")
or die("Something is wrong ... \n" . mysqli_error($link));

//retrieve partyhalls from the partyhalls table
$partyhalls=mysqli_query($link,"SELECT * FROM partyhalls")
or die("Something is wrong ... \n" . mysqli_error($link));

//retrieve questions from the questions table
$questions=mysqli_query($link,"SELECT * FROM questions")
or die("Something is wrong ... \n" . mysqli_error($link));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Opciones</title>
<link href="stylesheets/admin_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/admin.js">
</script>
</head>
<body>
<div id="page">
<div id="header">
<h1>Opciones </h1>
<a href="index.php">Inicio</a> | <a href="categories.php">Categorías</a> |
 <a href="foods.php">Alimentos</a> | <a href="accounts.php">Cuentas</a> | 
 <a href="orders.php">Pedidos</a> | <a href="reservations.php">Reservas</a> | 
 <a href="specials.php">Especiales</a> | <a href="allocation.php">Personal</a> | 
 <a href="messages.php">Mensajes</a> | <a href="options.php">Opciones</a> | 
 <a href="bitacora.php">Bitacora</a> | <a href="logout.php">Cerrar sesión</a>
</div>
<div id="container">
<table align="center" width="910">
<CAPTION><h3>GESTIONAR CATEGORÍAS</h3></CAPTION>
<tr>
<form name="categoryForm" id="categoryForm" action="categories-exec.php" method="post" onsubmit="return categoriesValidate(this)">
<td>
  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Categoría</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Agregar" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="categoryForm" id="categoryForm" action="delete-category.php" method="post" onsubmit="return categoriesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Categoría</td>
        <td><select name="category" id="category">
        <option value="select">- selecciona una categoría -
        <?php 
        //loop through categories table rows
        while ($row=mysqli_fetch_array($categories)){
        echo "<option value=$row[category_id]>$row[category_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Eliminar" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>GESTIONAR CANTIDADES</h3></CAPTION>
<tr>
<form name="quantityForm" id="quantityForm" action="quantities-exec.php" method="post" onsubmit="return quantitiesValidate(this)">
<td>
  <table width="250" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Cantidad</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Agregar" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="quantityForm" id="quantityForm" action="delete-quantity.php" method="post" onsubmit="return quantitiesValidate(this)">
  <table width="250" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Cantidad</td>
        <td><select name="quantity" id="quantity">
        <option value="select">- seleccione una Cantidad -
        <?php 
        //loop through quantities table rows
        while ($row=mysqli_fetch_array($quantities)){
        echo "<option value=$row[quantity_id]>$row[quantity_value]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Elminar" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>

<hr>
<table align="center" width="910">
<CAPTION><h3>ADMINISTRAR MESAS</h3></CAPTION>
<tr>
<form name="tableForm" id="tableForm" action="tables-exec.php" method="post" onsubmit="return tablesValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Nombre / número de mesa</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Agregar" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="tableForm" id="tableForm" action="delete-table.php" method="post" onsubmit="return tablesValidate(this)">
  <table width="350" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Nombre / número de mesa</td>
        <td><select name="table" id="table">
        <option value="select">- seleccionar mesa -
        <?php 
        //loop through tables table rows
        while ($row=mysqli_fetch_array($tables)){
        echo "<option value=$row[table_id]>$row[table_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Eliminar" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>GESTIONAR SALAS DE FIESTA</h3></CAPTION>
<tr>
<form name="partyhallForm" id="partyhallForm" action="partyhalls-exec.php" method="post" onsubmit="return partyhallsValidate(this)">
<td>
  <table width="350" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Nombre de Salón de Fiestas / Número</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Agregar" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="partyhallForm" id="partyhallForm" action="delete-partyhall.php" method="post" onsubmit="return partyhallsValidate(this)">
  <table width="370" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Nombre de Salón de Fiestas / Número</td>
        <td><select name="partyhall" id="partyhall">
        <option value="select">- seleccionar salón de fiesta -
        <?php 
        //loop through partyhalls table rows
        while ($row=mysqli_fetch_array($partyhalls)){
        echo "<option value=$row[partyhall_id]>$row[partyhall_name]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Eliminar" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
<table align="center" width="910">
<CAPTION><h3>ADMINISTRAR PREGUNTAS</h3></CAPTION>
<tr>
<form name="questionForm" id="questionForm" action="questions-exec.php" method="post" onsubmit="return questionsValidate(this)">
<td>
  <table width="300" border="0" cellpadding="2" cellspacing="0" align="center">
    <tr>
        <td>Pregunta</td>
        <td><input type="text" name="name" class="textfield" /></td>
        <td><input type="submit" name="Insert" value="Agregar" /></td>
    </tr>
  </table>
</td>
</form>
<td>
<form name="questionForm" id="questionForm" action="delete-question.php" method="post" onsubmit="return questionsValidate(this)">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
        <td>Pregunta</td>
        <td><select name="question" id="question">
        <option value="select">- seleccionar pregunta -
        <?php 
        //loop through quantities table rows
        while ($row=mysqli_fetch_array($questions)){
        echo "<option value=$row[question_id]>$row[question_text]"; 
        }
        ?>
        </select></td>
        <td><input type="submit" name="Delete" value="Eliminar" /></td>
    </tr>
  </table>
</form>
</td>
</tr>
</table>
<p>&nbsp;</p>
<hr>
</div>
<?php
    include 'footer.php';
?>
</div>
</body>
</html>
