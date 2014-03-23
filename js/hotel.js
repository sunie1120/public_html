$(function(){ 
//variable que alamcena las opciones del dialogo emmergente
var opcionesEmergente = {
autoOpen: false,
width: 410, 
height: 400, 
minWidth: 150, 
minHeight: 150, 
maxWidth: 600, 
maxHeight: 450,
buttons:{
    "Enviar":enviaPHP,
    "Cancelar":cancelar
}
}; 
//div del dialogo emergente
$("#dialogoemergente").dialog(opcionesEmergente); 
}); 
//funcion que controla que se muestre el dialogo
function muestra(){ 
if(!$("#dialogoemergente").dialog("isOpen")){ 
	$("#dialogoemergente").dialog("open"); 
	} 
};
/**
 * funcion que controla que se cierre el dialogo
 */
//$("#cancelar").click(function(event){
function cancelar(){
	$("#dialogoemergente").dialog("close");
};
/**
 * Funcion para que se envien los datos mediante submit (que es lo que enlaza con php)
*/
function enviaPHP()
{
var nombreusuario=$("#user").val();
var passusuario=$("#contra").val();
	if(nombreusuario=="" || passusuario==""){//comprovamos que no sean campos vacios
	$("#errores").html("Todos los campos deben estar completos.");//si están vacios sacamos un mensaje por pantalla en el div "errores"
	$( "#shake" ).effect( "shake",{distance: 10},2000,oculta);//hacermos el efecto shake
	
	}else{
	$("#loginsusuario").submit();//lo enviamos a la página de php para que compruebe en el servidor si el usuario existe
	}
};
/**
 * funcion que hace que una vez finalizado el efecto shake se oculte el texto
 */
function oculta(){
$("#errores").html(" ");
}

/**
 * Fecha de hoy
 */
$(document).ready(function(){
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var fecha = new Date();
//Imprime la fecha
$("#fechahoy").innerHTML =  diasSemana[fecha.getDay()] + ", " + fecha.getDate() + " de " + meses[fecha.getMonth()] + " de " + fecha.getFullYear();
//Imprime la hora
$("#hora").innerHTML = "Son las "+fecha.getHours()+':'+fecha.getMinutes();
});
/**
 * Drag
 */
$(function() {
$(".personas").draggable();
});
/**
 * Drop
 */
$(function() {
    $(".personas").draggable(dragOpts);
    var dropOpts = {
    drop: function( event, ui ) {
        $("#drop").innerHTML ="<img src=\"imagenes/gota.png\" width=\"268\" height=\"225\" alt=\"gota\"/><p class=\"derecha\">Servicios Finalizado</p>";
    }
    };
    $("#drop").droppable();
});