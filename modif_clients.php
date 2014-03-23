<?php
session_start();
/**
 * Expecificacion: fichero para escoger la accion a realizar sobre el usuario/cliente
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 */

include ('funcions_bdd.php');//INCLUYE EL ARCHIVO DE FUNCIONES
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Modificar Clientes</title>
<link href="Zeo.css" rel="stylesheet" type="text/css"/>
<style type="text/css"> 
fieldset{border:6px solid #80B1B7;border-radius:180px; background:#C0D9C9; width: 70%}
</style>
</head>

<body>
<!--CERRAR SESION -->
<p id="p"><?php echo "Bienvenido ".@$_SESSION['user'];?></p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input name="tancar_ses" type="submit" class="boton" value="Cerrar Sesi&oacute;n"></input>
</form>

<!--MODIFICAR/BORRAR -->
<center>
<fieldset width=750px><!--APERTURA fieldset--> 
<form id="formulario" action="#" method="post">
<h2>Listado de Clientes</h2> <!--TITULO-->
<input name="boton" type="submit" class="boton" value="Por nombre" ></input><!--OPCION 1: POR NOMBRE-->
<input name="boton" type="submit" class="boton" value="Todos los clientes" ></input> <!--OPCION 2: TODOS LOS CLIENTES-->
</form>


<!--ACCIONES SEGÚN EL BOTON-->
<?php
IF ($_REQUEST)
{
	switch (@$_REQUEST['boton'])
	{
            
/*-- Por nombre --*/           
	case "Por nombre": 
?>  
            <!--PEDIR NOMBRE-->
            <form id="nombre" action="#" method="get"> <!--TE ENVIA A LISTADO_CLIENTES.PHP-->
            <table>
            <tr><td>Intruduzca el nombre:  </td><td><input name="nombre" class="text" size="20" type="text" id="nombre"></td></tr>
            <tr><td><input name="enviar" type="submit" class="boton" value="Enviar"/> </td><td><input type="reset" name="reset" value="Limpiar" class="boton"/></td></tr>
            </table>
            </form>            
<?php

            
	break;

 /*-- Todos los clientes --*/    
        case "Todos los clientes": 

            /*-- MOSTRAR DATOS --*/
            $sql = "SELECT `id`,`nom_complert` AS `Nombre Completo` , `dni` AS `DNI` , `user_name` AS `Usuario` , `numero_hab` AS `Habitacion` , `adreca_complerta` AS `Direccion` , `telefon` AS `Telefono` , `email` AS `email` FROM `client` JOIN `usuaris` ON ( `id` = `id_usuari` ) ";
            lista($sql);
      
	break;
	}
        if(@$_REQUEST['enviar']){
            
    
    /*-- SANEAMOS LOS DATOS RECIBIDOS --*/ 
    if (isset($_GET['nombre']))
    { //SI HAY DATOS
        $nombre = trim(strip_tags($_GET['nombre'])); //SE SANEAN
    }
    else
    {
            $nombre = "";
    }
            
    //buscar_por_nombre($nombre);
    $sql="SELECT `id`,`nom_complert` AS `Nombre Completo` , `dni` AS `DNI` , `user_name` AS `Usuario` , `numero_hab` AS `Habitacion` , `adreca_complerta` AS `Direccion` , `telefon` AS `Telefono` , `email` AS `email` FROM `client` JOIN `usuaris` ON ( `id` = `id_usuari` ) WHERE UPPER(`nom_complert`) like UPPER(\"%$nombre%\")";
    lista($sql);
        }
}
?>

            
</fieldset><!--CIERRE fieldset-->
</center>

<!--VOLVER -->
<form id="formulario" action="gest_clients.php" method="post">
<input class="boton" type="submit" value="Volver" name="Volver" id="Volver"></input>
</form>

<!--ALTA NUEVA -->
<form id="alta" action="alta_clients.php" method="post">
<input class="boton" type="submit" value="Alta Nueva" name="Alta Nueva" id="Volver"></input>
</form>
</body>


</html>