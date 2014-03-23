<?php 
session_start();
/**
 * Expecificacion: archivo que le indica al usuario si el se a eliminado el cliente
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
    
    <h2>Cliente Creado</h2>
    <p>El cliente se ha dado de alta correctamente.</p>
 <!--VOLVER -->
 <form id="formulario" action="alta_clients.php" method="post">
<input class="boton" type="submit" value="Volver" name="Volver" id="Volver"></input>
</form>  
 
 
</fieldset><!--CIERRE fieldset-->
</center>

</body>


</html>
