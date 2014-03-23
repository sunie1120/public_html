<?php 
session_start();
/**
 * Expecificacion: Fichero que valida el formulario actualiza_client.php
 * 
 * @author Olaia Fidalgo
 * @version 1
 * @date 13.01.2014
 */

include ('funcions_comprobar.php');
include ('funcions_bdd.php');
if ($_POST){
    /*--ID--*/
	$id = $_SESSION['id_m'];
    /*--USUARIO--*/
	$usuari =trim(htmlspecialchars($_POST['usuari']));
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9]/', $usuari)){
                    header('Location: actualiza_client.php??error=10usu');//Sólo se pueden introducir letras y números
                    exit();
		}
                
     /*--CONTRASEÑA--*/
	$contrasenya =trim(htmlspecialchars($_POST['contrasenya']));
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9\\s]/', $contrasenya)){
                    header('Location: actualiza_client.php??error=10contra');//Sólo se pueden introducir letras y números
                    exit();
		}
                	
		if ($contrasenya!=""){
                    /*--COMPROBAR EL TAMAÑO--*/	
                    if ((strlen($contrasenya)<6)||(strlen($contrasenya)>12)){
                        header('Location: actualiza_client.php??error=11');//El tamaño de la contraseña incorrecto
                        exit(); 
                    }
                }
   /*--DNI--*/
	$DNI =trim(htmlspecialchars($_POST['DNI']));
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9]/', $DNI)){
                    header('Location: actualiza_client.php??error=10nombre');//Sólo se pueden introducir letras y números
                    exit();
		}
                /*--COMPROBAR QUE HAYA DATOS--*/	
		if ($DNI==""){
                    header('Location: actualiza_client.php??error=2');//No se han rellenado todos los campos marcados con *
                    exit();
                    
		}           
                /*--COMPROBAR SI ES UN DNI VALIDO--*/
                $valido=  DNI_valido($DNI);
		if ($valido==FALSE){
                   header('Location: actualiza_client.php??error=3');//DNI NO valido
                   exit(); 
                }
   /*--NOMBRE--*/
	$nombre =trim(htmlspecialchars($_POST['nombre']));
        
		/*--LIMPIAR DATOS--*/	
		if (preg_match('/[^A-Za-z0-9\\s]/', $nombre)){
                    header('Location: actualiza_client.php??error=10nombre');//Sólo se pueden introducir letras y números
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
               header('Location: actualiza_client.php??error=10');//Sólo se pueden introducir letras y números
               exit();
           }

           /*--COMPROBAR SI ES UN EMAIL VALIDO--*/
           $valido=mail_correcto($email);

           if (!$valido==TRUE){
               header('Location: actualiza_client.php??error=5');//mail NO valido
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
           if (preg_match('/[^A-Za-z0-9]/', $telefono)){
               /*header('Location: actualiza_client.php??error=10');//Sólo se pueden introducir letras y números
               exit();*/
           }

           /*--COMPROBAR SI ES UN TELEFONO VALIDO--*/
           $valido=telefono_correcto($telefono);

           if (!$valido==TRUE){
              /* header('Location: actualiza_client.php??error=6');//telefono NO valido
               exit(); */
           }
    }	
    else{
        
        $telefono=NULL;//Si no se ha introducido nada telefono será null (campo no obligatorio)
       
    }
    
    /*--DIRECCION--*/
    //NO RECONOCE UNA DIRECCION CON º Y ª
    
            $direccion=$_POST['direccion'];
            //$direccion =trim(htmlspecialchars($_POST['direccion']));
            
                    /*--LIMPIAR DATOS--*/	
                    if (!preg_match('/[A-Za-z0-9\\s,.-]/', $direccion)){//Warning: preg_match(): Compilation failed: range out of order in character class at offset 16 in C:\xampp\htdocs\PHP\valida_actualiza_client.php on line 119
                        header('Location: actualiza_client.php?error=10');//Sólo se pueden introducir letras y números
                        exit();
                    }
                    /*--COMPROBAR QUE HAYA DATOS--*/	
                   if ($direccion==""){
                        header('Location: actualiza_client.php?error=2');//No se han rellenado todos los campos marcados con *
                        exit();
                        
                    }
    /*--HABITACION--*/               
    $habitacion =$_POST['habitacion'];
}

    //echo "<br>id:" . $id.  "<br>us:" . $usuari.  "<br>con:" .$contrasenya. "<br>nom:" .$nombre. "<br>dni:" .$DNI. "<br>dir:" .$direccion. "<br>tel:" .$telefono. "<br>email:" .$email. "<br>hab:" .$habitacion;
/*------------------------------------------------------------------------------------------------------------------------------*/
            
            
    /*--MODIFICAR--*/ 
$conex=  conectar_bdd();
$deshacer = FALSE;
mysql_query("BEGIN");
    /*--USUARIO--*/
if (($contrasenya!="")&&($usuari!="")){
    $sql="UPDATE usuaris SET user_name = '$usuari',contrasenya = PASSWORD( '$contrasenya' ) WHERE usuaris.id ='$id'";
    $modificarUsu=  mysql_query($sql);
    if (!$modificarUsu){$deshacer=TRUE;}
}
else{
    if ($contrasenya==""){
        $sql="UPDATE usuaris SET user_name = '$usuari' WHERE id ='$id'";
        $modificarUsu=  mysql_query($sql,$conex);
        echo "error: ". mysql_error();
        if (!$modificarUsu){$deshacer=TRUE;}
    }
    else{
        $sql="UPDATE usuaris SET contrasenya = PASSWORD( '$contrasenya' ) WHERE usuaris.id ='$id'";
        $modificarUsu=  mysql_query($sql,$conex);
        echo "error: ".mysql_error();
        if (!$modificarUsu){$deshacer=TRUE;}
    }
}
    /*--CLIENTE--*/
$sql = "UPDATE client SET dni = '$DNI', nom_complert = '$nombre', email = '$email', telefon = '$telefono', adreca_complerta = '$direccion', numero_hab = '$habitacion' WHERE id_usuari = '$id'";
$modificarCli=  mysql_query($sql,$conex);
echo "error: ".mysql_error();
    if (!$modificarCli){$deshacer=TRUE;
    
    }
    
     
    /*--ROLLBACK/COMMIT--*/
    if ($deshacer) {
	mysql_query("ROLLBACK");
        mysql_close($conex);
	header('Location: cliente_actualizado.php?error=1');//No se ha modificado nada
            exit();
}
else {
	mysql_query("COMMIT");
        mysql_close($conex);
        header('Location: cliente_actualizado.php?error=0');//Cliente modificado
            exit();
}
?>


