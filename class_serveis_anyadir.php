<?php
session_start();
/**
* Expecificacion: Fichero permite modificaruna clase de un servicio.
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
			<legend> A&ntilde;adir una clase de servicio</legend>
			
			<form action="#" method="post">
			<table>
			<tr><td>Indique la id de la nueva clase de servicio:</td><td><input type="text" name="nuevaid_class" /></td></tr>
			
			
			<tr><td>Indique el nombre de la nueva clase de servicio:</td><td><input type="text" name="nuevonombre" /></td></tr>
			
			
			<tr><td>Adjunte la imagen  de la nueva clase de servicio:</td><td>
			
					<form enctype="multipart/form-data" action="uploader.php" method="POST">
						<input type="hidden" name="MAX_FILE_SIZE" value="200000" /><!-- para controlar el tamaño del fichero-->
						<input name="nuevaimagen" type="file" />
						<input type="submit" value="Subir archivo" />
					</form>
			
			
			</td></tr>
			
			
			</table>
			<p><input type="submit" value="Enviar" /></p>
			</form>
			
			
			
		</fieldset>
<?php

@$nuevaid_class=$_POST['nuevaid_class'];
@$nuevonombre=$_POST['nuevonombre'];
@$imagen=$_POST['imagen'];
			anyadeclass($nuevaid_class,$nuevonombre,$imagen);
?>
			
</center>
</body> 
</html>