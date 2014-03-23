<?php 
session_start();
/**
 * Formulario para modificar los datos del usuario (tabla usuaris y tabla client)
 * Expecificacion: este formulario recibe los datos existentes en la base de datos
 * para el que aparezcan por defecto en el formulario y sobre ellos se realizan los
 * cambios. Exceptuando la contraseña, que si se ha de modificar, se debe introducir
 * de nuevo, sino se mantiene la contraseña existente.
 * 
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 * @copyright 
 */

include ('funcions_bdd.php');
if ($_POST){
    @$id=$_POST['id'];
    @$usuario=buscar(user_name,usuaris, id, $id); //SELECT $columna from $tabla where $campo='$datocompara
    //@$contra=$_POST['contra'];
    @$DNI=buscar(dni,client, id_usuari, $id);
    @$nombre=buscar(nom_complert,client, id_usuari, $id);
    @$email=buscar(email,client, id_usuari, $id);
    @$telefono=buscar(telefon,client, id_usuari, $id);
    @$direccion=buscar(adreca_complerta,client, id_usuari, $id);
    @$habitacion=buscar(numero_hab,client, id_usuari, $id);
    $_SESSION['id_m']=$id;
     //echo "<br>id:" . $id.  "<br>us:" . $usuario.  "<br>con:" .$contrasenya. "<br>nom:" .$nombre. "<br>dni:" .$DNI. "<br>dir:" .$direccion. "<br>tel:" .$telefono. "<br>email:" .$email. "<br>hab:" .$habitacion;
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Modificacion Clients</title>
<link href="Zeo.css" rel="stylesheet" type="text/css"/> 
</head>

<body>
<p id="p"><?php echo "Bienvenido ".@$_SESSION['user'];?></p>
<form id="formulario" action="cerrar_sesion.php" method="post">
<input class ="boton" type="submit" value="Cerrar Sesi&oacute;n" name="tancar_ses"></input>
</form>
<center>
<fieldset width=750px ><legend align="center">
<h2>Formulario modificaci&oacute;n cliente</h2></legend>
    <form id="formulario" action="valida_actualiza_client.php" method="post">
	<input type="hidden" name="id" value="<?php $id?>">
	
 <table><tr>
         <td>Nombre de usuario*:</td><td><input type="text" name="usuari" value="<?php echo $usuario;?>" /></td></tr>
 <tr>
   <td>Contrase&ntilde;a:</td><td><input type="password" name="contrasenya"/></td></tr>
  <tr>
    <td>DNI*:</td><td><input type="text" name="DNI" value="<?php echo $DNI;?>"/></td></tr>
 <tr>
   <td>Nombre completo*:</td><td><input type="text" name="nombre" value="<?php echo $nombre;?>"/></td></tr>
 <tr><td>E-mail:</td><td><input type="text" name="email" value="<?php echo $email;?>"/></td></tr>
 <tr>
   <td>Telefono:</td><td><input type="text" name="telefono" value="<?php echo $telefono;?>"/></td></tr>
 <tr>
   <td>Direcci&oacute;n*:</td><td><input type="text" name="direccion" value="<?php echo $direccion;?>"/></td></tr>
 <tr>
   <td>N&uacute;mero de habitaci&oacute;n*:</td>
   <td><select name="habitacion">
           <option selected="selected"><?php echo $habitacion;?></option><!--para actualizar los datos del cliente añadir un if-->
           <?php
                
                $habitaciones=habitaciones_libres();
                for ($i=0;$i<count($habitaciones);$i++)
                {
                    echo "<option>".$habitaciones['$i']."</option>";
                }
           ?>
   </select></td>
 </tr>
 <tr><td><input class="boton" type="submit" width="20px" name="boton_envio" value="Enviar"></input></tr></td>
  </table>
            </form>
<p>
	<?php
		include ('errors.php');
		if (isset($_GET['error']) and !empty($_GET['error']))  
		{
			$msg=control_error_cliente($_GET['error']);
			echo $msg;
		}
    ?>
</p>


</fieldset>
</center>

<form id="formulario" action="gest_clients.php" method="post">
<input class="boton" type="submit" value="Volver" name="Volver" id="Volver"></input>
</form>
</body>
</html>


