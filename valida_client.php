<?php 
session_start();
/*
 * Expecificación: Fichero que valida el formulario de alta_client.php
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 */

include ('funcions_comprobar.php');
include ('funcions_bdd.php');

    /*--USUARIO--*/
	$usuari =trim(htmlspecialchars($_POST['usuari']));
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9]/', $usuari)){
                    header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
                    exit();
		}
                /*--COMPROBAR QUE HAYA DATOS--*/	
		if ($usuari==""){
                    header('Location: alta_clients.php?error=2');//No se han rellenado todos los campos marcados con *
                    exit();
		}
     /*--CONTRASEÑA--*/
	$contrasenya =trim(htmlspecialchars($_POST['contrasenya']));
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9\\s]/', $contrasenya)){
                    header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
                    exit();
		}
                /*--COMPROBAR QUE HAYA DATOS--*/	
		if ($contrasenya==""){
                    header('Location: alta_clients.php?error=2');//No se han rellenado todos los campos marcados con *
                    exit();
		}           
                /*--COMPROBAR EL TAMAÑO--*/	
		if ((strlen($contrasenya)<6)||(strlen($contrasenya)>12)){
                    header('Location: alta_clients.php?error=11');//No se han rellenado todos los campos marcados con *
                    exit(); 
                }
    /*--DNI--*/
	$DNI =trim(htmlspecialchars($_POST['DNI']));
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9]/', $DNI)){
                    header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
                    exit();
		}
                /*--COMPROBAR QUE HAYA DATOS--*/	
		if ($DNI==""){
                    header('Location: alta_clients.php?error=2');//No se han rellenado todos los campos marcados con *
                    exit();
		}           
                /*--COMPROBAR SI ES UN DNI VALIDO--*/
                $valido=  DNI_valido($DNI);
		if ($valido==FALSE){
                   header('Location: alta_clients.php?error=3');//DNI NO valido
                   exit(); 
                }
   /*--NOMBRE--*/
	$nombre =trim(htmlspecialchars($_POST['nombre']));
        
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9\\s]/', $nombre)){
                    header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
                    
                    exit();
		}
                /*--COMPROBAR QUE HAYA DATOS--*/	
		if ($nombre==""){
                    header('Location: alta_clients.php?error=2');//No se han rellenado todos los campos marcados con *
                    
                    exit();
		} 
 
    /*--EMAIL--*/
       if ($_POST['email']){
           $email =trim(htmlspecialchars($_POST['email']));

           /*--LIMPIAR DATOS--*/	
           if (preg_match('/[^A-Za-z0-9@._-]/', $email)){
               header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
               exit();
           }

           /*--COMPROBAR SI ES UN EMAIL VALIDO--*/
           $valido=mail_correcto($email);

           if (!$valido==TRUE){
               header('Location: alta_clients.php?error=5');//mail NO valido
               exit(); 
           }


       }	
       else{

           $email=NULL;//Si no se ha introducido nada email será null (campo no obligatorio)

       }

   /*--TELEFONO--*/
       if ($_POST['telefono']){
           $telefono =trim(htmlspecialchars($_POST['telefono']));

           /*--LIMPIAR DATOS--*/	
           if (preg_match('/[^A-Za-z0-9@._-]/', $telefono)){
               header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
               exit();
           }
           if($telefono=""){
               $telefono=NULL;//Si no se ha introducido nada telefono será null (campo no obligatorio)
           }
           /*--COMPROBAR SI ES UN TELEFONO VALIDO--*/
           $valido=telefono_correcto($telefono);

           if (!$valido==TRUE){
               header('Location: alta_clients.php?error=6');//telefono NO valido
               exit(); 
           }
    }	
    else{
        
        $telefono=NULL;//Si no se ha introducido nada telefono será null (campo no obligatorio)
       
    }
    
    /*--DIRECCION--*/
    //NO RECONOCE UNA DIRECCION CON º Y ª
            $direccion =trim(htmlspecialchars($_POST['direccion']));
            
                    /*--LIMPIAR DATOS--*/	
                    if (preg_match('/[^A-Za-z0-9ºª-,.\\s]/', $direccion)){
                        header('Location: alta_clients.php?error=10');//Sólo se pueden introducir letras y números
                        exit();
                    }
                    /*--COMPROBAR QUE HAYA DATOS--*/	
                    if ($direccion==""){
                        header('Location: alta_clients.php?error=2');//No se han rellenado todos los campos marcados con *
                        exit();
                    }
    /*--HABITACION--*/               
            $habitacion =$_POST['habitacion'];
            
            if ($haticion=='disponibles'){
                
               header('Location: alta_clients.php?error=1');//No se escogido habitacion
                        exit(); 
            }

            
/*------------------------------------------------------------------------------------------------------------------------------*/
            
            
    /*--INSERTAR USUARIOS--*/ 
    @$id=insert_usuario($usuari,$contrasenya);
    echo "id ".$id;
    if ($id==0)
    {
        header('Location: alta_clients.php?error=7');//Este usuario ya existe en la base de datos
        exit(); 
    }
    else if($id==-1)
    {
        header('Location: alta_clients.php?error=8');//Ha ocurrido un error
        exit(); 
    }
    else if($id>0)
    {
        // Si se crea correctamente el usuario
        /*--INSERTAR CLIENTE--*/ 
        @$creacioncli=insert_cliente($DNI,$nombre,$email,$telefono,$direccion,$habitacion,$id);
            
        if ($creacioncli==1)
        {
            header('Location: alta_clients.php?error=9');//El DNI ya existe en la base de datos
                exit();
        }
        
        if($creacioncli==2)
        {
            header('Location: alta_clients.php?error=8');//Ha ocurrido un error
            exit(); 
        }
        if($creacioncli==0)
        {
            header('Location: cliente_creado.php');//Cliente creado correctamente
            exit(); 
        }
    }

else
{
	header('Location: alta_clients.php?error=1');
	exit();
}

?>