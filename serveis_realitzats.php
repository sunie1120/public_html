<?php
session_start();
/**
 * Implementad la página
 * gestio_serveis.php (correspondiente al rol responsable de servicios) que permita
 * gestionar los servicios que ofrece el hotel realizando:
 * a.Las funciones básicas sobre servicios: 
 * añadir, eliminar y/o modificar servicios
 * b.Las funcionalidades básicas sobre tipos de servicios
 * c.Listar las reservas de servicios (por dia y/o semana) y modificar si se han
 * realizado o no*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Gesti&oacute;n de servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 
<body>
<center>
<?php
/**
* Expecificacion: Fichero que modifica si un servicio se ha realizado
* 
* @autor Esther Herrero
* @version 1
* @date 13.01.2014
*/
include('funcions_bdd.php');
$fecha=date("d/m/Y");//formato de fecha gregoriano
$hoy=date("Y-m-d");//formato de fecha anglosajon

for($i=0;$i<=7;$i++){
@$dia[$i]=decrementarDia($fecha,$i);
$dia[$i]=cambiarFormatoFecha($dia[$i]);
echo $dia[$i].": ";
echo "<br>";
cambiar_realizado_reserves($dia[$i]);

echo "<br>";



}
?>



</center>			
</body> 
</html>