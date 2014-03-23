<?php 
session_start();
/**
 * Expecificacion: fichero donde se da la opcion de dar de alta un cliente o modificar el client
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Gestion Clientes</title>
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head>

<body>

<p id="p"><?php echo "Bienvenido ".@$_SESSION['user'];?></p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input name="tancar_ses" type="submit" class="boton" value="Cerrar Sesi&oacute;n"></input>
</form>
<center>
<fieldset width=750px>
<form id="formulario" action="gestion.php" method="post">
<h2>Gestion de clientes</h2>

<input name="boton" type="submit" class="boton" value="Alta" ></input>
<input name="boton" type="submit" class="boton" value="Modificar/Baja" ></input>
</form>
</fieldset>
</center>


</body>


</html>



