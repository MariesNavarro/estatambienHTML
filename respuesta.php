<?php
  require_once('backend/lib/db.php');
  $htmlresult='';
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  $tipo=$_POST['param1'];
  if($tipo==1)
  {
    $cads;
    $idprom=$_POST['promo'];
    $val=validafechas($cads,$idprom);
    if($val[0]>0.000001&&$val[1]<0.00000001)
    {
      //echo "SI";
      validalista($idprom,$ip);
    }
    else
    {
      //echo $val[0].' '.$cads[0];
      if ($val[0]<0.000001) {  // no ha comenzado
        echo '<nav id="logo" class="flexDisplay trans7" style="opacity: 1;">
          <h1>
            <a href="index.html"> <!-- CAMBIAR!!!!! -->
                <img src="ui/img/logo-pepsi.svg" class="trans3" alt="Pepsi ®" title="Pepsi ®" width="60px" height="60px">
            </a>
          </h1>
          <p id="stateText"></p>
          <div id="blk"></div>
        </nav>

        <div id="main">
          <p>La promoción comienza en</p>
          <ul class="countdown">
            <li>
                <span class="days">00</span>
                <p class="days_ref">Días</p>
            </li>
            <li class="seperator">.</li>
            <li>
                <span class="hours">00</span>
                <p class="hours_ref">Horas</p>
            </li>
            <li class="seperator">:</li>
            <li>
                <span class="minutes">00</span>
                <p class="minutes_ref">Minutos</p>
            </li>
            <li class="seperator">:</li>
            <li>
                <span class="seconds">00</span>
                <p class="seconds_ref">Segundos</p>
            </li>
          </ul>
        </div>
        <link rel="stylesheet" href="countdown/count.min.css">
        <script type="text/javascript" src="./countdown/jquery.downCount.js"></script>

        <script type="text/javascript">
            $(\'.countdown\').downCount({
                date: \''.str_replace("-","/",$cads[0]).'\',
                offset: -6
            }, function () {
                location.reload();
            });
        </script>';

      }
      else {  // ya finalizo
      echo '<nav id="menu" class="flexDisplay trans7" style="opacity: 1;">
        <h1>
          <a href="index.php"> <!-- CAMBIAR!!!!! -->
              <img src="ui/img/logo-pepsi.svg" class="trans3" alt="Pepsi ®" title="Pepsi ®" width="60px" height="60px">
          </a>
        </h1>
        <p id="stateText"></p>
        <div id="blk"></div>
      </nav>
      <div id="horasDiv" class="mensaje standarWidth" style="display:block">
        <div class="flexDisplay">
          <p>
            <span>¡Ups!</span>
          </p>
          <p>
            La promoción se ha terminado<br/><span>espera próximas promociones</span>
          </p>
          <div id="social" class="flexDisplay socialWidth">
            <a href="https://www.facebook.com/GatoradeMexico/" target="_blank">
              <img src="ui/img/social/fb.svg" width="50" height="50">
            </a>
            <a href="https://www.instagram.com/gatorademexico/" target="_blank">
              <img src="ui/img/social/ig.svg" width="50" height="50">
            </a>
            <a class="whatsapp" href="whatsapp://send?text=https://siguesudando.com" data-action="share/whatsapp/share" style="display:none">
              <img src="ui/img/social/wspp.svg" width="50" height="50">
            </a>
          </div>
        </div>
      </div></footer> -->
      <div id="pepsilegal">
        <p>ESTA TAMBIÉN ES TU PEPSI <span>®</span> <img src="ui/img/logo-pepsi-80.svg" width="10"> </p>
        <div>
          <p>HAZ EJERCICIO</p>
          <span class="flexDisplay">
            <a href="terminos-condiciones.html">CONSULTA BASES, TÉRMINOS Y CONDICIONES.</a>
            <p>&nbsp;®MARCA REGISTRADA</p>
          </span>
        </div>
      </div>';
    }
  }
}
else if($tipo==2)
{
  $idClient = $_POST['codigo'];
  $idprom=$_POST['promo'];
  getcupon($ip,$idClient,$idprom);
}

?>
