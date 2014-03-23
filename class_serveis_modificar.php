<?php
session_start();
/**
* Expecificacion: Fichero permitemodificar una clase de servicio
* 
* @autor Esther Herrero
* @version 1
* @date 13.01.2014
* @copyright 
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
			<legend> Modificar una clase de servicio</legend>
			<form action="#" method="post">
			<table>
			<tr><td>Indique la id de la clase de servicio:</td><td><input type="text" name="id_class" /></td></tr>
			
			
			<tr><td>Indique el nuevo nombre de la clase del servicio:</td><td><input type="text" name="nuevonombre" /></td></tr>
			
			
			<tr><td>Adjunte a nueva imagen de la clase del servicio:</td>
			<tr>
			<td>
			
					<form id="form1" enctype="multipart/form-data" method="post" action="recepcion.php">
						<label>Imagen
							<input id="campofotografia" name="campofotografia" type="file" />
						</label>
							<input id="enviar" name="enviar" type="submit" value="Enviar" />
					</form>
			
			</td>
			</tr>
				
			</table>
			<p><input type="submit" value="Enviar" /></p>
			</form>
			</fieldset> 
<?php			
@$id_class=$_POST['id_class'];
@$nuevonombre=$_POST['nuevonombre'];
@$nuevaimagen=$_POST['nuevaimagen'];
$directorio_destino="Imagenes/";



			$class_modificada=modifica_class($id_class,$nuevonombre,$nuevaimagen);
			subir_fichero($directorio_destino, $nombre_fichero);
	if($class_modificada){
	echo"<table>";
	echo "<tr>";
	echo "<td>Clase de servicio modificada.</td>";
	echo "</tr>";
	echo"</table>";
	}else{
		echo"<table>";
		echo "<tr>";
		echo "<td>No se ha podido modificar la clase.</td>";
		echo "</tr>";
		echo"</table>";}
?>
</center>
</body> 
</html>