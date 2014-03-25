<?php 
session_start();
include ('funcions_bdd.php');
$id_servicio=$_POST['servicio'];
$id_franja=$_POST['id_fraja'];
$dni=$_POST['dni'];
$hoy=date("Y-m-d");

$sql = "UPDATE `hotel_jda`.`reserva` SET `realitzat` = 1 WHERE `reserva`.`id_franja` = '$id_franja' AND `reserva`.`data` = '$hoy' AND `reserva`.`dni_client` = '$dni';";
$resultado=servicio_realizado($sql);
header('Location: administrador_servicios.php?servicio='.$id_servicio.'&submit=Buscar#');//Sólo se pueden introducir letras y números
exit();
?>