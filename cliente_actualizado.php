<?php 
session_start();
/**
 * Expecificacion: Fichero donde indica si se ha actualizado con exito una modificacion de los datos de un usuario/cliente
 * 
 * @autor Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Borrar Clientes</title>
<link href="Zeo.css" rel="stylesheet" type="text/css"/>

</head>

<body>
<!--CERRAR SESION -->
<p id="p"><?php echo "Bienvenido ".@$_SESSION['user'];?></p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input name="tancar_ses" type="submit" class="boton" value="Cerrar Sesi&oacute;n"></input>
</form>

<!--BORRAR -->
<center>
<fieldset><!--SE ABRE fieldset-->
    
<?php
    @$error=$_GET['error'];
    if ($error==0){
        echo "<h2> Cliente Modificado </h2>";
    }
    else{
        
        echo "<h2> Se ha producido un error</h2>";
    }
      //echo "<br>id:" . $id.  "<br>us:" . $usuari.  "<br>con:" .$contrasenya. "<br>nom:" .$nombre. "<br>dni:" .$DNI. "<br>dir:" .$direccion. "<br>tel:" .$telefono. "<br>email:" .$email. "<br>hab:" .$habitacion;
?>
 <!--VOLVER -->
<form id="formulario" action="modif_clients.php" method="post">
<input class="boton" type="submit" value="Volver" name="Volver" id="Volver"></input>
</form>  
 
 
</fieldset><!--CIERRE fieldset-->
</center>

</body>


</html>


