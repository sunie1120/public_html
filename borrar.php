<?php
session_start();
/**
 *  Autor: Zuzana Vadaszova
 * Fecha: 21.12.2013
 * Especificacion: Fichero que muestra el resultado de borrar una reserva.
*/ 
include ('funcions_bdd.php');
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
<p id="p"><?php $usuario=@$_SESSION['user'];echo "Bienvenido ". $usuario;?></p>
<p> <?php echo date("d/m/Y G:i");  ?> </p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input class ="boton" type="submit" value="Tancar sessió" name="tancar_ses"></input>
</form>
<form id="formulario" action="reserves_serveis.php" method="post">
<input class="boton" type="submit" value="Tornar al menu reserves" name="tornar"></input>
</form>
<center>
<fieldset width=750px >
<legend align="center">
		<h2>ANULACION DE LA RESERVA</h2>

</legend>
<?php

			if($_SESSION['resultado_borrar']==0) {  //si resultado de borrar es 0 
				echo "<p>La reserva ha sido borrada con exito<p>";
			}
		
			if(@$_SESSION['resultado_borrar']==1) {
					echo "<p>Ya no puedes borrar la reserva, porque faltan menos de tres horas<p>";
			}
			if(@$_SESSION['resultado_borrar']==2) {	
					echo "Imposible borrar reserva";
			}
		                echo     "<form id='formulario' action='modif_reservas.php' method='post'>
							<input class='boton' type='submit' width='20px' name='tornar' value='Les meves reserves'>
				        	</form>
							<form id='formulario' action='alta_reservas.php' method='post'>
							<input class='boton' type='submit' width='20px' name='tornar' value='Fer una  reserva'>
				        	</form>";
?>
       
</fieldset>

</body>
</html>