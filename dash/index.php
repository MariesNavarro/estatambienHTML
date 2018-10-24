<!--
Oet Capital
Sigue sudando v2
22 de Agosto
-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0000, minimum-scale=1.0000, maximum-scale=1.0000, user-scalable=no">
    <title>Sigue Sudando | Gatorade ®</title>
    <link rel="stylesheet" href="ui/css/fonts.css">
    <link rel="stylesheet" href="ui/css/master.css">
    <link rel="prefetch" href="ui/img/logotipo-gatorade.svg">
    <link rel="canonical" href="www.siguesudando.com">
    <link rel="apple-touch-icon" sizes="180x180" href="ui/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="ui/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="ui/fav/favicon-16x16.png">
    <link rel="manifest" href="ui/fav/site.webmanifest">
    <link rel="mask-icon" href="ui/fav/safari-pinned-tab.svg" color="#000000">
    <link rel="shortcut icon" href="ui/fav/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="ui/fav/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <meta name="description" content="El lugar perfecto para encontrar las mejores promociones de toda la línea de Gatorade ®">
    <meta name="keywords" content="Sigue Sudando, Hidratación, Hidratar, Ejercicio, Electrolitos, Energía, Gatorade, Promoción, Deporte, Football Energy, OXXO">
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="backend/js/app.js"></script>
  </head>
  <body id="index" class="standarWidth">

    <!-- <div id="block"></div> -->
    <!-- MENU -->
    <nav id="logo" class="flexDisplay trans7" style="opacity: 1;">
      <h1>
        <a href="index.php"> <!-- CAMBIAR!!!!! -->
          <img src="ui/img/logotipo-gatorade.svg" alt="Gatorade ®" title="Gatorade ®" width="60px">
        </a>
      </h1>
      <p id="stateText"></p>
      <div id="blk"></div>
    </nav>

    <!-- LOADING -->
    <div id="loading" class="flexDisplay standarWidth trans7">
    </div>

    <!-- FOOTER -->
    <footer id="footer" class="flexDisplay trans7" style="opacity: 1;">
      <a class="flexDisplay" href="terminos-condiciones.html" target="_blank">Consulta Bases, Términos y Condiciones</a>
      <p><span>  |  </span>Hidrátate sanamente | ® Marca Registrada </p>
    </footer>
    <!-- PREVENT LANDSCAPE -->
  <div id="preventLandscape" class="dislplayNone">
    <img src="ui/img/rotate.svg" width="50" height="50">
    <p>Por favor gira tu teléfono</p>
  </div>

    <!-- SCRIPT -->
    <script src="ui/js/bowser.min.js" charset="utf-8"></script>
    <script src="ui/js/front.js" charset="utf-8"></script>
    <script>
      window.onload = function(){
          salir();
          //initFront();
      }
    </script>
  </body>
</html>
