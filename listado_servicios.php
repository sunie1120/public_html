<?phpsession_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Tyde pe" content="text/html; charset=ISO-8859-1" />
<title>Listar las Reservas Servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 

<body> 

<h1>Listar servicios</h1>

<?php
/**
* Expecificacion: Fichero permite muestra las diferentes opciones ara cunsultar los servicios por campos.
* 
* @autor Esther Herrero
* @version 1
* @date 13.01.2014
*/
?>




		
<center>		
			
<fieldset>
			<legend> Consultar los servicios</legend>

					
		<table>
			<tr>
				<td>
					<form action="mostar_todos_servicios.php" method="post">
					<input type="submit"  value="Mostrar todos los datos de los servicios" name="motrartodos"/>
					</form>
				</td>
			</tr>
			<tr>
				<td>
				<form action="mostar_nombres_servicios.php" method="post">
					<input type="submit"  value="Mostrar los nombres los servicios" name="mostrarnombres"/>
					</form>
				</td>
			</tr>
			<tr>
				<td>
				<form action="mostar_id_servicios.php" method="post">
					<input type="submit"  value="Mostrar las id de los servicios" name="mostrarid"/>
					</form>
				</td>
			</tr>
			<tr>
				<td>
				<form action="mostar_idclass_servicios.php" method="post">
					<input type="submit"  value="Mostrar las id de las clases de servicios" name="mostraridclass"/>
					</form>
				</td>
			</tr>
			<tr>
				<td>
				<form action="mostar_descripciones_servicios.php" method="post">
					<input type="submit"  value="Mostrar las descripciones de los servicios" name="mostrardescripciones"/>
					</form>
				</td>
			</tr>
		</table>	
			
			
</fieldset>
		
		
</center>	
</body> 
</html>