<?php
date_default_timezone_set('America/Mexico_City');

require_once('conexion.php');
require_once('funciones.php');

function descPromo($link,$promo) {
  /* recuperar todas las filas de myCity */
   $data="";
   $consulta = "SELECT descripcion FROM gtrd_promociones WHERE id = ".$promo.";";
   if ($resultado = mysqli_query($link, $consulta)) {
     while ($fila = mysqli_fetch_row($resultado)) {
         $data=$fila[0];
      }
      /* liberar el conjunto de resultados */
      mysqli_free_result($resultado);
    }
    return $data;
}

function cuponesEntregadosHoy($link,$promo) {
  /* recuperar todas las filas de myCity */
   $score=0;
   $consulta = "SELECT count(*) FROM gtrd_cupones WHERE estatus = 1 and id_promo = ".$promo." and Date_format(fecha_entregado,'%d-%m-%Y') = Date_format(now(),'%d-%m-%Y');";
   if ($resultado = mysqli_query($link, $consulta)) {
     while ($fila = mysqli_fetch_row($resultado)) {
         $score=$fila[0];
      }
      /* liberar el conjunto de resultados */
      mysqli_free_result($resultado);
    }
    return $score;
}

function cuponesEntregados($link,$promo) {
  /* recuperar todas las filas de myCity */
   $score=0;
   $consulta = "SELECT count(*) FROM gtrd_cupones WHERE estatus = 1 and id_promo = ".$promo.";";
   if ($resultado = mysqli_query($link, $consulta)) {
     while ($fila = mysqli_fetch_row($resultado)) {
         $score=$fila[0];
      }
      /* liberar el conjunto de resultados */
      mysqli_free_result($resultado);
    }
    return $score;
}

function cuponesDisponibles($link,$promo) {
  /* recuperar todas las filas de myCity */
   $score=0;
   $consulta = "SELECT count(*) FROM gtrd_cupones WHERE estatus = 0 and id_promo = ".$promo.";";
   if ($resultado = mysqli_query($link, $consulta)) {
     while ($fila = mysqli_fetch_row($resultado)) {
         $score=$fila[0];
      }
      /* liberar el conjunto de resultados */
      mysqli_free_result($resultado);
    }
    return $score;
}

function cuponesUltimo($link,$promo) {
  /* recuperar todas las filas de myCity */
   $score="";
   $consulta = "SELECT max(fecha_entregado) FROM gtrd_cupones WHERE estatus = 1 and id_promo = ".$promo.";";
   if ($resultado = mysqli_query($link, $consulta)) {
     while ($fila = mysqli_fetch_row($resultado)) {
         $score=$fila[0];

         $date = new DateTime($score);
         $new_date_format = $date->format('d-m-Y H:i:s');
      }
      /* liberar el conjunto de resultados */
      mysqli_free_result($resultado);
    }
    return $new_date_format;
}

//select a.cupon,a.descripcion,a.score,COUNT(b.id) from bdlt_cupones a inner join bdlt_codigos b on a.id=b.id_cupon where entregado=1 group by a.cupon,a.descripcion,a.score
function get_pass($link,$user) {
 $cad='';
 $consulta = "SELECT value from gtrd_settings where Module='Admin' and setting='".$user."';";
 if ($resultado = mysqli_query($link, $consulta)) {
   while ($fila = mysqli_fetch_row($resultado)) {
     $pass=$fila[0];

    }/* liberar el conjunto de resultados */
    mysqli_free_result($resultado);
  }
 return $pass;
}
function login($user,$pass,$promo,&$error)
{
  $reg=0;
  $link=connect();
  $passbd = get_pass($link,$user);
  $passdecode = $passbd;
  $error=0;
//  $passdecode=base64_decode($passbd);
  if($passdecode==$pass&&$passbd!='')
  {
    $salida='<div id="disclaimerIndex" class="">
             <div id="content">
              <section id="disclaimer">'.createhtml($link,$promo).'
              <div id="interface" class="flexDisplay">
                <a role="button" class="buttonG trans7 btnActualizar"   onclick="actualizaDatos()">Actualizar <span id="timer">60</span></a>
                <a role="button" class="buttonG trans7 btnSalir"   onclick="salir()">Salir</a>
              </div>
             </section>
             </div>
            </div>';
    // $salida='
    //     <div id="interface" class="flexDisplay">
    //         <a role="button"onclick="actualizadiv();"><p>Actualizar</p><span class="trans7"></span> </a>
    //         <a role="button"onclick="salir();"><p>Salir</p><span class="trans7"></span> </a>
    //     </div>'.createhtml($link).'<script>
    //   document.getElementById("defaultOpen").click();
    //   </script> ';
  }
  else {
    $salida=loginhtml(true);$error=1;
  }
  Close($link);
  return $salida;

}
function loginhtml($error) {
     $salida='<div id="disclaimerIndex" class="flexDisplay back_word">
    <div id="content">
      <section id="disclaimer">
        <p style="font-size: 1.6rem;  color: white;">Usuario:</p>
        <input name="username" type="text" id="username" required  style="font-size: 1.3rem;font-weight: 300;">
        <p style="font-size: 1.6rem;  margin-top: 20px; color: white;">Password:</p>
        <input name="password" type="password" id="password" required style="font-size: 1.3rem;font-weight: 300;">
        <div class="flexDisplay">
          <a role="button" class="buttonG trans7"  style="margin-top: 60px;" onclick="ingresar()">Login</a>
        </div>';
        if($error)
       {
          $salida=$salida.'<span class="error">Usuario o contraseña incorrecta, vuelva a intentarlo.<span>';
       }

       $salida=$salida.'</section>
    </div>
  </div>';
  return $salida;
}

function salir()
{
   $salida=loginhtml(false);
   return $salida;
}
function createhtml($link,$promo)
{
  $des_promo = descPromo($link,$promo);
  $cup_entregadoshoy = cuponesEntregadosHoy($link,$promo);
  $cup_entregados = cuponesEntregados($link,$promo);
  $cup_disponibles = cuponesDisponibles($link,$promo);
  $cup_ultimo = cuponesUltimo($link,$promo);
  $porc_disponibles = 0;
  $porc_entregados = 0;
  if ($cup_disponibles+$cup_entregados > 0) {
    $porc_entregados = ($cup_entregados*100)/($cup_disponibles+$cup_entregados);
    $porc_disponibles = ($cup_disponibles*100)/($cup_disponibles+$cup_entregados);
  }
  $color = "green";

  if ($porc_disponibles < 25) { $color = "red";}
  if ($porc_disponibles >= 25 and $porc_disponibles < 40) { $color = "orange";}

  echo '
<!-- Tab content -->
<div id="Consolidados" class="tabcontent"  style="text-align: center;">
  <p class="descPromo">'.$des_promo.'</p><br />
  <p style="font-size: 1.9rem;margin-top: 20px;">Cupones</p><br />
  <p id="cupEntregadosHoy" style="font-size: 4.6rem; font-weight: 300; margin-top: -15px;">'.number_format($cup_entregadoshoy, 0, '.', ',').'</p><br />
  <p style="font-size: 15px; margin-top: -32px;color:black;">Entregados Hoy</p><br />
  <p id="cupEntregados" style="font-size: 4.6rem; font-weight: 300; margin-top: -15px;">'.number_format($cup_entregados, 0, '.', ',').'</p><br />
  <p id="cupEntregadosPorc" style="font-size: 15px; margin-top: -32px;color:black;">Total Entregados ('.number_format($porc_entregados, 2, '.', ',').'%)</p><br />
  <p id="cupDisponibles" style="font-size: 4.6rem; font-weight: 300; margin-top: -15px;color: '.$color.';">'.number_format($cup_disponibles, 0, '.', ',').'</p><br />
  <p id="cupDisponiblesPorc" style="font-size: 15px; margin-top: -32px;color:black;">Total Disponibles ('.number_format($porc_disponibles, 2, '.', ',').'%)</p><br />
  <p style="font-size: 15px; margin-top: -5px;color:black;">Último cupón entregado el <span id="cupUltimo" style="color:white;">'.$cup_ultimo.'</span</p><br />
</div>';
}

  function  getDatos($promo) {
    $link=connect();

    $cup_entregadoshoy = cuponesEntregadosHoy($link,$promo);
    $cup_entregados = cuponesEntregados($link,$promo);
    $cup_disponibles = cuponesDisponibles($link,$promo);
    $cup_ultimo = cuponesUltimo($link,$promo);
    $porc_disponibles = 0;
    $porc_entregados = 0;
    if ($cup_disponibles+$cup_entregados > 0) {
      $porc_entregados = ($cup_entregados*100)/($cup_disponibles+$cup_entregados);
      $porc_disponibles = ($cup_disponibles*100)/($cup_disponibles+$cup_entregados);
    }
    $color = "green";

    if ($porc_disponibles < 25) { $color = "red";}
    if ($porc_disponibles >= 25 and $porc_disponibles < 40) { $color = "orange";}

    $salida = number_format($cup_entregadoshoy, 0, '.', ',').";".number_format($cup_entregados, 0, '.', ',').";".number_format($cup_disponibles, 0, '.', ',').";Total Entregados (".number_format($porc_entregados, 2, '.', ',')."%);Total Disponibles (".number_format($porc_disponibles, 2, '.', ',')."%);".$color.";".$cup_ultimo.";";

    return $salida;
}
?>
