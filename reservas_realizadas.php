<?php session_start();
/** Autor: Zuzana Vadaszova
 *  Fecha: 09.01.2014
 *  Especificacion: fichero que muestra reservas realizadas, si nohay ninguna saca mnsjae de que no hay ninguna
 */ 
  
include ('funcions_bdd.php');
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
<p id="p"><?php echo "Bienvenido ".@$_SESSION['user'];?></p>
<p> <?php  $fecha_act=date("d/m/Y G:i"); echo $fecha_act;?> </p>


<form id="formulario" action="cerrar_sesion.php" method="post">
<input class ="boton" type="submit" value="Tancar sessió" name="tancar_ses"></input>
</form>
<center>
<fieldset width=750px >
<legend align="center">
		<h2>SERVEIS REALISATS</h2>

</legend>
<?php $dni= @$_SESSION['dni'];
$reservas_c=reservas_cliente($dni); // cadena con las reservas del cliente
$reserva=explode("/", $reservas_c); //array que en cada posicion contiene datos de una reserva
$_SESSION['numeroReservas']=count($reserva); //guardo en una variable de sesion el nuemro de reservas que tiene el usuario
$arraydatas=array();  //declaro un array para guardar las fechas que necesitare para borrar los datos de la tabla
$arrayfranjas=array(); //declaro un array para guardar las franjas que necesitare para borrar los datos de la tabla
$contador_r_realizadas=0; //inicializo contador de reservas realizadas en 0
  echo  "<table id='servei'>
            <center>
            <tr>
            <th width='300'>Nom del servei</th>
            <th  width='100'> Data</th>
            <th  width='100'>Hora</th>
            </tr>";
for ($i=0;$i<count($reserva)-1;$i++) {   //saco info de las reservas
	$campos_reserva=explode(" ",$reserva[$i] );   //array con campos de una reserva
    @$id_franja=$campos_reserva[0];   
    @$data=cambiarFormatoFecha2($campos_reserva[1]);  
    @$id_servei=$campos_reserva[2];   
    @$hora_inici=buscar('hora_inici','franja', 'id_franja', $id_franja);
    @$nom_servei=buscar('nom_servei','servei', 'id_servei', $id_servei);
    $_SESSION['servei']=$nom_servei;
    $_SESSION['data']=$data;
    $_SESSION['hora']=$hora_inici;
    $_SESSION['fecha_compl_serv']=$hora_inici;
    array_push($arraydatas, $data); //inserto al final del array $arraydatas el dato de la vuelta de bucle
    array_push($arrayfranjas, $id_franja);
    $data_servei_bdd=cambiarFormatoFecha($data);
    $realitzat=servei_realizado($data_servei_bdd,$id_franja); //busco si servicio se ha realizado o no 
    if($realitzat==1) {  //si el campo realizado de la tabla reserva es igual a 1  (es que se ha realizado)
       echo "<tr>";
   		 echo "<td><center>" . $nom_servei . "</center></td>" . "<td><center>" . $data . "</center></td><center>" . "<td><center>" . $hora_inici . "</center></td>";
   		 echo "</tr>";
  		  echo "</form>";
        $contador_r_realizadas++;
    }
}
 
 if($contador_r_realizadas==0){ //si no se ha realizado
    echo "<p>Todavia no has realizado ningun servicio<p>";
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