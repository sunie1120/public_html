<?php
/** 
 * Expecificacion: Fichero con codigos de error para el registro de datos de los usuaris/client
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */

function control_error_cliente($codigo_error)
{
    $msg="";
    switch ($codigo_error){
        case 1: $msg="<div id=\"error\">Debe elegir una habitacion</p></div>";break;
        case 2: $msg="<div id=\"error\">No han rellenado todos los campos marcados con *</div>";break;
        case 3: $msg="<div id=\"error\">DNI no valido</div>";break;
        case 4: $msg="<div id=\"error\">Has introducido caracteres incorrectos. Solo se admiten letras y números.</div>";break;
        case 5: $msg="<div id=\"error\">El mail es incorrecto</div>";break;
        case 6: $msg="<div id=\"error\">Telefono incorrecto</div>";break;
        case 7: $msg="<div id=\"error\">Este usuario ya existe en la base de datos</div>"; break;
        case 8: $msg="<div id=\"error\">Ha ocurrido un error</div>";break;
        case 9: $msg="<div id=\"error\">El DNI ya existe en la base de datos</div>";break;
	case 10: $msg="<div id=\"error\">Solo se pueden introducir letras y numeros</div>";break;
	case 11: $msg="<div id=\"error\">La contrase&ntilde;a ha de tener una longitud entre 6 y 12 caracteres</div>";break;
    }
    return $msg;
}
?>