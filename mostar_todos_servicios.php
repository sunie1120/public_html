<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Gesti&oacute;n de servicios</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 
<body>
<?php
/**
* Expecificacion: Fichero permite muestra todos los valores de la tabla serveis.
* 
* @autor Esther Herrero
* @version 1
* @date 13.01.2014
*/
include('funcions_bdd.php');

llistar_serveis();
?>
								
</body> 
</html>