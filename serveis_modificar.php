<?php
session_start();
/**
* Expecificacion: Fichero permite elegir lo que se quiere modificar de un servicio y redirige a la página adecuada.
* 
* @autor Esther Herrero
* @version 1
* @date 13.01.2014
*/
include('funcions_bdd.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Modificar Servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 

<body> 
<center>



			<fieldset> 
			<legend> Modificar un servicio</legend>
			<form action="servicio_modificado.php" method="post">
			<table>
			<tr><td>Indique la id del servicio:</td><td><input type="text" name="idservei" /></td></tr>
			
			
			<tr><td>Indique el nuevo nombre del servicio:</td><td><input type="text" name="nuevonombre" /></td></tr>
			
			
			<tr><td>Indique la  nueva descripci&oacute;n del servicio:</td><td><textarea name="nuevadescripcion" rows="8" cols="30"></textarea></td></tr>
			
			<tr><td>Indique la  nueva id de la clase de servicio:</td><td><input type="text" name="nueva_idclass" /></td></tr>
			
			</table>
			<p><input type="submit" value="Enviar" /></p>
			</form>
			</fieldset> 

</center>
</body> 
</html>