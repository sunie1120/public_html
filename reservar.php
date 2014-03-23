<?php
session_start();
/**
 * Autor: Zuzana Vadaszova
 * Fecha: 17.12.2013
 * Especificacion: Fichero que muestra un menu desplegable con fechas disponibles
 *  para la reserva (los proximos 7 dias) y posteriormente al elegir fecha muestra
 *  horas disponibles para el servicio ( las horas que alguien ya ha reservado ese
 *  servicio, no aparecen) Al  hacer click en reserva, se redirecciona al fichero
 *  reservado.php
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
<input class="boton" type="submit" value="Tornar al menu reserves" name="tornar"></input>
</form>

<center>
<fieldset width=750px >
<legend align="center">
<h2>Reserva servei</h2>
</legend>
<?php
			   
					echo "<table>";
					echo "<form id='formulario' action='" .  $_SERVER['PHP_SELF'] . "'method='post'> ";
					echo "<tr>
                    <td>Data:</td>
                    <td><select name='fecha[]'>"; //menu desplegable con las fechas desde hoy hasta de aqui 7 dias
                    $fecha=date("d/m/Y");  //saco la fecha del sistema
                    for($i=0;$i<=7;$i++) {  //hago un bucle para incrementar dias a la fecha del sistema hasta 7
                      	echo "<option value='" . cambiarFecha($fecha,$i) . "'>";  
				 		            echo cambiarFecha($fecha,$i) ;  //llamo a la funcion cambiar_fecha por i dias
		 		  	          	echo "</option>";
		 		          	}
		 		  echo "</td></tr></select>
                     <tr><td><input class ='boton' type='submit' value='Veure hores' name='Veure hores disponibles'></input></td></tr>
                    </form>
                    </table>";
      if ($_POST) {  //si se han recibido datos por post
                @$dia=($_POST['fecha']); //en la variable dia guardo la fecha 
     	    for ($i=0;$i<count($dia);$i++) {         //para cada dia escogido saco las horas disponibles en este bucle for
                $dia_escogido= $dia[$i];   	    //en la variable dia_escogido guardo el dia escogido                   
                $_SESSION['dia']=$dia_escogido; //lo guardo en una variable de sesion
                
                 @$id_servei=buscar('id_servei','servei','nom_servei',$_SESSION['servei']); //saco el id del servicio 
                 @$data_s=cambiarFormatoFecha($dia_escogido); //cambio el formato de fecha como la de bdd
                 @$comprobacion=comprobar_reserva($data_s,$id_servei); //guardo en la variable compribacion las franjas ocupadas para reservar
   					     $franja_ocupada=explode(" ",$comprobacion);  //guardo en un array las franjas ocupadas
   					     $horas_ocupadas="";
   					   for($i=0;$i<count($franja_ocupada)-1;$i++) { //para sacar la hora_inici de cada franja ocupada
                    		 $hora_ocupada[$i]=buscar('hora_inici','franja', 'id_franja', $franja_ocupada[$i]);
                    		 $horas_ocupadas=$horas_ocupadas . " " . $hora_ocupada[$i]; //en horas_ocupadas guardo las horas_inici ocupadas
                }
                    echo "<table>";
                    //formulario para reservar escogiendo la hora_inici
				          	echo "<form id='formulario' action='reservado.php' method='post'> ";
			          		echo "<tr>
                    <td>Hora:</td>
                    <td><select name='hora[]'>";	//select para crear menu dsplegable con horas de inicio de servicio disponibles
                    	 $horas=lista_horas(); //llamo a la funcion lista_horas para obtener la cadena que contiene las horas
                    $hora=explode(" ",$horas); //creo un array con las horas                
                    for($i=0;$i<count($hora)-1;$i++) {  //pongo las horas libres en el menu desplegable
                      	$buscar_hora[$i]=strpos($horas_ocupadas,$hora[$i]); //en la cadena donde tengo las horas ocupadas, busco coincidencia
	                    	if($buscar_hora[$i]==false) {  //si no encuentro coincidencia con horas_inici ocpupadas, las imprimo
	                    		echo "<option value='" . $hora[$i] . "'>";  
					 			          echo $hora[$i]; 
			 		  		        	echo "</option>";
	                       }	
		 		             }
                    echo "</td></tr></select>";
                    //boton para reservar la reserva que nos lleva al fichero reservado.php
                    echo "<tr><td><input class ='boton' type='submit' value='Reservar' name='Reservar'></input></td></tr>
                    </form>
                    </table>";
          }

      }                  
?>
</fieldset>        
</body>
</html>


