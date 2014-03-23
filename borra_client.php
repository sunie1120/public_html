<?php 
session_start();
/**
 * Expecificacion: Fichero que ejecuta la orden de borrar un usuario y cliente.
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */

include ('funcions_bdd.php');//INCLUYE EL ARCHIVO DE FUNCIONES
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
    @$id=$_POST['id'];//se recoge el id
    $resultado=eliminar_usuari($id);

    if ($resultado==0){echo "<h2><div align=\"center\">Registro Borrado</div></h2>";}
    else{echo "<h2><div align=\"center\">Se ha producido un error</div></h2>";}

?>
 <!--VOLVER -->
<form id="formulario" action="modif_clients.php" method="post">
<input class="boton" type="submit" value="Volver" name="Volver" id="Volver"></input>
</form>  
 
 
</fieldset><!--CIERRE fieldset-->
</center>

</body>


</html>
