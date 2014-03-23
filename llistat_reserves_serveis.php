<?phpsession_start();
/**
* Expecificacion: Fichero que muetsra las opciones para listar las reservas realizadas
* 
* @autor Esther Herrero
* @version 1
* @date 13.01.2014
*/
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
	<center> <h2>Elija qu&eacute; desea hacer</h2>	
			<fieldset>
			<legend>Escoja c&oacute;mo listar las reservas de los servicios</legend>
	<table>
		<tr>
			<td>
			<form action="reserves_serveis_rs.php" method="post">
				<select name="listado"><!--selecciona cómo quiere listar los servicios reservados-->
					<option value="ListarDia">Listar por d&iacute;a</option>
					<option value="ListarSemana">Listar por semana</option>
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