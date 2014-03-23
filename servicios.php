<?php
session_start();
/**
 * Autor: Zuzana Vadaszova
 * Fecha: 17.12.2013
 * Especificacion: Fichero que muestra informacion detallada sobre el servicio
 * elegido y da la opcion de reservarlo (reservar.php) o de volver atras(alta_reservas.php)
 */

include ('funcions_bdd.php');  //fichero con la funciones utilizadas en este fichero
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>Alta Reserves</title>

<style>
body{background:#E6E6D5}
fieldset{border:6px solid #80B1B7;border-radius:180px; background:#C0D9C9; width: 60%}
legend{font-weight:bold; color:#000000; background:#008080; border-radius:180px; border:solid white 6px}
p{font-weight:bold; color:#000000; font-family: Calibri}
.boton{color:#CCCDBE; border:solid; color:#008080; border-radius:8px;background:#80B1B7; font-family: Calibri; font-weight:bold}
.boton:hover{ background: #ddd;}
form{font-family: Calibri}
#servei {font-family: Calibri}

</style>
<head>

<body>
 <!-- Bienvenida al usuario y formualrios para cerrar sesion y volver a menu reservas  -->	
<p id="p"><?php $usuario=@$_SESSION['user'];echo "Bienvenido ". $usuario;?></p>
<p> <?php echo date("d/m/Y"); echo "  " . date("H:i"); ?> </p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input class ="boton" type="submit" value="Tancar sessió" name="tancar_ses"></input>
</form>
<form id="formulario" action="reserves_serveis.php" method="post">
<input class="boton" type="submit" value="Tornar a menu reserves" name="tornar"></input>
</form>

<center>
<fieldset width=750px >
<legend align="center">
<h2>Informacio del servei</h2>
</legend>
 <?php
 				 //si se reciben datos por post desde el fichero alta_reservas
 				if ($_POST){
     	            @$servicios =($_POST['servei']); //guardo el resultado(array asoc) en una variable
     	            $servicioRecogido= $servicios[0];  // recogo el servicio en una variable  
     	            $_SESSION['servei']=$servicioRecogido;  //almaceno el servicio en una variable de sesion
     	            $descripcio=descripcio_servei($servicioRecogido); //lamo a la funcion descripcion_servei para sacar la descripcion
     	             $_SESSION['descripcio']=$descripcio;  //almaceno la descripcion del servicio en una variable de sesion
     	            
     	             //saco por pantalla la descripcion en una tabla
     	            echo "<table>
						<center>
						<tr><td><p>Servei:</p></td><td>$servicioRecogido</td><tr>
						<tr><td><p>Descripcio:</p></td><td> $descripcio</td><tr>
						</center>
						<table>";

						//formularios con botones para volver altras y para seguir con la reserva que nos lleva al fichero reservar.php
						echo "<form id='formulario' action='alta_reservas.php' method='post'>
						<input class='boton' type='submit' width='20px' name='tornar' value='Tornar'>
				        </form>
				        <form id='formulario' action='reservar.php' method='post'>
						<input class='boton' type='submit' width='20px' name='Reservar' value='Reservar'>
				        </form>";			
     	        }
?>
</fieldset>
</center>
</body>
</html>

