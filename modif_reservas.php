<?php session_start();
/** Autor: Zuzana Vadaszova
 * Fecha: 20.12.2013
 * Especificacion: Fichero que muestra todos los servicios reservados, dando opcion a:
 *   - modifacarlos(editar.php)
 *   - borrarlos (borrar.php)
 */

    
include ('funcions_bdd.php');//fichero con la funciones utilizadas en este fichero
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>Modificacio Reserves</title>

<style>
body{background:#E6E6D5}
fieldset{border:6px solid #80B1B7;border-radius:180px; background:#C0D9C9; width: 70%}
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
<p> <?php  $fecha_act=date("d/m/Y G:i"); echo $fecha_act;?> </p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input class ="boton" type="submit" value="Tancar sessió" name="tancar_ses"></input>
</form>

<center>
<fieldset width=750px >
<legend align="center">
		<h2>SERVEIS RESERVATS</h2>

</legend>
<!--<form id="formulario" action="#" method="post">
	<input type="hidden" name="id_user" value="<?php $id?>">-->

<table id="servei">
<center>
<tr>
<th width="300">Nom del servei</th>
<th  width="100"> Data</th>
<th  width="100">Hora</th>
<th  width="100">Modificar</th>
<th  width="100">Anular</th>


</tr>
<?php $dni= @$_SESSION['dni'];
$reservas_c=reservas_cliente($dni); // cadena con las reservas del cliente
$reserva=explode("/", $reservas_c); //array que en cada posicion contiene datos de una reserva
$_SESSION['numeroReservas']=count($reserva); //guardo en una variable de sesion el nuemro de reservas que tiene el usuario
$arraydatas=array();  //declaro un array para guardar las fechas que necesitare para borrar los datos de la tabla
$arrayfranjas=array(); //declaro un array para guardar las franjas que necesitare para borrar los datos de la tabla
for ($i=0;$i<count($reserva)-1;$i++) { 
	//echo $reserva[$i]; echo "<br>";
	$campos_reserva=explode(" ",$reserva[$i] );   //array con campos de una reserva
    @$id_franja=$campos_reserva[0];   
    @$data=cambiarFormatoFecha2($campos_reserva[1]);  
    @$id_servei=$campos_reserva[2];   
    @$hora_inici=buscar('hora_inici','franja', 'id_franja', $id_franja); //busco hora de inicio del servicio
    @$nom_servei=buscar('nom_servei','servei', 'id_servei', $id_servei);  //busco nombre del servicio
    $_SESSION['servei']=$nom_servei;  //guardo todo en variables de sesiom
    $_SESSION['data']=$data;
    $_SESSION['hora']=$hora_inici;

    array_push($arraydatas, $data); //guardo fechas en el array 
    array_push($arrayfranjas, $id_franja); //guardo franjas en el array 
    $fecha_act_iso=date("Y/m/d G:i");
    @$fecha_c_servicio=cambiarFormatoFecha($data) . " " . $hora_inici;  //saco la fecha completa del servicio con su hora
    if(strtotime($fecha_c_servicio)>=strtotime($fecha_act_iso)) {  //si la fecha de la reserva es mayor o igual  a la que es ahora, saco por pantalla las reservas
   		 echo "<tr>";
   		 echo "<td><center>" . $nom_servei . "</center></td>" . "<td><center>" . $data . "</center></td><center>" . "<td><center>" . $hora_inici . "</center></td>";
   		 echo "<form id='formulario' action='" .  $_SERVER['PHP_SELF']. "' method='post'>";
   		 echo "<td><center><button name='boton' value='editar[$i]'><image src='Imagenes/modificar.jpg' width='30'/></button> </center></td>";
   		 echo "<td><center><button name='boton' value='borrar[$i]'><img src='Imagenes/borrar.jpg' width='30'/></button></center></td>";
   		 echo "</tr>";
  		  echo "</form>";
    }
}

 if($reservas_c==""){    //si no tiene ninguna reserva hecha 
    echo "<p>Todavia no has reservado ningun servicio<p>";
 }


 IF ($_REQUEST){  // si aprieta un boton
	for ($i=0;$i<count($reserva)-1;$i++) {   //para todas las filas que tengo con reservas
		switch (@$_REQUEST['boton'])  //segun el boton que pulse
		{
	//si pulsa el boton editar:	
		case "editar[$i]":  
		$_SESSION['editar']=$i; // guardo en la variable de sesion la posicion de la reserva que quiere modificar el cliente
		$dataS=cambiarFormatoFecha($arraydatas[$i]);
		$franjaS=$arrayfranjas[$i];
		$_SESSION['franjaS']=$franjaS; //guardo la franja y fehca en variables de sesion
		$_SESSION['dataS']=$dataS;
		$modificar_reserva=modificar_reserva($franjaS, $dataS); //llamo a la funcion para determinar si se puede modificar o no
		$_SESSION['opcion_modificar']=$modificar_reserva;  //guardo el resultado en una variable de sesion
		header('Location: editar.php'); //le mando a otra pagina
		break;
	//si pulsa boton borrar
		case "borrar[$i]":  /*  @$borrar_reserva=borrar_reserva ($id_franja, $data); echo $borrar_reserva;*/
		$_SESSION['borrar']=$i; // guardo en la variable de sesion la posicion de la reserva que quiere borrar el cliente
		$dataS=cambiarFormatoFecha($arraydatas[$i]); //cambio la fecha al formato de bdd
		$franjaS=$arrayfranjas[$i];  
		@$borrar_reserva=borrar_reserva($franjaS, $dataS);  //llama a la funcion borrar y le mando a otra pagina
		$_SESSION['resultado_borrar']=$borrar_reserva; 
	    header('Location: borrar.php');
		break;
		}
	}	
}

?>

</table>
</fieldset>
<br>
<br>
<form id="formulario" action="reserves_serveis.php" method="post">
<input class="boton" type="submit" value="Tornar al menu reserves" name="tornar"></input>
</form>
</body>
</html>