<?php
//Start session
session_start();
    
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
?>
<?php
    if(isset($_POST['Submit'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            $opcion=false;
            if($opcion==false) {
                $str = stripslashes($str);
            }
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
            return mysqli_real_escape_string($link,$str);
        }
        //get email
        $email = clean($_POST['email']);
        
        //selecting a specific record from the members table. Return an error if there are no records in the table
        $result=mysqli_query($link,"SELECT * FROM members WHERE login='$email'")
        or die("Ha ocurrido un problema ... \ n "." Nuestro equipo está trabajando en ello en este momento ... \ n "." Vuelva a consultar después de unos minutos."); 
    }
?>
<?php
    if(isset($_POST['Change'])){
        //Function to sanitize values received from the form. Prevents SQL injection
        function clean($str) {
            $str = @trim($str);
            $opcion=false;
            if($opcion==false) {
                $str = stripslashes($str);
            }
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
            return mysqli_real_escape_string($link,$str);
        }
        if(trim($_SESSION['member_id']) != ''){
            $member_id=$_SESSION['member_id']; //gets member id from session
            //get answer and new password from form
            $answer = clean($_POST['answer']);
            $new_password = clean($_POST['new_password']);
            
         // update the entry
         $result = mysqli_query($link,"UPDATE members SET passwd='".md5($_POST['new_password'])."' WHERE member_id='$member_id' AND answer='".md5($_POST['answer'])."'")
         or die("Ha ocurrido un problema ... \ n "." Nuestro equipo está trabajando en ello en este momento ... \ n "." Vuelva a consultar después de unos minutos. \n");  
         
         if($result){
                unset($_SESSION['member_id']);
                header("Location: reset-success.php"); //redirect to reset success page         
         }
         else{
                unset($_SESSION['member_id']);
                header("Location: reset-failed.php"); //redirect to reset failed page
         }
            }
            else{
                unset($_SESSION['member_id']);
                header("Location: reset-failed.php"); //redirect to reset failed page
            }
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo APP_NAME ?>:Restablecer de contraseña</title>
<link href="stylesheets/user_styles.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" src="validation/user.js">
</script>
</head>
<body>
<div id="reset">
  <div style="border:#bd6f2f solid 1px;padding:4px 6px 2px 6px">
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <th>Cuenta de email</th>
        <td width="168"><input name="email" type="text" class="textfield" id="email" /></td>
        <td><input type="submit" name="Submit" value="verificar" /></td>
     </tr>
     </table>
 </form>
  <?php
    if(isset($_POST['Submit'])){
        $row=mysqli_fetch_assoc($result);
        $_SESSION['member_id']=$row['member_id']; //creates a member id session
        session_write_close(); //closes session
        $question_id=$row['question_id'];
        
        //get question text based on question_id
        $question=mysqli_query($link,"SELECT * FROM questions WHERE question_id='$question_id'")
        or die("Ha ocurrido un problema ... \ n "." Nuestro equipo está trabajando en ello en este momento ... \ n "." Vuelva a consultar después de unos minutos.");
        
        $question_row=mysqli_fetch_assoc($question);
        $question=$question_row['question_text'];
        if($question!=""){
            echo "<b>Tu ID:</b> ".$_SESSION['member_id']."<br>";
            echo "<b>Tu pregunta de seguridad:</b> ".$question;
        }
        else{
            echo "<b>Tu pregunta de seguridad:</b> ¡ESTA CUENTA NO EXISTE! POR FAVOR, COMPRUEBE SU CORREO ELECTRÓNICO Y VUELVA A INTENTARLO.";
        }
    }
  ?>
  <hr>
  <form name="passwordResetForm" id="passwordResetForm" method="post" action="password-reset.php" onsubmit="return passwordResetValidate_2(this)">
     <table width="360" style="text-align:center;">
     <tr>
        <td colspan="2" style="text-align:center;"><font color="#FF0000">* </font>Campos requeridos</td>
     </tr>
     <tr>
        <th>Tu respuesta de seguridad</th>
        <td width="168"><font color="#FF0000">* </font><input name="answer" type="text" class="textfield" id="answer" /></td>
     </tr>
     <tr>
        <th>Nueva contraseña</th>
        <td width="168"><font color="#FF0000">* </font><input name="new_password" type="password" class="textfield" id="new_password" /></td>
     </tr>
     <tr>
        <th>Confirmar nueva contraseña</th>
        <td width="168"><font color="#FF0000">* </font><input name="confirm_new_password" type="password" class="textfield" id="confirm_new_password" /></td>
     </tr>
     <tr>
        <td colspan="2"><input type="reset" name="Reset" value="Borrar campos" /><input type="submit" name="Change" value="Cambiar la contraseña" /></td>
     </tr>
     </table>
 </form>
  </div>
  </div>
</body>
</html>