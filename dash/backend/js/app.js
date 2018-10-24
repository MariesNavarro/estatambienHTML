var milisegundos = 1000;
var x            = 60;  // timer cada 60seg actualizar
var MetodoEnum = { Ingresar: 1,  Salir: 2,  Datos: 3 };
var param1;
var param2;
var param3;
var param4;

$(document).ready(function() {
    console.log('Ready...');
    timer = setInterval('temporizador()', milisegundos);
});

function temporizador() {
    $(document).ready(function() {
        if (x==0) {
           // clearInterval(timer);
            x=60;
            actualizaDatos();
        }
    });
    //console.log(x);
    $('#timer').text(x);
    x--;
}

function ingresar() {
  param1=$('#username')[0].value;
  param2=$('#password')[0].value;
  param3=MetodoEnum.Ingresar;
  param4=2;   // promo
  actualizadiv();
}
function salir() {
  param1='';
  param2='';
  param3=MetodoEnum.Salir;
  param4=2;  // promo
  actualizadiv();
}
function actualizadiv(){
  var dataString = 'param1=' + param1 + '&param2=' + param2+'&param3=' + param3+'&param4=' + param4;
  console.log(dataString);
  $.ajax({
    type : 'POST',
    url  : 'respuesta.php',
    data:  dataString,
    success:function(data) {
      //console.log(data);
      $('#loading').html(data).fadeIn();
      if (param3==1 && data.indexOf("incorrecta")==-1) {
       console.log('height 30vh');
       $('#loading').css("height", "30vh");
     } else {
       $('#loading').css("height", "100vh");
     }
    }
  });
}

function actualizaDatos(){
  param1='';
  param2='';
  param3=MetodoEnum.Datos;
  param4=2;  // promo
  var dataString = 'actualizaDatos param1=' + param1 + '&param2=' + param2+'&param3=' + param3+'&param4=' + param4;
  console.log(dataString);
  $.ajax({
    type : 'POST',
    url  : 'respuesta.php',
    data:  dataString,
    success:function(data) {
      console.log(data);
      $("#cupEntregadosHoy").text(data.split(";")[0]); // Cupones entregados hoy
      $("#cupEntregados").text(data.split(";")[1]); // Cupones entregados
      $("#cupDisponibles").text(data.split(";")[2]); // Cupones Disponibles
      $("#cupEntregadosPorc").text(data.split(";")[3]); // Cupones entregados %
      $("#cupDisponiblesPorc").text(data.split(";")[4]); // Cupones disponibles %
      $("#cupDisponibles").css({'color':''+data.split(";")[5]+''})
      $("#cupUltimo").text(data.split(";")[6]); // Cupones último
      x=60;
    }
  });
}

$(document).keypress(function (e) {
    if (e.which == 13) {
        ingresar();
    }
});
