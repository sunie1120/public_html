<?php
session_start();
/**
* Expecificacion: Fichero que permite añadir n nuevo servicio a la tabla serveis
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
		<legend>Añade un servicio un servicio</legend>
			<form action="#" method="post">

					<p>Indique el nuevo nombre del servicio:</td><td><input type="text" name="nuevonombre" /></p>
					<p>Indique la nueva id del servicio:</td><td><input type="text" name="nuevaid_servei" /></p>
					<p>Indique la nueva descripcion del servicio:</td><td><input type="text" name="nuevadescripcion" /></p>
					<p>Indique la nueva id de la clase del servicio:</td><td><input type="text" name="nueva_idclass" /></p>

					<p><input type="submit" value="Enviar" /></p>
					
			</form>
			


		</fieldset> 
<?php

@$nuevaid_servei=$_POST['nuevaid_servei'];
@$nuevonombre=$_POST['nuevonombre'];
@$nuevadescripcion=$_POST['nuevadescripcion'];
@$nueva_idclass=$_POST['nueva_idclass'];

			$anyadido=anyadeservei($nuevaid_servei,$nuevonombre,$nuevadescripcion,$nueva_idclass);
			
if($anyadido){
echo"<table>";
echo "<tr>";
echo "<td>Servicio añadido.</td>";
echo "</tr>";
echo"<table>";}
?>	


</center>
</body> 
</html>