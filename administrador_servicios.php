<?php session_start();?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" lang="es">
<title>Bienvenido Hotel JdH</title>
<link href="css/hotel.css" rel="stylesheet" type="text/css">
<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/hotel.js"></script>
</head>

<body>
<header>
<div id="header">

    <a href="index.html"><img class="logo" src="imagenes/logo.png" alt="logo"/></a>

<div class="navbar">
    <div class="boton derecha">
         <form id="formulario" action="cerrar_sesion.php" method="post" class="centro">
            <input type="submit" value="Tancar sessió" name="tancar_ses"></input>
        </form>
     </div>
    <h1 class="boton titulohotel ">Hotel Joan d'Austria</h1>
  
     
   <div id="arriba">   
  <nav id="abajo">
          <ul class="mi-menu">
          <li><a href="index.html"> Inicio </a></li>
          <li>
            <a href="#"> Ofertas </a>
          </li>
          <li><a href="habitaciones.html"> Habitaciones </a>
             <ul>
              <li><a href="suites.html"> Suites </a></li>
              <li><a href="triples.html"> Triples </a></li>
              <li><a href="dobles.html"> Dobles </a></li>
            </ul>

          </li>
          <li><a href="servicios.html"> Servicios </a></li>
          <li><a href="eventos.html"> Eventos </a>
            <ul>
             <li><a href="reuniones.html"> Reuniones </a></li>
             <li><a href="bodas.html"> Bodas </a>
                <ul>
                  <li><a href="presupuestos.html"> presupuestos </a></li>
                  <li><a href="salones.html"> salones </a></li>
                  <li><a href="menus.html"> menus </a></li>
                </ul>
             </li>
            </ul>
          </li>
          <li><a href="rest.html"> Restauracion </a></li>
          <li><a href="spa.html"> Spa </a></li>
          <li><a href="llegar.html"> Como llegar </a></li>
          <li><a href="contacto.html"> Contacto </a></li>
        </ul>
   </nav>     
</div>
</header>

<section>
    <div>
        <div class="izquierdo">
            <p id="p" class="margen_izquierdo"><b><?php echo "Bienvenido ".@$_SESSION['user'];?></b></p>  
            <p class="margen_izquierdo">Servicio: <b>Chocolaterapia</b></p>
        </div>
        <div class="derecha">
            <p id="fechahoy"></p>
            <p id="hora"></p>
        </div>
    </div>
    <div class="cuerpo division">
        <div class="izquierdo2_3" id="listado_personas">
            <?php
                include('funcions_bdd.php');
                $hoy=date("Y-m-d");
                llistar_reserves_dia_js($hoy);
            ?>

        </div>
        <div class="derecha40">
            <div id="drop">
                

            </div>
            <div id="resultado">
                <?php
                    total_servicios_hoy($hoy);
                ?>
            </div>
        </div>
    </div>
    
    
    
    
</section>

<footer>
    <div id=redes><a href="">
      <img src="imagenes/facebook.png" width="25" height="25" alt="facebook"/></a>
      <a href=""><img src="imagenes/twitter.png" width="25" height="25" alt="twiter"/></a>
      <a href=""><img src="imagenes/google+.png" width="25" height="25" alt="google +"/></a>
      <a href=""><img src="imagenes/rss.png" width="25" height="25" alt="rss"/></a>
      </div>
    <div id=info>
	<p>Hotel Spa Joan d'Austria<br> Parque Nacional de la Selva de Mar, km 211.</p>
        <p><a href="">Terminos</a></p>
        <p><a href="">Mapa</a></p>
        <p> Hotel Spa Joan</p>
    </div>
</footer>





</body>
</html>
