<?php
session_start();
/**
 * Expecificación: Fichero que redirige al usuario, en función de la opción elegida
 * Las opciones serán dar de alta un usuario/cliente o modificar/baja de un cliente
 *  
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 */
 

IF ($_REQUEST)
{
	switch ($_REQUEST['boton'])
	{
	case "Alta": header('Location: alta_clients.php');
	break;
	case "Modificar/Baja": header('Location: modif_clients.php');
	break;
	}
}
?>
