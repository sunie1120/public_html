<?php
session_start();
include('funcions_bbdd.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Gesti&oacute;n de servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 
<?php

?>

<body> 
	<center> 
					<h2>Elija qu&eacute; desea hacer</h2>			
	<fieldset>
		<legend>Escoja la acci&oacute;n a realizar</legend>
			
	<table>	
		<tr>
			<td>
			<form action="serveis_modificar.php" method="post"><!--Selecciona lo que quiere modificar-->
				<select name="servicios">
					<option value="serveis">Servicios</option>
					<option value="tipusserveis">Tipos de Servicios</option>
				</select>
			</td>
			<td>

		
				<select name="accion"><!--selecciona qué quiere hacer añadir, eliminar o actualizar-->
					<option value="modificar">Modificar</option>
					<option value="eliminar">Eliminar</option>
					<option value="anyadir">A&ntilde;adir</option>		
					<option value="consultar" >Consultar</option>	
				</select>
			</td>
			<td>
			<input type="submit" value="Enviar">
			</form>
			</td>
		</tr>
	</table>
	</fieldset>
	

</center>
		

</body> 
</html>