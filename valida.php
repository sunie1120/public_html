<?php
session_id();
session_start();
/**
 * Expecificacion: fichero que valida el formulario de acceso (acceso.php)
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 */
		
include ('funcions_bdd.php');


$user =htmlspecialchars($_POST['user']);			
if (preg_match('/[^A-Za-z0-9\\s]/', $user)){
	$user=preg_replace('/[^A-Za-z0-9\\s]/',"",$user);
}

$contra = htmlspecialchars($_POST['contra']);		
if (preg_match('/[^A-Za-z0-9\\s]/', $contra)){
	$contra=preg_replace('/[^A-Za-z0-9\\s]/',"",$contra);
}


$error_login= control_usuario($user,$contra,$rol);


	

if($error_login==0) {	
	$_SESSION['logeado'] = 1;
	$_SESSION['user'] = $user;
	$_SESSION['rol'] = $rol;
	
	switch($rol)
	{
	case 'RA':
	header('Location: gest_clients.php');
	case 'AS':
	header('Location: controlador_alta_servicios.php');
	break;
	case 'RS':
	header('Location: administrador_servicios.php');
	break;
	case 'C':
	@$id_usuario=buscar('id','usuaris','user_name',$user);  //saco el id de usuario qu enecesito para sacar el dni	        	  
	@$dni_usuario=buscar('dni','client','id_usuari',$id_usuario); //saco el dni del usuario para poder realizar la reserva
    @$_SESSION['dni']=$dni_usuario;
	header('Location: reserves_serveis.php');
	exit(); 
	}

}
else			
{
   
   header('Location: acceso.php?error=1');
   
   exit();
}
?>