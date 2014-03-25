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
 * Drag&Drop
 */
contar=0;
$(function() {
    $( "#servicios li" ).draggable();
    $( "#Realizados" ).droppable({
        accept: "#servicios li",
        drop: function( event, ui ) {
            //$( this ).find( ".placeholder" ).remove();
            //$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
            $("#eliminar_servicios").submit();
            $(ui.draggable).remove();
            /*contar=contar+1;
            $("#resultado").html("Hay "+contar+" servicios realizados");*/
        }/*,
        out: function( event, ui ) {
            $(ui.draggable).css({color: "#000000"});
            contar=contar-1;
            if (contar == 0)
            {
                $("#resultado").html("No hay servicios realizados");
            }
        }*/
    })/*.sortable({
        items: "li:not(.placeholder)",
        sort: function() {
            // gets added unintentionally by droppable interacting with sortable
            // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
            $( this ).removeClass( "ui-state-default" );
        }
    })*/;
});


