<?php
session_start();
include ('funcions_bdd.php');
/**
 * Autor: Zuzana Vadaszova
 * Fecha: 21.12.2013
 * Especificacion: Fichero que  muestralosiguiente:
 *      - Si se puede modificar muestra menus desplegables con fechas y horas para 
 *      modificar y boton para enviar sacando posteriormente mensaje de modificacion
 *      - si no se puede modoficar saca mensaje de que se no se puede porque faltan
 *       menos de 3 horas.
 */

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
        <h2>MODIFICACION DE LA RESERVA</h2>

</legend>
<?php
    @$nom_servei=buscar_Nomservei($_SESSION['franjaS'], $_SESSION['dataS']);
    $fecha_s=cambiarFormatoFecha2($_SESSION['dataS']);
    $hora_s=buscar('hora_inici','franja','id_franja', $_SESSION['franjaS']);
    
    if(@$_SESSION['opcion_modificar']==1) {
        echo "<p>Ya no puedes modificar la reserva, porque faltan menos de tres horas<p>";
          echo     "<form id='formulario' action='modif_reservas.php' method='post'>
                            <input class='boton' type='submit' width='20px' name='tornar' value='Les meves reserves'>
                            </form>
                            <form id='formulario' action='alta_reservas.php' method='post'>
                            <input class='boton' type='submit' width='20px' name='tornar' value='Fer una  reserva'>
                            </form>";
    }
            
    if(@$_SESSION['opcion_modificar']==0) { 
        
?>
        <table id="servei">
        <center>
        <tr>
        <th width="300">Nom del servei</th>
        <th  width="100"> Data</th>
        <th  width="100">Hora</th>
        </tr>
        <?php
        echo "<form id='formulario' action='" .  $_SERVER['PHP_SELF'] . "'method='post'> ";
        echo "<tr>";
        echo "<td><center>" . $nom_servei . "</center></td>" . "<td><center>
         <select name='fecha[]'>";
         $fecha=date("d/m/Y");  //saco la fecha del sistema
                    for($i=0;$i<=7;$i++) {  //hago un bucle para incrementar dias a la fecha del sistema hasta 7
                        switch (cambiarFecha($fecha,$i)) {
                            case $fecha_s:
                                 echo "<option selected value='" . cambiarFecha($fecha,$i) . "'>"; 
                                 echo cambiarFecha($fecha,$i); 
                                 echo "</option>"; 
                                break;
                            
                            default:
                                echo "<option value='" . cambiarFecha($fecha,$i) . "'>";  
                                echo cambiarFecha($fecha,$i) ;  //llamo a la funcion cambiar_fecha por i dias
                                echo "</option>";
                                break;
                        }
 
                    }

                    echo "</td></select>
                     <td><select name='hora[]'>";
                    $horas=lista_horas(); //llamo a la funcion lista_horas para obtener la cadena que contiene las horas
                    $hora=explode(" ",$horas); //creo un array con las horas
                    for($i=0;$i<count($hora)-1;$i++) {  //saco las horas de la base de datos
                        switch ($hora[$i]) {
                            case $hora_s:
                                 echo "<option selected value='" . $hora[$i] . "'>"; 
                                 echo $hora[$i]; 
                                 echo "</option>"; 
                                break;
                            
                            default:
                                echo "<option value='" . $hora[$i] . "'>";  
                        echo $hora[$i]; 
                        echo "</option>";
                                break;
                        }
                    
                    }
                    echo "</td>
             <td><input class='boton' type='submit' width='20px' name='tornar' value='Guardar'> </td>";
            echo "</tr>";
            echo "</form>";

                        echo     "<form id='formulario' action='modif_reservas.php' method='post'>
                            <input class='boton' type='submit' width='20px' name='tornar' value='Les meves reserves'>
                            </form>
                            <form id='formulario' action='alta_reservas.php' method='post'>
                            <input class='boton' type='submit' width='20px' name='tornar' value='Fer una  reserva'>
                            </form>";


             if ($_POST){
             @$id_servei=buscar('id_servei', 'servei', 'nom_servei', $nom_servei); //saco el id del servicio
             @$dias_servicio=$_POST['fecha'];   
             @$horas_servicio=$_POST['hora'];  
             @$diaRecogido=cambiarFormatoFecha($dias_servicio[0]);  //dia escogido en el formato de la fecha de la bdd
             @$horaRecogida=$horas_servicio[0];  //hora escogida 
             $id_franja=buscar('id_franja','franja', 'hora_inici', $horaRecogida); //saco id de la franja de la hora escogida por el usuario para cambiar
            
             $modificacion=modificar_res($diaRecogido, $id_franja,$_SESSION['dataS'],$_SESSION['franjaS']); //modifico la fecha y hora de la reserva de la cual fecha y hora anterior es tal...
             if ($modificacion==0) {
                echo "<p> La reserva se ha modificado correctamente<p><br>";
                
             }
             else  echo "<p> Ese dia y hora no esta disponiblee<p><br>";
             
             }

    }

     
 ?>
     
</fieldset>
  

                        
                      




</body>


</html>