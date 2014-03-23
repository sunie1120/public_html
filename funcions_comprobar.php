<?php
/**
 * Especificacion: Fichero de funciones de comprobacion de datos
 * @author Olaia Fidalgo
 * @date 13.01.2014
 * @copyright 
 */

/**
 * Especificacion: Función que comprueba si el DNI es válido
 * Función que comprueba si el DNI es válido, pasándole como parametro una cadena
 * de texto. Si el DNI es válido devuelve TRUE, en caso contrario devuelve FALSE.
 * @param String $DNI
 * @return boolean
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function DNI_valido($DNI)
{
    if (!preg_match('/[0-9]{7,8}[A-Z]/', $DNI))
    {
        return false;
    }
    else {return true;}
}
/*
function DNI_valido($DNI)//Comprueba el mod23
{
    //Comprobamos longitud
    if (strlen($DNI) != 9) return false;      
 
    //valores letra
    $valoresLetra = array(
        0 => 'T', 1 => 'R', 2 => 'W', 3 => 'A', 4 => 'G', 5 => 'M',
        6 => 'Y', 7 => 'F', 8 => 'P', 9 => 'D', 10 => 'X', 11 => 'B',
        12 => 'N', 13 => 'J', 14 => 'Z', 15 => 'S', 16 => 'Q', 17 => 'V',
        18 => 'H', 19 => 'L', 20 => 'C', 21 => 'K',22 => 'E'
    );

    //Comprobar si es un DNI
    if (preg_match('/^[0-9]{8}[Aa-zA-Z]$/i', $DNI))
    {
        //Comprobar letra
        if (strtoupper($DNI[strlen($DNI) - 1]) !=
            $valoresLetra[((int) substr($DNI, 0, strlen($DNI) - 1)) % 23])
            return false;
 
        //Todo fue bien
        return true;
    }
       
    //Cadena no válida  
    return false; 
}
*/

/**
 * Especificacion: Función que comprueba si el mail es valido
 * Función que comprueba si la cadena de texto pasada es un mail valido. Comprobando
 * si tiene usuario, dominio y TLD. Si es correcto devuelve TRUE, en caso contrario
 * devuelve FALSE.
 * @param string $mail
 * @retur boolean
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function mail_correcto($email)
{
    if (!ereg("^([a-zA-Z0-9._-]+)@([a-zA-Z0-9.-_]+).([a-zA-Z]{2,4})$",$email)){ 
      $valido= FALSE; 
  } else { 
       $valido= TRUE; 
  }  
  return $valido;
}

/**
 * Especificacion: Función que comprueba si el telefono es correcto
 * Función que comprueba que el telefono introducido tiene 9 dígitos y que el
 * primero de ellos comienza por 9 o por 6. Si es correcto devuelve TRUE, en caso
 * contrario devuelve FALSE.
 * @param int $telefono
 * @return boolean
 * 
 * @author Olaia
 * @version 1
 * @copyright 
 */
function telefono_correcto($telefono)
{
    $valido=TRUE;
    if (!preg_match('/^[9|8|6][0-9]{8}$/', $telefono)){ 
      $valido=FALSE; 
  } 
    
    return $valido;
}
?>