<?php
session_start();
/**
* Expecificacion: Fichero permite eliminar una clase de servicio
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
		<legend> Eliminar una clase de servicio</legend>
			<form action="#" method="post">

					<p>Indique el nombre de la clase del servicio:</td><td><input type="text" name="nom_class" /></p>
					<p>Indique la id de la clase del servicio:</td><td><input type="text" name="id_class" /></p>
			
					<p><input type="submit" value="Enviar" /></p>
					
			</form>
			


		</fieldset> 
<?php
$id_class=$_POST['id_class'];
$nom_class=$_POST['nom_class'];


$filas=elimina_class($id_class, $nom_class);

			
if($filas>0){
echo"<table>";
echo "<tr>";
echo "<td>Clase de servicio eliminada.</td>";
echo "</tr>";
echo"<table>";}else{
echo"<table>";
echo "<tr>";
echo "<td>No se puede eliminar una clase de servicio mientras hayan servicios de la misma.</td>";
echo "</tr>";
echo"<table>";
}
?>	


</center>
</body> 
</html>