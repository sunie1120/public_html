<?php
session_start();
include ('funcions_bdd.php'); //fichero con la funciones utilizadas en este fichero


/**
 * Autor: Zuzana Vadaszova
 * Fecha: 16.12.2013
 * Especificacion: Fichero que permite realizar una nueva reserva. Aqui esta 
 * llevado el cliente desde la pagina reserves_serveis si hace click en el boton
 *  Añadir reserva.
 *  Las gestiones que puede realizar son:
 * 	 - seleccionar el tipo de servicio y posteriormente de este seleccionar 
 *         el servicio que desea reservar. al dar click en ver informacion la 
 *         opcion de reservarlo. 
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
 <!-- Bienvenida al usuario y formualrios para cerrar sesion y volver a menu reservas  -->
<body>
<p id="p"><?php $usuario=@$_SESSION['user'];echo "Bienvenido ". $usuario;?></p>
<p> <?php echo date("d/m/Y G:i");  ?> </p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input class ="boton" type="submit" value="Tancar sessió" name="tancar_ses"></input>
</form>
<form id="formulario" action="reserves_serveis.php" method="post">
<input class="boton" type="submit" value="Tornar" name="tornar"></input>
</form>

<center>
<fieldset width=750px >
<legend align="center">
		<h2>Formulari d'alta reserves</h2>

</legend>
	     <!-- Formulario para escoger el tipo de servicio -->
		 <form id="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post"> 
		 <table>
		 	<tr><td>
		    Tipus de servei:
 			</td>
    		 <td> 
    		<!-- Menu desplegable con tipos de servicio disponibles -->
    	    <select  name="tipus[]">  
		    <?php 
			$clases=lista_clases();  //llmada a la funcion lista_clases para obtener una cadena con las clases disponibles en bdd
			$clase=explode(",",$clases);  //las clases las guardo en un array numerico
	  		 for($i=0;$i<(count($clase))-1;$i++) {   //saco todas las clases en el select y aparecen en el menu desplegable
				  echo "<option value='" . $clase[$i] . "'>";  
				  echo $clase[$i]; 
		 		  echo "</option>";
		     }
		     ?>
             </select>
             </td>
             </tr>
              <!-- Boton submit para ver los servicios de esta clase -->
		     <tr><td><input class ='boton' type='submit' value='Veure serveis' name='Veure serveis'></input></td></tr>
     		</table>
			 </form>
            
        <?php   
        if ($_POST){  //si se reciben datos por post al clickar el boton submit
        	@$tipus =($_POST['tipus']);   //guardo en la variable tipus las  selecciones
     	    for ($i=0;$i<count($tipus);$i++) {      //en el bucle for saco la clase escogida de la seleccion
                $claseRecogida= $tipus[$i];   	                       
                $_SESSION['clase']=$claseRecogida; //guardo la clase en una variable de sesion
                @$id=id_clase($claseRecogida); //llamo a la funcion id_clase para sacar el id de la clase escogida    
                
				@$serveis=servicios_clases($id); //lamamos a la funcion servicios_clases para sacar la cadena que contiene los servicios de la clase
				$servei=explode(",",$serveis);  //aray que contiene los servicios de la clase
        		
        		 // Formulario para escoger el servicio:
                echo "<form id='formulario' action='servicios.php' method='post'> ";
                echo "<table>";
                echo "<tr><td>Servei:</td>";
				echo "<td><select name='servei[]'>";
				for($i=0;$i<count($servei)-1;$i++) {  //saco los servicios de la clase escogida
				    echo "<option value='" . $servei[$i] . "'>";  
				 	echo $servei[$i]; 
		 		  	echo "</option>";
		 		}	 		  					   
		 		echo "</td></tr>";
		 		echo "</select>";
		 		//boton para acceder a la info de servicio que nos llevara a la pagina servicios.php
		 		echo "<tr><td><input class ='boton' type='submit' value='Informacion servicio' name='Informacion servicio'></input></td></tr>";
		 		echo "</table></form>";

		 		echo "</fieldset>";

		     }
		}

      
                ?>
 	

</body>
</html>