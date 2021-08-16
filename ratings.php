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
//get member id from session
$memberId=$_SESSION['SESS_MEMBER_ID']; 

//selecting all records from the food_details table. Return an error if there are no records in the table
$foods=mysqli_query($link,"SELECT * FROM food_details")
or die("Se ha producido un problema ... \n" . "Nuestro equipo está trabajando en ello en este momento ... \n" . "Por favor, vuelva a comprobarlo después de unos minutos."); 

//selecting all records from the ratings table. Return an error if there are no records in the table
$ratings=mysqli_query($link,"SELECT * FROM ratings")
or die("Se ha producido un problema ... \n" . "Nuestro equipo está trabajando en ello en este momento ... \n" . "Por favor, vuelva a comprobarlo después de unos minutos."); 
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($link,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Algo está mal ... \n" . mysqli_error($link)); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($link,"SELECT * FROM messages")
    or die("Algo está mal  ... \n" . mysqli_error($link)); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Clasificación</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="page">
  <div id="menu"><ul>
  <li><a href="member-index.php">Inicio</a></li>
  <li><a href="foodzone.php">Menu</a></li>
  <li><a href="specialdeals.php">Ofertas Especiales</a></li>
  <li><a href="member-index.php">Mi Cuenta</a></li>
  <li><a href="contactus.php">Contactanos</a></li>
  </ul>
  </div>
<div id="header">
  <div id="logo"> <a href="index.php" class="blockLink"></a></div>
  <div id="company_name"><?php echo APP_NAME ?> Restaurante</div>
</div>
<div id="center">
<h1>TARIFA</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <a href="member-profile.php">Mi perfil</a> | <a href="cart.php">Carrito[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Bandeja de entrada[<?php echo $num_messages;?>]</a> | <a href="tables.php">Mesas</a> | <a href="partyhalls.php">Salones de fiesta</a> | <a href="ratings.php">Nos califica</a> | <a href="logout.php">Cerrar sesión</a>
<p>&nbsp;</p>
<p>Aquí puede... Para más información <a href="contactus.php">Haga clic aquí</a> para Contactarnos.
<hr>
<form name="ratingForm" id="ratingForm" method="post" action="ratings-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return ratingValidate(this)" style="text-align:center;">
    <table align="center" width="300">
        <CAPTION><h2>CALIFIQUE NUESTROS ALIMENTOS</h2></CAPTION>
            <tr>
                <td>Alimentos</td>
                <td><select name="food" id="food">
                <option value="select">- seleccione los alimentos -
                <?php 
                //loop through food_details table rows
                while ($row=mysqli_fetch_array($foods)){
                echo "<option value=$row[food_id]>$row[food_name]"; 
                }
                ?>
                </select></td>
            <tr>
                <td>Escala</td>
                <td><select name="scale" id="scale">
                <option value="select">- seleccione la escala -
                <?php 
                //loop through ratings table rows
                while ($row=mysqli_fetch_array($ratings)){
                echo "<option value=$row[rate_id]>$row[rate_name]"; 
                }
                ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="Submit" value="Califique" /></td>
            </td>
    </table>
</form>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>