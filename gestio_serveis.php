<?php
session_start();
/**
 * Implementad la página
 * gestio_serveis.php (correspondiente al rol responsable de servicios) que permita
 * gestionar los servicios que ofrece el hotel realizando:
 * a.Las funciones básicas sobre servicios: 
 * 	añadir, eliminar y/o modificar servicios
 * b.Las funcionalidades básicas sobre tipos de servicios
 * c.Listar las reservas de servicios (por dia y/o semana) y modificar si se han
 * realizado o no
 */

/**
* Expecificacion: Fichero que saca por panala todas las opciones iniciales para modificar, eliminar, añadir y listar
* los servicios, los tipos de servicios, las reservas y los servicios realizados.
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
<title>Gesti&oacute;n de servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 




<body> 
	<center> 
					<h2>Elija qu&eacute; desea hacer</h2>
			<fieldset> 

				<h3>Servicios: listarlos, modificarlos, eliminarlos o crear uno nuevo</h3>
			
	<table>	
		<tr>
			<td>
			<form action="serveis_modificar.php" method="post"><!--Selecciona lo que quiere modificar-->
			
			</td>

			<td>
			<input type="submit" value="Modificar servicios" name="modificar_serveis">
			</form>
			</td>
			<td>
			<form action="serveis_eliminar.php" method="post"><!--Selecciona lo que quiere modificar-->
			
			</td>

			<td>
			<input type="submit" value="Eliminar servicios" name="eliminar_serveis">
			</form>
			</td>
			
			
			<td>
			<form action="serveis_anyadir.php" method="post"><!--Selecciona lo que quiere modificar-->
			
			</td>

			<td>
			<input type="submit" value="Añadir servicios" name="anyadir_serveis">
			</form>
			</td>
			
			<td>
			<form action="listado_servicios.php" method="post"><!--Selecciona lo que quiere modificar-->
			
			</td>

			<td>
			<input type="submit" value="Listar servicios" name="llistar_serveis">
			</form>
			</td>
		</tr>
	</table>
	</fieldset>
	
<p></p>
<fieldset> 

				<h3>Tipos de servicios: listarlos, modificarlos, eliminarlos o crear uno nuevo</h3>
			
		<table>	
		<tr>
			<td>
			
			
			</td>

			<td>
			<form action="class_serveis_modificar.php" method="post"><!--Selecciona lo que quiere modificar-->
			<input type="submit" value="Modificar clase de servicios" name="modificar_serveis">
			</form>
			</td>
			<td>
			
			
			</td>

			<td>
			<form action="class_serveis_eliminar.php" method="post"><!--Selecciona lo que quiere modificar-->
			<input type="submit" value="Eliminar clase de servicios" name="eliminar_serveis">
			</form>
			</td>
			
			
			<td>
			
			
			</td>

			<td>
			<form action="class_serveis_anyadir.php" method="post"><!--Selecciona lo que quiere modificar-->
			<input type="submit" value="Añadir clase de servicios" name="anyadir_serveis">
			</form>
			</td>
			
			<td>
			
			
			</td>

			<td>
			<form action="listado_class.php" method="post"><!--Selecciona lo que quiere modificar-->
			<input type="submit" value="Listar clase de servicios" name="llistar_serveis">
			</form>
			</td>
		</tr>
	</table>
	</fieldset>
	
<p></p>

<p></p>
	<fieldset>
				<h3>Escoja c&oacute;mo listar las reservas de los servicios</h3>
	<table>
		<tr>
			<td>
			<form action="llistat_reserves_serveis_dia.php" method="post">
			<input type="submit" value="Por día" name="dia">
			</form>
			</td>
			<td>
			<form action="llistat_reserves_serveis_setmana.php" method="post">
			<input type="submit" value="Por semana" name="semana">
			</form>
			</td>
			
		</tr>
	</table>
	</fieldset> 
<p></p>

<fieldset>
		<h3>Actualice si un servicio ya se ha realizado</h3>
<table>
			<form action="serveis_realitzats.php" method="post">
	
	<tr>
		<td>
			 <p><input type="submit" value="Enviar" /></p>

			</form>
		</td>
	</tr>
</table>
</fieldset>
</center>
		

</body> 
</html>		
			