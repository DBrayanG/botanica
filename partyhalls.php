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
?>
<?php
    //retrieving all rows from the cart_details table based on flag=0
    $flag_0 = 0;
    $items=mysqli_query($link,"SELECT * FROM cart_details WHERE member_id='$memberId' AND flag='$flag_0'")
    or die("Something is wrong ... \n" . mysqli_error($link)); 
    //get the number of rows
    $num_items = mysqli_num_rows($items);
?>
<?php
    //retrieving all rows from the messages table
    $messages=mysqli_query($link,"SELECT * FROM messages")
    or die("Something is wrong ... \n" . mysqli_error($link)); 
    //get the number of rows
    $num_messages = mysqli_num_rows($messages);
?>
<?php
    //retrieve partyhalls from the partyhalls table
    $partyhalls=mysqli_query($link,"SELECT * FROM partyhalls")
    or die("Something is wrong ... \n" . mysqli_error($link));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Salones de fiesta</title>
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
<h1>RESERVA DE SALA DE FIESTA</h1>
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <a href="member-profile.php">Mi perfil</a> | <a href="cart.php">Carrito[<?php echo $num_items;?>]</a> |  <a href="inbox.php">Bandeja de entrada[<?php echo $num_messages;?>]</a> | <a href="tables.php">Mesas</a> | <a href="partyhalls.php">Salones de fiesta</a> | <a href="ratings.php">Nos califica</a> | <a href="logout.php">Cerrar sesión</a>
<p>&nbsp;</p>
<p>Aquí puedes ... Para más información <a href="contactus.php">Haga clic aquí</a> para Contactarnos.
<hr>
<form name="partyhallForm" id="partyhallForm" method="post" action="reserve-exec.php?id=<?php echo $_SESSION['SESS_MEMBER_ID'];?>" onsubmit="return partyhallValidate(this)">
    <table align="center" width="320">
        <CAPTION><h2>RESERVA UNA SALA DE FIESTA</h2></CAPTION>
        <tr>
            <td><b>Nombre / número del salón de fiestas:</b></td>
            <td>
            <select name="partyhall" id="partyhall">
            <option value="select">- seleccione salón de fiestas -</option>
            <?php 
            //loop through partyhalls table rows
            while ($row=mysqli_fetch_array($partyhalls)){
            echo "<option value=$row[partyhall_id]>$row[partyhall_name]</option>"; 
            }
            ?>
            </select>
            </td>
        </tr>
        <tr>
            <td><b>Fecha:</b></td><td><input type="date" placeholder="yyyy-mm-dd" name="date" id="date" /></td></tr>
        <tr>
            <td><b>Hora:</b></td><td><input type="time" name="time" id="time" />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Reservar"></td>
        </tr>
    </table>
</form>
</div>
</div>
<?php include 'footer.php'; ?>
</div>
</body>
</html>