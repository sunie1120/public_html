<?php session_start();
/** Autor: Zuzana Vadaszova
  * Fecha: 13.12.2013
  * Especificacion: Fichero que contiene el acceso del cliente si se loga
  * correctamente a menu de gestion de sus reservas de servicios.
  * Las gestiones que puede realizar son:
  * 	 - añadir una nueva reserva
  * 	 - modificar una reserva y/o anular una reserva
  * 	 - consultar reservas realizadas.
  * 
  * Implementad la página reserves_serveis.php (correspondiente al rol cliente) donde un cliente deberá
  * poder gestionar las reservas que desee sobre sus servicios (añadir una nueva reserva, consultar 
  * las que tiene realizadas, modificar una reserva y/o anular una reserva). La anulación ha de realizarse 
  * con una antelación mínima de tres horas. El cliente ha de tener la posibilidad de consultar por tipo de 
  * servicio a reservar y dentro de esta una vista semanal (fecha actual + 7 dias)  
  */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>Reserves Serveis</title>

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
<p id="p"><?php echo "Bienvenido ".@$_SESSION['user'];?></p>  
<p> <?php echo date("d/m/Y G:i");  ?> </p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input type="submit" value="Tancar sessió" name="tancar_ses"></input>
</form>
<center>
<fieldset width=750px>
<form id="formulario" action="gestion_reservas.php" method="post">
<h2>Gestió de reserves</h2>

<input type="submit" value="Añadir reserva" name="boton" ></input>
<input type="submit" value="Modificar/Anular reserva" name="boton" ></input>
<input type="submit" value="Ver reservas realizadas" name="boton" ></input>
</form>
</fieldset>
</center>


</body>


</html>