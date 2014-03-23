<?php
session_start();
/**
 * FORMULARIO PARA ACCESO
 * Expecificacion: fichero con el formulario de acceso al aplicativo.
 * Formulario de logueo
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Formulario de acceso</title> 
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head> 

<body> 
	<center> 
		<form action="valida.php" method="post" name="valida"> 
			<fieldset> 
				<center> 
					<table> 
						<tr><td>Acceso para usuarios</td></tr> 
						<tr><td>Introduce tu usuario: </td><td><input name="user" class="text" size="20" type="text" id="user"></td></tr> 
						<tr><td>Introduce tu contrasena: </td><td><input name="contra" class="text" size="20" type="password" id="contra"></td></tr>
						<tr><td>
							<?php
							if (isset($_GET['error']) and !empty($_GET['error']))  //los parametros hay que cogerlos por get pq en valida.php  tenemos 'Location: acceso.php?error=1'
							{
								echo "Nombre de usuario o contrasena incorrecto.";
							}
							?>
						</td></tr>
						<tr><td><input name="enviar" type="submit" class="boton" value="Enviar"/> </td></tr> 
					</table> 
				</center> 
			</fieldset> 
		</form> 
	</center>
</body> 
</html>




