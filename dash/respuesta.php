<?php
  require_once('backend/lib/db.php');
  $tipo=$_POST['param3'];
  $promo=$_POST['param4'];

  if($tipo==1)
  {
    $user=$_POST['param1'];
    $pass=$_POST['param2'];

    $result=login($user,$pass,$promo,$error);
    echo $result;
  }
  else if($tipo==2)
  {
    $user='';
    $pass='';

    $result=salir();
    echo $result;
  }
  else if($tipo==3)
  {
    $result=getDatos($promo);
    echo $result;
  }
?>
