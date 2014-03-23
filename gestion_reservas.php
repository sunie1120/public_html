<?php session_start();
/**
 * Autor: Zuzana Vadaszova
 * Fecha: 13.12.2013
 * Especificacion: Fichero que da acceso a diferentes paginas php para realizar alguna de las gestiones siguientes 
 * 	 - añadir una nueva reserva (alta_reserva.php)
 * 	 - modificar una reserva y/o anular una reserva (modif_reservas.php)
 * 	 - consultar reservas realizadas. (reservas_realizadas.php)
*/
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>Gestió Reserves</title>

<style>


</style>
<head>

<body>
 <!-- Bienvenida al usuario y formualrios para cerrar sesion y volver a menu reservas  -->
<?php echo "Bienvenido ".@$_SESSION['user'];?>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input type="submit" value="Tancar sessio" name="tancar_ses"></input>
</form>
<center>
<?php

IF ($_REQUEST)
{
	switch ($_REQUEST['boton'])
	{
	case "Añadir reserva": header('Location: alta_reservas.php'); 
	break;
	case "Modificar/Anular reserva": header('Location: modif_reservas.php');
	break;
	case "Ver reservas realizadas": header('Location: reservas_realizadas.php');
	break;
	}
}


?>
</center>


</body>


</html>