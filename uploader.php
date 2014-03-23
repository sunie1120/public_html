<?php
session_start();
/**
* Expecificacion: Fichero subir una imagen a la carpeta indicda.
* 
* @autor http://informatica.iessanclemente.net
* @version 1
* @date 13.01.2014
*/

$target_path = "Imagenes/";
$target_path = $target_path . basename( $_FILES['nuevaimagen']['name']);
 if(move_uploaded_file($_FILES['nuevaimagen']['tmp_name'], $target_path)) {
 echo "El archivo ". basename( $_FILES['nuevaimagen']['name']). " ha sido subido";
} else{
echo "Ha ocurrido un error, trate de nuevo!";
}



?>