<?phpsession_start();?>
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
* Expecificacion: Fichero que muestra las reservas por semana (desde el dia actual en adelante 6 días)
* 
* @autor Esther Herrero
* @version 1
* 
include('funcions_bdd.php');
$fecha=date("d/m/Y");//formato de fecha gregoriano
$hoy=date("Y-m-d");//formato de fecha anglosajon

for($i=0;$i<=7;$i++){
@$dia[$i]=cambiarfecha($fecha,$i);
$dia[$i]=cambiarFormatoFecha($dia[$i]);
echo $dia[$i].": ";
echo "<br>";
llistar_reserves_dia($dia[$i]);

echo "<br>";
}





?>
</center>			
</body> 
</html>