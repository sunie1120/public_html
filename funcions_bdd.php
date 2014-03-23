<?php
/**
 * Especificacion:fichero de funciones con conexion a la base de datos
 * 
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */
include ('config.php');

/**
 * Especificacion: funciones generales y funciones de cliente
 * @author Olaia Fidalgo
 * @date 13.01.2014
 * @copyright 
 */
/**
 * Especificacion: Función que conecta con la base de datos
 * Función que conecta con la base de datos, utilizando las variables globales
 * de conexión incluidas en el archivo config.php. Devuelve la conexión inicializada.
 * 
 * @global String $dbHost
 * @global String $dbUser
 * @global String $dbPass
 * @global String $dbname
 * @return objeto $conexion
 *  
 * @author Olaia
 * @version 1
 * @copyright 
 */
function conectar_bdd(){

    global $dbHost,$dbUser,$dbPass,$dbname; // hay que indicar que las variables son globales(de  fuera)

    $conexion=mysql_connect($dbHost,$dbUser,$dbPass);

    if (!$conexion)
    {
        die('No es posible la conexion a la base de datos:'.mysql_error());
    }

    mysql_select_db($dbname,$conexion);

    return $conexion;

}


/**
 * Especificacion: Función para controlar los usuarios
 * Función que sirve para controlar que existe el usuario introducido, y que
 * además la contraseña introducida es la de dicho usuario. Si todo es correcto
 * nos devuelve un 0, si no es correcto nos devuelve un 1.
 * 
 * @param String $user
 * @param String $contra
 * @param String $rol
 * @return int $error
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function control_usuario($user,$contra,&$rol)
{
    $conex=conectar_bdd();
    $sql="SELECT * from usuaris where user_name='$user' and contrasenya=password('$contra')";
    $resultado=mysql_query($sql,$conex);
    $num_filas=mysql_num_rows($resultado);
    $error=0;
    
    if($fila=mysql_fetch_array($resultado, MYSQL_ASSOC))
    {
        $rol=$fila['rol'];
    }
    else
    {
        $error=1;
    }
    
    mysql_close($conex);
    
    return $error;	

}


/**
 * Especificacion: Función que comprueba la existencia de un dato dentro de la base de datos
 * Función que comprueba la existencia de un dato dentro de la base de datos
 * indicandole la tabla en la que hemos de buscar, el campo en el que se ha de
 * buscar y el dato que queremos comparar. Si encuentra resultado nos devuelve
 * un 0, si no encuentra resultado nos devuelve un 1.
 * 
 * @param String $tabla
 * @param String $campo
 * @param String $datobuscado
 * @return int $error
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function comprobar($tabla, $campo, $datobuscado)

{
    $conex=conectar_bdd();
    $resultado=mysql_query("SELECT * from $tabla where $campo='$datobuscado' ",$conex);
    $num_filas=mysql_num_rows($resultado);
    if($num_filas>0)
    {
        $error=0;//ha encontrado un resultado
    }
    else
    {
        $error=1;//no ha encontrado resultados
    }
    
    mysql_close($conex);
    
    return $error;	
    
}

/**
 * Especificacion: Funciónn que busca un dato dentro de una base de datos
 * Función que busca un dato concreto dentro de una base de datos, le indicamos
 * que buscamos ($columna), de que tabla ($tabla), donde el campo es igual al 
 * dato con el que queremos compararlo. Nos devuelve -1 si encuentra coincidencias
 * y si hay coincidencias nos devuelve dicho valor.
 * @param String $datobuscado
 * @param String $tabla
 * @param String $campo
 * @param String $datocompara
 * @return String $valor
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function buscar($columna,$tabla, $campo, $datocompara)
{   
    $conex=conectar_bdd();
    $resultado=mysql_query("SELECT $columna from $tabla where $campo='$datocompara' ",$conex);
    $num_filas=mysql_num_rows($resultado);
    if($num_filas<1)
    {
        $valor=-1;//Si no encuntra coincidencias	
    }
    else 
    {
        $arrayvalor=mysql_fetch_array($resultado);//guardamos el resultado de la busqueda en un array
        $valor=$arrayvalor[0];//sacamos del array el valor
    }
    
    mysql_close($conex);
    
    return $valor;//Devuelve el dato buscado	
}


/**
 * Especificacion: Función que devuelve una tabla de mysql en formato html
 * Función que devuelve una tabla de mysql en formato html, insertando dos
 * imagenes, una de modificar y otra de eliminar.
 * @param String $sql
 * @return String(tabla en formato html)
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function lista($sql)
{
 $conex = conectar_bdd();
 $resultado = mysql_query($sql,$conex);
 
 echo "<table>";
 echo "<tr>";
 
 echo "<th align='center'>id</th><th align='center'>Nombre Completo</th><th align='center'>DNI</th><th align='center'>Usuario</th><th align='center'>Habitacion</th><th align='center'>Direccion</th><th align='center'>Telefono</th><th align='center'>email</th><th align='center'>Modificar</th><th align='center'>Eliminar</th></tr>";
 
 while($row=mysql_fetch_array($resultado))
 {
    echo "<tr>";
    
    for($i=0;$i<mysql_num_fields($resultado);$i++)
    {
        echo "<td>".$row[$i]."</td>";
    }
   
    echo "<form id=\"$row[0]\" action=\"actualiza_client.php\" method=\"post\"><td width='50 px' align='center'><input type=\"hidden\" name=\"id\" value=\"$row[0]\"><button name=\"boton\" value=\"editar\" class=\"boton\"><image SRC=\"Imagenes/modificar.jpg\"  width=\"23\" height=\"23\" alt=\"eliminar\"></form></td>";
    echo "<form id=\"$row[0]\" action=\"borra_client.php\" method=\"post\"><td width='50 px' align='center'><input type=\"hidden\" name=\"id\" value=\"$row[0]\"><button name=\"boton\" value=\"borrar\" class=\"boton\"><image SRC=\"Imagenes/borrar.jpg\"  width=\"23\" height=\"23\" alt=\"eliminar\"></form></td>";
    
    echo "</tr>";
    
 }
 echo "</table>";
 mysql_close($conex);
}

/**
 * Especificacion: Función que inserta un usuario en una base de datos
 * Función se sirve para insertar un usuario nuevo dentro de la base de datos
 * usuaris. Este usuario siempre tendrá un ROL de CLIENTE. Si el usuario se crea
 * correctamente nos devuelve el id del usuario, si el usuario ya existe nos
 * nos devuelve un 0, y en caso de error nos devuelve -1.
 * @param String $user
 * @param String $contra
 * @return int $id
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function insert_usuario($user,$contra)
{
    $crear=comprobar("usuaris", 'user_name', $user);
    $id=0;//Este usuario ya existe en la base de datos
    $conex=conectar_bdd();
    if (($crear==1)&&($user!='')&&($contra!=''))
    {
        $query="INSERT INTO usuaris  VALUES (NULL,'$user', PASSWORD('$contra'), 'C')";
        $insertarUsu=mysql_query($query,$conex);
        if (!$insertarUsu)
        {
            //echo "error sentencia ". mysql_error();
            $id=-1;//Ha ocurrido un error, usuario no creado
        }
        else
        {
            $id=buscar('id','usuaris', 'user_name', $user);//El usuario se ha creado correctamente
        } 
    }
        
    mysql_close($conex);
    
    return $id;
}

/**
 * Especificacion: unción que inserta los datos de un nuevo cliente en una base de datos
 * Función que inserta el DNI, el nombre completo, el email, el telefono, la dirección
 * el número de habitación y el id de usuario dentro de la tabla client.
 * @param String $DNI
 * @param String $nom_complert
 * @param String $email
 * @param String $telefon
 * @param String $adreca
 * @param int $num_hab
 * @param int $id
 * @return int $error (0, si se ha realizado exitosamente, 1 si el usuario ya existe y 2
 * si ha ocurrido un error)
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function insert_cliente($DNI,$nom_complert,$email,$telefon,$adreca,$num_hab,$id)

{

    //Comprobaciones
    $comprobar=comprobar("client", 'dni', $DNI);//si existe ese dni en la BBD (si NO existe retorna 1)
    

    //Asignaciones a la variable error
    $error=0;//El usuario se ha creado correctamente
    if ($comprobar==0) $error=1;//El cliente ya existe
    
    if ($comprobar==1)
    {
        $conex=conectar_bdd();
        $query="INSERT INTO client  VALUES ('$DNI', '$id', '$nom_complert', '$email', '$telefon', '$adreca', '$num_hab')";
        $insertarCli=mysql_query($query,$conex);
        echo "error sentencia ". mysql_error();
        mysql_close($conex);

        if (!$insertarCli)
        {
            $error=2;//Ha ocurrido un error, usuario no creado
        }
        else    
        {
            $error=0;//El usuario se ha creado correctamente
        } 

    }

    return $error;

}

/**
 * Especificacion: Funcion que elimina un registro de la base de datos
 * Funcion que elimina un registro de la base de datos según el id de usuario 
 * pasado por parametro.
 * @param int $id
 * @return int $error (Devuelve 0 si todo es correcto y 1 si se ha producido un error)
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function eliminar_usuari($id){
 
    $conex=conectar_bdd();//Conectar a base de datos
    $sql="Delete From usuaris Where id='$id'";//Sentencia sql
    $resultado=mysql_query($sql);//ejecución
    $error=0;
    if (!$resultado){$error=1;}
}

/**
 * Especificacion: Funcion lista las habitaciones libres existentes
 * Funcion lista las habitaciones libres existentes y devuelve el codigo html
 * para imprimir de las opciones de un input select
 * @return string (codigo html para imprimir de las opciones de un input select)
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function habitaciones_libres()
{
    $conex=conectar_bdd();
    $sql="SELECT `habitacio`.`numero_hab`
        FROM `habitacio`
        LEFT JOIN `client` ON ( `habitacio`.`numero_hab` = `client`.`numero_hab` )
        WHERE `dni` IS NULL ";
    $resultado=  mysql_query($sql);
    while ($row=  mysql_fetch_array($resultado))
    {
        echo "<option value=".$row['0'].">".$row['0']."</option>";
    }
    mysql_close();
   
}
/* -----------------------------------------------funciones reservas_cliente ------------------------------------------------------*/
  /**  Autor: Zuzana Vadaszova
   * Fecha: 21.12.2013
   *Especificacion: funciones reservas_cliente
   */



     
/** Datos de entrada: ninguno
 * Datos de salida: cadena de carectres con todas las clases, si no hay clases devuelve una cadena vacia
 * Especificacion: guarda en una cadena de carecteres nombres de todas las clases que hay en la base de datos
 *  
 * @return String
 */
 function lista_clases() {   //saca todas las clases que hay por su nombre
 	$conex=conectar_bdd();

    $resultado=mysql_query("SELECT nom_class FROM classerveis",$conex);
     $clase="";

    while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {

	   	$clas=$fila[0];

	   	$clase=$clase. $clas . ",";

	   }
	if($clase=="")
	{
		$clase=0;  //no ha encontrado resultado
		
	}
	mysql_close($conex);
	
	return $clase;
 }


/** Datos de entrada: nombre de una clase
 * Datos de salida: si exite clase id, si no existe 0
 * Especificacion: Recibe nombre de una clase y la busca en la bdd y si esta devuelve su id, si no esta devuelve 0
 * 
 * @param string $nom_clase
 * @return int
 */

 function id_clase($nom_clase) {  //saca id de una clase determinada
 	$conex=conectar_bdd();

    
    
   $resultado=mysql_query("SELECT id_class FROM classerveis WHERE nom_class='$nom_clase'",$conex);
   
    if(!$resultado){

    	$id=0;
    }
	while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
     
     $id=$fila['id_class'];
	} 

	return $id;
 }  



/**
 * Datos de entrada: id de clase
 * Datos de salida: si no conecta con bdd devuelve -1, si encentra una cadena de caracteres con los servicios, si no encuentra servicios 0
 * Especificacion: Recib id de una clase y devuelve una cadena de caracteres que contiene los servicios de esa clase, encontrados en bdd
 * Si no encuentra ningun servicio devuelve 0.
 * 
 * @param string $id_c
 * @return string
 */
 function servicios_clases($id_c) {  //saca servicios de una clase determinada
 	$conex=conectar_bdd();

    $resultado=mysql_query("SELECT nom_servei FROM servei  WHERE id_class=$id_c" ,$conex);
     $servicio="";
      if(!$resultado){

    	$servicio=-1;
      }

    while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {

	   	$serv=$fila[0];

	   	$servicio=$servicio . $serv . ",";
	   }
	if($servicio=="")
	{
		$servicio=0;  //no ha encontrado resultado
		
	}
	mysql_close($conex);
	
	return $servicio;
 }


/**
 * Datos de entrada: nombre de servicio
 * Datos de salida: descripcion.si no puede conectar con bdd -1
 * Especificacion: Recibe nombre de un servicion y devuelve descripcion de este
 * 
 * @param string $nom
 * @return string
 */
 
 function descripcio_servei($nom){ //nos da descripcion de un servicio concreto
 	$conex=conectar_bdd();

    $resultado=mysql_query("SELECT descripcio FROM servei WHERE nom_servei ='$nom'",$conex);
     $descripcion="";
      if(!$resultado){

    	$descripcion=-1;
      }

    while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {

	   	$descripcion=$fila[0];

	   //	$descripcion=$descripcion . $desc . " ";
	   }
	if($descripcion=="")
	{
		$descripcion=0;  //no ha encontrado resultado
		
	}
	
    mysql_close($conex);
    return $descripcion;
 }

 
/**
 *  Datos de entrada: fecha que se quiere cambiar, numero de dias a incrementar
 *  Datos de salida: fecha modificada
 * Especificacion: cambia una fecha a otra incrementandole numero de dias determinado
 * 
 * @param date $fecha
 * @param int $dia
 * @return date
 */
 function cambiarFecha($fecha,$dia) { //cambia fecha del sistema
 

    list($day,$mon,$year) = explode('/',$fecha);
    $fecha_modificada= date('d/m/Y',mktime(0,0,0,$mon,$day+$dia,$year));
    return $fecha_modificada;     
 }


/**
 *  Datos de entrada: fecha de la que se quiere modificar el formato
 * Datos de salida: fecha modificada 
 * Especificacion: cambia el formato de una fecha en formato d/m/y a Y-m-d
 * 
 * @param date $fecha
 * @return date
 */
 function cambiarFormatoFecha($fecha){ 
    list($day,$mon,$year)=explode("/",$fecha); 
    return $year."-".$mon."-".$day; 
} 


/**
 *  Datos de entrada: fecha de la que se quiere modificar el formato
 * Datos de salida: fecha modificada 
 * Especificacion: cambia el formato de una fecha en formato  Y-m-d  a d/m/y 
 * 
 * @param date $fecha
 * @return date
 */
 
function cambiarFormatoFecha2($fecha){ 
    list($year,$mon,$day)=explode("-",$fecha); 
    return $day."/".$mon."/".$year; 
} 

/**
 * Datos de entrada: ninguno
 * Datos de salida: cadena con horas
 * Especificacion: saca todas las horas de inicio que hay en la tabla la franja
 * 
 * @return String
 */
 function lista_horas() {  
   	$conex=conectar_bdd();

    $resultado=mysql_query("SELECT hora_inici FROM franja",$conex);
    
        $horas="";

    	while ($fila=mysql_fetch_array($resultado,MYSQL_NUM)) {
    		$hora=$fila[0];
    		$horas=$horas . $hora . " ";
    	}

			if($horas==""){
					$horas=0;  //no ha encontrado resultado
		
			}
	    mysql_close($conex);
	
	    return $horas;
 }

/**
 * Datos de entrada: id_franja, fecha de reserva, id de servicio a reservar y dni del cliente que la realiza
 * Datos de salida: 1 si no se ha realizado y 0 si se ha realizado
 * Especificacion: realiza la reserva de un servicio devolviendo 0 si se ha hecho correctamente y 1 si no se ha hecho
 *
 * @return int
 */
function insert_reserva($id_franja,$data,$id_servei,$dni){

$conex=conectar_bdd();

  $query="INSERT INTO reserva  VALUES ('$id_franja','$data','$id_servei','$dni',0)";

	$insertarReserva=mysql_query($query,$conex);


	if (!$insertarReserva){
		$error=1;//Ha ocurrido un error
	}

	else
		$error=0;
mysql_close($conex);

return $error;

}

/**
  * Datos de entrada: dni del cliente
  * Datos de salida:informacion sobre las reservas de un cliente  en una cadena, si nohay resultado devuelve 0
  * Especificacion: saca toda la informacio de las reservas de un cliente
  * 
  * @param string $dni
  * @return string
  */
function reservas_cliente($dni) {   //saca todos los dias de reservas que tiene un client
 	$conex=conectar_bdd();

    $resultado=mysql_query("SELECT * FROM reserva WHERE dni_client='$dni' ORDER BY data,id_franja", $conex);
     $reservas="";
    

    while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {

	     
	   	$reserva=implode(" ", $fila);
	   	$reservas=$reservas . $reserva . "/";
   
	   }
	if($reservas=="")
	{
		$reservas=0;  //no ha encontrado resultado
		
	}
	mysql_close($conex);
	
	return $reservas;
 }

/**
 * Datos de entrada: fecha que se quiere cambiar, horas que se quieren decrementar
 * Datos de salida: fecha modificada
 * Especificacion: cambia la fecha quitandole horas.
 * 
 * @param date $fecha
 * @param string $hora
 * @return date
 */
function cambiarHora($fecha,$hora) { 
 
    $nuevafecha = strtotime ( '-' .  $hora . 'hour' , strtotime ($fecha)) ; 
    $nuevafecha = date ( 'Y/m/d G:i' , $nuevafecha );
    return $nuevafecha; 
 }


/**
 * Datos de entrada: id franja y fecha de la reserva a borrar
 * Datos de salida: error igual a 1 si no se puede anular, 0 si se podido anular, y 2 si ha ocurrido error inseperado
 * Especificacion: borra una reserva si no faltan menos de tres horas
 * 
 * @param string $id_franja
 * @param date $data
 * @return int
 */
function borrar_reserva ($id_franja, $data) {

  $hora_servicio=buscar('hora_inici','franja','id_franja', $id_franja);
  $fecha_c_servicio=$data . " " . $hora_servicio; //saco la fecha entera del servicio;
  $fecha_servicio_3=cambiarHora($fecha_c_servicio,3);  //le resto a la fecha del servicio 3 horas
  
  $fecha_sistema=date('d/m/Y G:i');
  $conex=conectar_bdd();

  $fecha_sistema=date('Y/m/d G:i');
  
  if(strtotime($fecha_servicio_3)<=strtotime($fecha_sistema)) {
  	$error=1;  //no es posible anular el servicio
  }
  else { 
  	   $query="DELETE FROM reserva WHERE id_franja='$id_franja' and data='$data'";
       $borrar=mysql_query($query, $conex);
        if($borrar) {
    	    $error=0; //se ha borrado correctamente
        }
	    if (!$borrar){
		  $error=2;//Ha ocurrido un error
	    }
}
  
mysql_close($conex);
return $error;
}

/**
 * Datos de entrada: id de franja y fecha del servicio reservado
 * Datos de salida: nombre del servicio reservado, si no lo encuentra devuelve 0
 * Especificacion: busca nombre de u servicio resevado en una fecha y una franja
 * 
 * @param string $id_franja
 * @param date $data
 * @return string
 */
function buscar_Nomservei($id_franja,$data){
 	  $conex=conectar_bdd();
 	  $resultado=mysql_query("SELECT id_servei FROM reserva WHERE id_franja='$id_franja' AND data='$data'", $conex);
      
      if(!$resultado){
    	$id=0;
    }
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
     
     $id=$fila[0];

     $nom=buscar('nom_servei','servei','id_servei', $id); 
    }

	mysql_close($conex);
    
    return $nom;
}

/**
 * Datos de entrada: id franja y fehca dela reserva a modificar
 * Datos de salida: error igual a 1 si no se puede modificar, y 0 si se puede
 * Especificacion: devuelve el resultado de comprobar si una reserva se puede modificar o no
 * 
 * @param string $id_franja
 * @param date $fecha
 * @return int
 */
function modificar_reserva ($id_franja, $fecha) {
  $hora_servicio=buscar('hora_inici','franja','id_franja', $id_franja);
  $fecha_c_servicio=$fecha . " " . $hora_servicio; //saco la fecha entera del servicio;
  $fecha_servicio_3=cambiarHora($fecha_c_servicio,3);  //le resto a la fecha del servicio 3 horas
  
  
  $conex=conectar_bdd();

  $fecha_sistema=date('Y/m/d G:i');
   
  if(strtotime($fecha_servicio_3)<=strtotime($fecha_sistema)) {
  	$error=1;  //no es posible anular el servicio
  }
  else { 

     $error=0;
}
  
mysql_close($conex);

return $error;
  
}


/**
 * Datos de entrada: fecha, id franja, nueva fecha y nueva franja
 * Datos de salida: error igual a 0 si se ha modificado , 1 si no 
 * Especificacion: modifica una reserva, cambiando la fecha y la franja.
 * 
 * @param date $fecha
 * @param int $franja
 * @param date $fecha_s
 * @param date $franja_s
 * @return int
 */
function modificar_res($fecha,$franja,$fecha_s,$franja_s) {
	   $conex=conectar_bdd();

  	   $query="UPDATE reserva SET data='$fecha',id_franja='$franja'  WHERE data='$fecha_s' AND id_franja='$franja_s' ";
       $modificar=mysql_query($query, $conex);
        if($modificar) {
    	    $error=0; //se ha modificado correctamente
        }
	    if (!$modificar){
		  $error=1;//Ha ocurrido un error
	    }

  
mysql_close($conex);

return $error;
}

/**
 * Datos de entrada: fecha y id franja
 * Datos de salida: realizado igual a -1 si no hay resultado y valor de realitzat si ha encontrado dato 
 * Especificacion: busca en una reserva si se ha realizado o no 
 * 
 * @param date $fecha
 * @param int $franja
 * @return int
 */
function servei_realizado($fecha,$franja) {

	$conex=conectar_bdd();
	$resultado=mysql_query("SELECT realitzat from reserva where id_franja='$franja' AND data='$fecha' ",$conex);
	
	if(!$resultado){
    	$realizado=-1;
    }
	while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
     
     $realizado=$fila[0];
    }

	mysql_close($conex);
    
    return $realizado;
}

/**
 * Datos de entrada: fecha y id de servicio
 * Datos de salida: franjas igual a 0 si no encintra resultado, y cadena con franjas si lo ha encontrado 
 * Especificacion: saca el id_franja de una reserva realizada en un dia concreto
 * 
 * @param date $data
 * @param int $id_servei
 * @return string
 */
function comprobar_reserva($data,$id_servei){
 	  $conex=conectar_bdd();

 	 $resultado=mysql_query("SELECT id_franja FROM reserva WHERE  data='$data' AND id_servei='$id_servei'", $conex);
    
        $franjas="";

    	while ($fila=mysql_fetch_array($resultado,MYSQL_NUM)) {
    		$franja=$fila[0];
    		$franjas=$franjas . $franja . " ";
    	}

			if($franjas==""){
					$franjas=0;  //no ha encontrado resultado
		
			}
	    mysql_close($conex);
	
	    return $franjas;
}

/*----FUNCIONES PARA LA GESTIÓN DE SERVICIOS----------------*/

/**
* Autor: Esther Herrero
* Fecha: 13.01.2014
* Especificacion: funciones generales para servicio y clase de servicios,y funciones de listado y modificación de reservas.
*/
 

 
 /*listar los servicios con todos sus datos*/
 
/**
* Especificacion: Función que lista los servicios
* Función que lista los servicios devolviendo todo los valores de cada uno de sus campos en la base de datos mediante "echo"
* No recibe parámetros de entrada
*  
* @author Esther Herrero
* @version 1
*/
 
 function llistar_serveis(){
 /*echo "Entra en llistar serveis";*/
 $conex=conectar_bdd();
 if (!$conex) echo mysql_error();
 else /*echo "Entra llistar serves, conexio correcta";*/
$sql="SELECT * from servei";
 
$listado_servicio=mysql_query($sql, $conex);/*ejecutas la query*/
if (!$listado_servicio){
echo"Ha ocurrido un error";//*a ocurrido un error */
}
else{
										
		echo "<center>";
			echo "<table>";
	while($fila=mysql_fetch_array($listado_servicio, MYSQL_ASSOC)){
										
											
	$nombre=$fila['nom_servei'];
	$id_servei=$fila['id_servei'];
	$id_class=$fila['id_class'];
	$descripcio=$fila['descripcio'];

										echo "<tr><td>Nombre: </td><td>$nombre</td></tr>";
										echo "<tr><td>Id del servicio: </td><td> $id_servei</td></tr>";
										echo "<tr><td>Id de la clase de servicio: </td><td> $id_class</td></tr>";
										echo "<tr><td>Descripci&oacute;n del servicio: </td><td>$descripcio</td></tr>";

	

										
	}
			echo "</table>";
		echo "</center>";
}

	
	
	mysql_close($conex);

	
 }
 /*Listar los servicios por conjuntos*/
 
 /**
* Especificacion: Función que lista las id de los seervicios
* No recibe parámetros de entrada y la salida la hace mediante echo.
*  
* @author Esther Herrero
* @version 1
*/
 
 //id de los servicios
 function llistar_id_serveis(){
   	$conex=conectar_bdd();
	$sql=("SELECT id_servei, nom_servei from servei");
	$listado_id_servicio=mysql_query($sql,$conex);
	if (!$listado_id_servicio){
	echo"Ha ocurrido un error";//Ha ocurrido un error 
	}else{
		$cont=0;
				
while($fila=mysql_fetch_array($listado_id_servicio, MYSQL_ASSOC)){
										
											
	$id_servei=$fila['id_servei'];
	$nombre=$fila['nom_servei'];

			
								echo "<center>";
									echo "<table>";
										echo "<tr><td>Nombre: </td><td>$id_servei</td></tr>";
										echo "<tr><td>Nombre del servicio: </td><td>$nombre</td></tr>";
										echo "<p></p>";
									echo "</table>";
								echo "</center>";				
	}
}
		mysql_close($conex);
	

 }
 
 
/*id de la clase del servicio */

/**
* Especificacion: Función que lista las id de las clases de los servicios desde la taba de serveis
* No recibe parámetros de entrada y la salida la hace mediante echo.
*  
* @author Esther Herrero
* @version 1
*/
 
  function llistar_id_clase_servei(){
   	$conex=conectar_bdd();
	$sql=("SELECT id_class, nom_servei from servei");
	$listado_id_clase_servicio=mysql_query($sql,$conex);
	if (!$listado_id_clase_servicio){
	echo"Ha ocurrido un error";//Ha ocurrido un error 
	}else{

		while($fila=mysql_fetch_array($listado_id_clase_servicio, MYSQL_ASSOC)){
										
											
	$id_class=$fila['id_class'];
	$nombre=$fila['nom_servei'];

			
								echo "<center>";
									echo "<table>";
										echo "<tr><td>Id de la clase de servicio: </td><td>$id_class</td></tr>";
										echo "<tr><td>Nombre del servicio: </td><td>$nombre</td></tr>";
										echo"<p></p>";
									echo "</table>";
								echo "</center>";				
	}
	}
		mysql_close($conex);
	

 
 }
 /*descripcion de los servicios*/
 
 /**
* Especificacion: Función que lista las descripciones de los servicios
* No recibe parámetros de entrada y la salida la hace mediante echo.
*  
*  
* @author Esther Herrero
* @version 1
*/
 
   function llistar_descripcio_servei(){
   
   
   $conex=conectar_bdd();
   $sql=("SELECT descripcio, nom_servei from servei");
	$listado_descripcio_servei=mysql_query( $sql,$conex);
		if (!$listado_descripcio_servei){
	echo"Ha ocurrido un error";/*Ha ocurrido un error */
	}
	
	while($fila=mysql_fetch_array($listado_descripcio_servei, MYSQL_ASSOC)){
										
											
	$descripcio=$fila['descripcio'];
	$nombre=$fila['nom_servei'];

			
								echo "<center>";
									echo "<table>";
										echo "<tr><td>Descripcion del servicio: </td><td>$descripcio</td></tr>";
										echo "<tr><td>Nombre del servicio: </td><td>$nombre</td></tr>";
										echo"<p></p>";
									echo "</table>";
								echo "</center>";				
	}							
	
		mysql_close($conex);
	

 
 
 }
 /*listar los nombres de los servicios*/
 
 /**
* Especificacion: Función que lista los nombres de los servicios 
* No recibe parámetros de entrada y la salida la hace mediante echo.
*
* @author  Esther Herrero
* @version 1
*/
 
    function llistar_nom_servei(){
   	$conex=conectar_bdd();
	$sql=("SELECT nom_servei from servei");
	$listado_nom_servei=mysql_query($sql,$conex);
	if (!$listado_nom_servei){
	echo"Ha ocurrido un error";//Ha ocurrido un error 
	}
	
	
										
	while($fila=mysql_fetch_array($listado_nom_servei, MYSQL_ASSOC)){
										
											
	$nombre=$fila['nom_servei'];

			
								echo "<center>";
									echo "<table>";
										echo "<tr><td>Nombre: </td><td>$nombre</td></tr>";
									echo "</table>";
								echo "</center>";
										
	}
		mysql_close($conex);
	
 
 
 }


  
 
 
/*eliminar servicios*/

/**
* Especificacion: Función que elinima los servicios especificados de la tabla serveis
* 
* @param String $nomservei
* @param String $id_servei
* @return String $msn
*  
* @author Esther Herrero
* @version 1
*/
function elimina_servei($nomservei, $id_servei){
	$conex=conectar_bdd();
	$sql=("DELETE FROM servei WHERE id_servei='$id_servei' AND nom_servei='$nomservei'");
		
	$eliminado=mysql_query($sql,$conex);
	$msn="Servicio eliminado";
	mysql_close($conex);

	return $msn;
}
/*modificar servicios:*/

/**
* Especificacion: Función que modifica los datos de la tabla serveis
* 
* @param int $id_servei
* @param String $nuevonombre
* @param String $nuevadescripcion
* @param int $nueva_idclass
* @return String $msn
*  
* @author Esther Herrero
* @version 1
*/

function modifica_servei($id_servei,$nuevonombre,$nuevadescripcion,$nueva_idclass){
   	$conex=conectar_bdd();
	$sql=("UPDATE servei SET nom_servei='$nuevonombre',descripcio='$nuevadescripcion',id_class='$nueva_idclass' WHERE id_servei='$id_servei'");
	$modificaservei=mysql_query($sql,$conex);
	if($modificaservei) {
		$msn="Servicio modificado";
	}
	else $msn="error";
	
	mysql_close($conex);
	
	return $msn;
}

/*añadir servicios*/

/**
* Especificacion: Función que añade servicios a la tabla serveis
* 
* @param int $nuevaid_servei
* @param String $nuevonombre
* @param String $nuevadescripcion
* @param int $nueva_idclass
* @return String $msn
*  
* @author Esther Herrero
* @version 1
*/

function anyadeservei($nuevaid_servei,$nuevonombre,$nuevadescripcion,$nueva_idclass){

	$conex=conectar_bdd();
	$sql=("INSERT INTO `servei`(`id_servei`, `nom_servei`, `descripcio`, `id_class`) VALUES ('$nuevaid_servei','$nuevonombre','$nuevadescripcion','$nueva_idclass')");
	$anyadeservei=mysql_query($sql ,$conex);
	$msg="Servicio añadido";
	mysql_close($conex);
	return $msg;
}
/*FUNCIONES PARA LAS CLASES DE LOS SERVICIOS*/
/*listar en conjunto*/

/**
* Especificacion: Función quelista todos los datos de la tabla classerveis
* 
* No recibe parámetros de entrada y la salida la hace mediante echo
*  
* @author Esther Herrero
* @version 1
*/



 function llistar_class(){
 $conex=conectar_bdd();

$sql=("SELECT * from classerveis");
@$listado_class=mysql_query($sql, $conex);
if (!$listado_class){
echo"Ha ocurrido un error";/*Ha ocurrido un error */
}else{
									echo "<center>";
										echo "<table>";
										
				while($fila=mysql_fetch_array($listado_class, MYSQL_ASSOC)){
													
				$nombre=$fila['nom_class'];
				$id_class=$fila['id_class'];
				$imatge=$fila['imatge'];

													echo "<tr><td>Nombre: </td><td>$nombre</td></tr>";
													echo "<tr><td>Id del servicio: </td><td>$id_class</td></tr>";
													echo "<tr><td>Id de la clase de servicio: </td><td>nom_imatge</td></tr>";

				}

										echo "</table>";
									echo "</center>";
		}
	mysql_close($conex);

 }
/*listar por campos:*/
/*llistar per nom:*/


/**
* Especificacion: Función que lista todos los nombres de clase de la tabla classerveis
* 
* No recibe parámetros de entrada y la salida la hace mediante echo
*  
* @author Esther Herrero
* @version 1
*/
 function llistar_nom_class(){
   	$conex=conectar_bdd();
	$sql=("SELECT nom_class from classerveis");
	$listado_nom_class=mysql_query($sql,$conex);
	if (!$listado_nom_class){
	echo"Ha ocurrido un error";/*Ha ocurrido un error */
	}
		$cont=0;
	while($arraylistado=mysql_fetch_array($listado_nom_class, MYSQL_ASSOC)){
										
	
	$nom_class=$arraylistado['nom_class'];

								echo "<center>";
									echo "<table>";
										echo "<tr><td>Nombre: </td><td><".$nom_class."</td></tr>";
									echo "</table>";
								echo "</center>";			
	}
		mysql_close($conex);
	

 
 
 }
 
 /*llistar per id:*/
 
/**
* Especificacion: Función que lista tods las id de clase de la tabla classerveis
* 
* No recibe parámetros de entrada
* @return array $arrayreturn
*  
* @author Esther Herrero
* @version 1
*/
 
  function llistar_id_class(){
   	$conex=conectar_bdd();
	$listado_id_class=mysql_query("SELECT id_class, nom_class from classerveis",$conex);
	if (!$listado_id_class){
	echo"Ha ocurrido un error";/*Ha ocurrido un error */
	}
		$cont=0;
	while($arraylistado=mysql_fetch_array($listado_id_class, MYSQL_ASSOC)){
										
	
	$id_class=$arraylistado['id_class'];
	$arrayreturn[$cont] = $id_class;
	$cont++;
										
	}
		mysql_close($conex);
	
	return $arrayreturn;
 }
 
 /*recuperar imatges:*/
 
/**
* Especificacion: Función que recupera las imágenes de la tabla classerveis
* 
* No recibe parámetros de entrada
* @return array $arrayreturn
*  
* @author Esther Herrero
* @version 1
*/
 
 function recuperar_imatge(){
   	$conex=conectar_bdd();
	$listado_imatge=mysql_query("SELECT imatge from classervei",$conex);
	if (!$listado_imatge){
	echo"Ha ocurrido un error";//Ha ocurrido un error 
	}
		$cont=0;
	while($arraylistado=mysql_fetch_array($listado_imatge, MYSQL_ASSOC)){
										
	
	$imatge=$arraylistado['imatge'];
	$arrayreturn[$cont] = $imatge;
	$cont++;
										
	}
		mysql_close($conex);
	
	return $arrayreturn;
 }

   
 
 
/*eliminar class:*/

/**
* Especificacion: Función que elimina clases de la tabla classerveis
* Devuelve un valor numérico que indica si se ha elinimado alguna fila  o false si no se ha eliminado
* @param int $id_class
* @param String $nom_class
* @return array $numero_filas_eliminadas
*  
* @author Esther Herrero
* @version 1
*/

function elimina_class($id_class, $nom_class){
	$conex=conectar_bdd();
	$sql=("DELETE FROM classerveis WHERE id_class='$id_class' AND nom_class='$nom_class'");
	$eliminado=mysql_query($sql,$conex);
	
	
	@$numero_filas_eliminadas=mysql_num_rows($eliminado);
	mysql_close($conex);

	return $numero_filas_eliminadas;
}
/*modificar servicios:*/

/**
* Especificacion: Función que modifica clases de la tabla classerveis
* Devuelve un mensaje de aviso
* @param int $id_class
* @param String $nuevonombre
* @param String $nuevaimagen
* @return array $msn
*  
* @author Esther Herrero
* @version 1
*/





function modifica_class($id_class,$nuevonombre,$nuevaimagen){
   	$conex=conectar_bdd();
	$sql=("UPDATE classerveis SET nom_class='$nuevonombre', imagen='$nuevaimagen' WHERE id_class='$id_class'");
	$modificaclass=mysql_query($sql,$conex);

	if($modificaclass) {
		$msn="Clase de Servicio modificada";
	}
	else {$msn="error";};
	

	mysql_close($conex);

	return $msn;
}

/*añadir clases*/

/**
* Especificacion: Función que añade clases a la tabla classerveis
*
* Devuelve un mensaje de aviso
* @param int $nuevaid_class
* @param String $nuevonombre
* @param String $imagen
* @return array $msn
*  
* @author Esther Herrero
* @version 1
*/





function anyadeclass($nuevaid_class,$nuevonombre,$imagen){

	$conex=conectar_bdd();
	$sql=("INSERT INTO classerveis(id_class, nom_clas, imatge) VALUES ('$nuevaid_class','$nuevonombre','$nuevaimagen')");
	$anyadeclass=mysql_query($sql,$conex);
	$msg="Clase de servicio añadida";
	
	mysql_close($conex);
	return $msg;
}
 
 
 
/*FUNCIONES PARA LAS RESERVAS DE LOS SERVICIOS*/

/**
* Especificacion: Función que lista todas las reservas del día indicado desde el documento php
*
* @param data $hoy
* Hace la salida mediante echo
*  
* @author Esther Herrero
* @version 1
*/

 function llistar_reserves_dia($hoy){/*LISTA LAS RESERVAS DEL DÍA INDICADO*/
 
   	$conex=conectar_bdd();
	$sql=("SELECT * from reserva where data='$hoy'");
	$consulta_reserva=mysql_query($sql,$conex);
	
		$filas=mysql_num_rows($consulta_reserva);
		
		if($filas<1){
				echo "No hay reservas";
				
		}

	else{
									echo "<center>";
										echo "<table>";
			while($fila=mysql_fetch_array($consulta_reserva, MYSQL_ASSOC)){
										
											
	$id_franja=$fila['id_franja'];
	$data=$fila['data'];
	$id_servei=$fila['id_servei'];
	$dni_client=$fila['dni_client'];
	$realitzat=$fila['realitzat'];

	if($realitzat=0){/*no esta realizado*/
	   $no_realizado="Si";
	}else{$no_realizado="No";}

			
								echo "<center>";
									echo "<table>";
									echo "<tr><td>Id de la franja horaria: </td><td>$id_franja</td></tr>";
									echo "<tr><td>Fecha: </td><td>$data</td></tr>";
									echo "<tr><td>Id de servicio: </td><td>$id_servei</td></tr>";
									echo "<tr><td>DNI del cliente: </td><td>$dni_client</td></tr>";
									echo "<tr><td>Realizado: </td><td>$no_realizado</td></tr>";
									
									
									echo"__________________________________________**_______________________________________";
							
										
	}
										echo "</table>";
								echo "</center>";
	}

	mysql_close($conex);


}


function llistar_reserves_dia_js($hoy){/*LISTA LAS RESERVAS DEL DÍA INDICADO*/
 
   	$conex=conectar_bdd();
        $servicio='07';
	$sql = "SELECT hora_inici, nom_complert FROM `reserva` natural join franja join client ON ( dni_client = dni ) WHERE `data` = '$hoy' AND `id_servei` = '$servicio' AND `realitzat` =0";
	$consulta_reserva=mysql_query($sql,$conex);
	
		$filas=mysql_num_rows($consulta_reserva);
		
		if($filas<1){
				echo "No hay reservas";
				
		}

	else{
									
			while($fila=mysql_fetch_array($consulta_reserva, MYSQL_ASSOC)){
										
											
	$hora=$fila['hora_inici'];
	$nombre=$fila['nom_complert'];
	

	if($realitzat=0){/*no esta realizado*/
	   $no_realizado="Si";
	}else{$no_realizado="No";}

        echo "<div class=\"izquierdo1_3 personas\"><img src=\"imagenes/persona.jpg\" width=\"200\" height=\"116\" alt=\"persona\"/><p width=\"200\">".$hora." ".$nombre."</p></div>";
        
	}
										
	}

	mysql_close($conex);


}
function total_servicios_hoy($hoy){/*LISTA LAS RESERVAS DEL DÍA INDICADO*/
 
   	$conex=conectar_bdd();
        $servicio='07';
	//Total de pendientes
        $sql = "SELECT hora_inici, nom_complert FROM `reserva` natural join franja join client ON ( dni_client = dni ) WHERE `data` = '$hoy' AND `id_servei` = '$servicio' AND `realitzat` =0";
	$consulta_reserva=mysql_query($sql,$conex);
        $pendientes=mysql_num_rows($consulta_reserva);
        //Total de realizados
        $sql = "SELECT hora_inici, nom_complert FROM `reserva` natural join franja join client ON ( dni_client = dni ) WHERE `data` = '$hoy' AND `id_servei` = '$servicio' AND `realitzat` =1";
	$consulta_reserva=mysql_query($sql,$conex);
        $realizados=mysql_num_rows($consulta_reserva);
        echo"<p class=\"margen_izquierdo\">Servicios Realizados hoy: <b>".$realizados."</b></p>";
        echo"<p class=\"margen_izquierdo\">Servicios Pendientes para hoy: <b>".$pendientes."</b></p>";
	mysql_close($conex);


}	
	

/*modificar si el servicio ya se ha realizado o no se ha realizado*/

/**
* Especificacion: Función que modifica las  reservas de los servicios indicando si se han realizado o no
* Devuelve un mensaje de aviso
* @param int $id_servei
* @param data $data
* @param String $dni_client
* @param int $id_franja
* @param int $realizada
* @return $realizada_modificacion
*  
* @author Esther Herrero
* @version 1
*/

function modifica_reserves_serveis($id_servei,$data,$dni_client,$id_franja,$realizada){
$valido=comparar_fechas($data);

	if($valido=1){/*controlamos que no se modifiquen servicios de fechas posteriores al dia actual*/
		echo "No podemos modificar a realizadas las reservas con fecha posterior al dia de hoy";
	}else{
		echo "Podemos modificar si este servicio ha sido realizado.";


			$conex=conectar_bdd();

			if($data)

			$modificacion=mysql_query("UPDATE 'reserva' SET 'realitzat'=[$realizada] where 'id_franja'=[$id_franja],'data'=[$data],'id_servei'=[$id_servei],'dni_client'=[$dni_client] ",$conex);

			if(!$modificacion){
			$realizada_modificacion="No se ha podido realizar la modificaci&oacute;n.";

			}else{
			$realizada_modificacion="Modificaci&oacute;n realizada correctamente.";
			}

		mysql_close($conex);
	}
return $realizada_modificacion;
}


/*funcion para comparar*/

/**
* Especificacion: Función para comparar si se quiere moficar un servicio que aun no ha tenido lugar
* Devuelve un mensaje de aviso
*
* @param data $data
*
* @return $dia_valido
*  
* @author Esther Herrero
* @version 1
*/

function comparar_fechas($data){
	 
	$hoy=(strtotime('now'));
	$data=(strtotime($data));
	if($hoy<$data){
	$dia_valido=1;
	
	}else{
	$dia_valido=0;
	}
	
return $dia_valido;
}





/**Decrementa el dia*/

/**
* Especificacion: Función que decrementa e día par aasí poder scar por pantalla una semana entera asada y mdificar si 
* si han realizado o no esos servicios.
* Hace la salida por echo
* 
* @param data $fecha
* @param data $dia
*
* 
*  
* @author Esther Herrero
* @version 1
*/

 
 function decrementarDia($fecha,$dia) { /*cambia fecha del sistema*/
    
    list($day,$mon,$year) = explode('/',$fecha);
    $fecha_modificada= date('d/m/Y',mktime(0,0,0,$mon,$day-$dia,$year));
    return $fecha_modificada;     
 }
 
 
  function cambiar_realizado_reserves($hoy){/*LISTA LAS RESERVAS DEL DÍA INDICADO*/
 
   	$conex=conectar_bdd();
	$sql=("SELECT * from reserva where data='$hoy'");
	$consulta_reserva=mysql_query($sql,$conex);
	
		$filas=mysql_num_rows($consulta_reserva);
		
		if($filas<1){
				echo "No hay reservas";
				
		}

	else{
									echo "<center>";
										echo "<table>";
			while($fila=mysql_fetch_array($consulta_reserva, MYSQL_ASSOC)){
										
											
	$id_franja=$fila['id_franja'];
	$data=$fila['data'];
	$id_servei=$fila['id_servei'];
	$dni_client=$fila['dni_client'];
	$realitzat=$fila['realitzat'];

	if($realitzat=0){/*no esta realizado*/
	   $no_realizado="No";
	}else{$no_realizado="Si";}

			
								echo "<center>";
									echo "<table>";
									echo "<tr><td>Id de la franja horaria: </td><td>$id_franja</td></tr>";
									echo "<tr><td>Fecha: </td><td>$data</td></tr>";
									echo "<tr><td>Id de servicio: </td><td>$id_servei</td></tr>";
									echo "<tr><td>DNI del cliente: </td><td>$dni_client</td></tr>";
									echo "<tr><td>			
									Realizado o no: </td><td>
									<form action='#'>
							
							<select name='reserva'>
							<option  value='Si'> Si </option>
							<option  value='No'> No </option>
							</select>
							</form>	
									
									</td></tr>";
									
											echo '<form action="#" method="post">';
		echo '<input type="submit"  value="Cambiar servicio" name="realizado"/>';
		echo '</form>';
		
		if($_POST) {
		
		@$realitzat=($_POST['reserva']);
		if($realitzat=='Si') {
			$modificado=modifica_realizado($id_franja,$data);
		}
		
		
		
									echo"__________________________________________**_______________________________________";
							
										
	}
										echo "</table>";
								echo "</center>";
	}
}
	mysql_close($conex);
 

}
/*Subir_fichero*/
/**
 * 
 * Sube una imagen al servidor  en el directorio especificado teniendo el Atributo 'Name' del campo archivo.
 *
 * @param String $directorio_destino 
 * @param String $nombre_fichero (viene dado por el propio archivo)
 * @return boolean
 * @autor http://informatica.iessanclemente.net
 */
function subir_fichero($directorio_destino, $nombre_fichero)
{

    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
    {
        $img_file = $_FILES[$nombre_fichero]['name'];
        $img_type = $_FILES[$nombre_fichero]['type'];
        echo 1;
        // Si se trata de una imagen   
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
 strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            echo 2;
            if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file))
            {
                return true;
            }
        }
    }
    //Si llegamos hasta aquí es que algo ha fallado
    return false;
}

/**
 * subir_fichero()
 *
 * Sube una imagen al servidor  en el directorio especificado teniendo el Atributo 'Name' del campo archivo.
 * Devuelve un mensaje de aviso
 *
 * @param int $franja 
 * @param data $data (viene dado por el propio archivo)
 * @return $msn
 * @autor Zuzana Vadaslova, Esther Herrero
 */

function modifica_realizado($franja,$data){
   	$conex=conectar_bdd();
	$sql=("UPDATE reserva SET realitzat=1, imagen='$nuevaimagen' WHERE id_franja='$franja' AND data='$data'");
	$modificaclass=mysql_query($sql,$conex);

	if($modificaclass) {
		$msn=1;
	}
	else $msn=0;
	

	mysql_close($conex);

	return $msn;
}
?>