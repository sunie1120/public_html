<?php
session_start();
/** Autor: Zuzana Vadaszova
 *  Fecha: 17.12.2013
 *  Especificacion: Fichero que muestra informacion sobre la reserva que se ha intentado realizar. Si se ha realizado, imprime 
 *  informacion sobre el servicio reservado y da acceso a realizar otra reserva o modificar reservas
 */

include ('funcions_bdd.php'); //fichero con la funciones utilizadas en este fichero
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
 			if ($_POST) { //si se han recibido dato por post 
     	            	@$horas_servicio=$_POST['hora'];        //recogo la seleccion en la variable
                    	@$horaRecogida=$horas_servicio[0];  //guardo hora escogida
                    	 
                    	 @$id_franja=buscar('id_franja','franja','hora_inici',$horaRecogida); //id_franja de la hora elegida
			        	 @$id_usuario=buscar('id','usuaris','user_name',$usuario);  //saco el id de usuario qu enecesito para sacar el dni	        	  
			        	 @$dni_usuario=buscar('dni','client','id_usuari',$id_usuario); //saco el dni del usuario para poder realizar la reserva
                         @$_SESSION['dni']=$dni_usuario;
                         @$dia=cambiarFormatoFecha($_SESSION['dia']); //cambio formato de fecha por el que esta en la bdd
                         @$id_servei=buscar('id_servei','servei','nom_servei',$_SESSION['servei']); //saco el id del servicio
                         $fecha_act_iso=date("Y-m-d G:i");  //saco fecha actual completa 
   						 @$fecha_c_servicio=$dia . " " . $horaRecogida;  //saco la fecha completa con su hora escogida para el servicio

   						 if(strtotime($fecha_c_servicio)>strtotime($fecha_act_iso)) {  //si la fecha escogida para el servicio es mayor que la actual 
	                        $reservado=insert_reserva($id_franja,$dia,$id_servei,$dni_usuario); //llamo a la funcion insertar_reserva y guardo el resultado
	                        if($reservado==0 ) {  //si se ha reservado  saco por pantalla informacion sobre la reserva
						    	echo "<p>INFORMACIO SOBRE LA RESERVA:<p>
								<table>
								<center>
								<tr><td>Servei:</td><td>" .  @$_SESSION['servei'] . "</td><tr>
								<tr><td>Descripcio:</td><td>" .  @$_SESSION['descripcio'] . " </td><tr>
								<tr><td>Dia:</td><td>" . $_SESSION['dia'] . "</td><tr>
								<tr><td>Hora:</td><td> $horaRecogida</td><tr>
								</center>
								<table>
								<form id='formulario' action='alta_reservas.php' method='post'>
								<input class='boton' type='submit' width='20px' name='tornar' value='Fer una altra reserva'>
					        	</form>
					        	<form id='formulario' action='modif_reservas.php' method='post'>
								<input class='boton' type='submit' width='20px' name='tornar' value='Cambiar la reserva'>
					        	</form>";
							}
							
							  else
								echo "<p>Error inesperat. Intentaho mes tard!</p>
								<form id='formulario' action='modif_reservas.php' method='post'>
								<input class='boton' type='submit' width='20px' name='tornar' value='Les meves reserves'>
					        	</form>
								<form id='formulario' action='alta_reservas.php' method='post'>
								<input class='boton' type='submit' width='20px' name='tornar' value='Fer una altra reserva'>
					        	</form>";
							    


	  					    
	  					 }
	  					
	  					 

	  				}




 				/*if ($_POST){
     	            @$servicios =($_POST['servei']); //guardo el resultado(array asoc) en una variable
     	            $servicioRecogido= $servicios[0];  // recogo el servicio el una variable  
     	            $_SESSION['servei']=$servicioRecogido;  //almaceno el servicio en una variable de sesion
     	            $descripcio=descripcio_servei($servicioRecogido); //lamo a la funcion descripcion_servei para sacar la descripcion
     	             $_SESSION['descripcio']=$descripcio;  //almaceno la descripcion del servicio en una variable de sesion
     	            echo "<table>
						<center>
						<tr><td><p>Servei:</p></td><td>$servicioRecogido</td><tr>
						<tr><td><p>Descripcio:</p></td><td> $descripcio</td><tr>
						</center>
						<table>
						<form id='formulario' action='alta_reservas.php' method='post'>
						<input class='boton' type='submit' width='20px' name='tornar' value='Tornar'>
				        </form>
				        <form id='formulario' action='reservar.php' method='post'>
						<input class='boton' type='submit' width='20px' name='Reservar' value='Reservar'>
				        </form>";
					
     	        }
*/


?>

</fieldset>
</center>


</body>


</html>


<?php

     	        
						
                     
?>