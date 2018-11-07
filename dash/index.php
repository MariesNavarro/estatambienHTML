<!--
Oet Capital
Esta También Es Tu Pepsi v1
23 de Octubre 2018
-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0000, minimum-scale=1.0000, maximum-scale=1.0000, user-scalable=no">
    <title>Dashboard | Esta También Es Tu Pepsi | Pepsi México</title>
    <link rel="stylesheet" href="../ui/css/master.css">
    <link rel="stylesheet" href="../ui/css/dash.css">
    <link rel="canonical" href="www.estatambienestupepsi.com">
    <link rel="apple-touch-icon" sizes="180x180" href="../ui/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../ui/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../ui/fav/favicon-16x16.png">
    <link rel="manifest" href="../ui/fav/site.webmanifest">
    <link rel="mask-icon" href="../ui/fav/safari-pinned-tab.svg" color="#000000">
    <link rel="shortcut icon" href="../ui/fav/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="../ui/fav/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="El lugar perfecto para encontrar las mejores promociones de toda la línea de Gatorade ®">
    <meta name="keywords" content="Sigue Sudando, Hidratación, Hidratar, Ejercicio, Electrolitos, Energía, Gatorade, Promoción, Deporte, Football Energy, OXXO">
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="backend/js/app.js"></script>
  </head>
  <body id="index" class="standarWidth">
    <!-- MENU -->
    <nav id="menu" class="flexDisplay trans7" style="top:0">
           <h1 id="pepsilogopatch">
             <a href="index.php">
               <img src="../ui/img/logo-pepsi-80.svg" class="trans3" alt="Pepsi ®" title="Pepsi ®" width="60px" height="60px">
             </a>
           </h1>
           <p id="stateText"></p>
           <div id="blk" class="flexDisplay" style="background-image:url("ui/img/blank.png")"></div>
    </nav>

    <!-- LOADING -->
    <div id="loading" class="flexDisplay trans7"></div>

    <div id="landscapeDash" class="noDisplayLand">
      <img src="../ui/img/rotate.svg" width="50" height="50">
      <p>Por favor gira tu teléfono</p>
    </div>
    <!-- FOOTER -->
    <!-- <footer id="footer" style="opacity: 1;">
      <a href="../terminos-condiciones.html" target="_blank">Consulta Bases, Términos y Condiciones</a>
      <p><span>  |  </span>Hidrátate sanamente | ® Marca Registrada </p>
    </footer> -->
    <script>
      window.onload = function(){
          salir();
      }
      window.onorientationchange = function(){
        var wr = document.getElementById('landscapeDash');
        if(window.orientation == 90 || window.orientation == -90){
          wr.setAttribute("class", "displayLand");
        } else {
          wr.setAttribute("class", "noDisplayLand");
        }
      }
    </script>
  </body>
</html>
