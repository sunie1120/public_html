<?php
session_start();
/**
* Expecificacion: Fichero permite eliminar un servicio.
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
		<legend> Eliminar un servicio</legend>
			<form action="#" method="post">

					<p>Indique el nombre del servicio:</td><td><input type="text" name="nomservei" /></p>
					<p>Indique la id del servicio:</td><td><input type="text" name="idservei" /></p>
			
					<p><input type="submit" value="Enviar" /></p>
					
			</form>
			


		</fieldset> 
<?php
$nomservei=$_POST['nomservei'];
$id_servei=$_POST['idservei'];

			$eliminado=elimina_servei($nomservei, $id_servei);
			
if($eliminado){
echo"<table>";
echo "<tr>";
echo "<td>Servicio eliminado.</td>";
echo "</tr>";
echo"<table>";}
?>	


</center>
</body> 
</html>