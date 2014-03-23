
<?php
session_start();
include('funcions_bdd.php');
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Gesti&oacute;n de servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 

<body>
<center>
<?php			
@$id_servei=$_POST['idservei'];
@$nuevadescripcion=$_POST['nuevadescripcion'];
@$nuevonombre=$_POST['nuevonombre'];
@$nueva_idclass=$_POST['nueva_idclass'];

		
		$modificar=modifica_servei($id_servei,$nuevonombre,$nuevadescripcion,$nueva_idclass);
		echo "<br>" . $modificar;
			
		
echo"<table>";
echo "<tr>";
echo "<td>Id del servicio: $id_servei</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Nuevo nombre del servicio: $nuevonombre</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Nueva descripcion del servicio: $nuevadescripcion</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Nueva id de clase del servicio: $nueva_idclass</td>";
echo "</tr>";

echo "</table>";
?>
</center>
</body>
</html>