"use strict";
// window.console.log("%cCoded by Oet Capital", "color:#fff;  font-size: 10px; background:#000; padding:20px;");
function _(el){return document.querySelector(el); }
function __(el){return document.querySelectorAll(el); }
window.requestAnimFrame = (function(){
return  window.requestAnimationFrame       ||
    		window.webkitRequestAnimationFrame ||
    		window.mozRequestAnimationFrame    ||
    		function( callback ){
    			window.setTimeout(callback, 1000 / 60);
      	};
})();
var cupon = _("#cupon1"),
    interno = 0,
    cB = false,
    w = window.innerWidth;
function initFront(){
  var fps = 12,
      fpsHome,
      fpsCoupon,
      xhrListHome = [],
      xhrListCoupon = [],
      buttonHome = _("#buttonHome");
  var detectBrowser = (function(){
    if(bowser.mobile || bowser.tablet || /SymbianOS/.test(window.navigator.userAgent)) cB = true;
    if(cB){
      buttonHome.addEventListener("touchstart", lauchCoupon);
      loadingSeq("ui/img/seqHome/mob-", ".jpg", 29, "home");
    } else {
      buttonHome.addEventListener("click", lauchCoupon);
      if(w < 960){
        loadingSeq("ui/img/seqHome/mob-", ".jpg", 29, "home");
      } else {
        loadingSeq("ui/img/seqHome/desk-", ".jpg", 28, "home");
      }
    }
  })();
  function displaySeqHome(url, ext, len, dis){
    var wr = _("#loading"), wrap = _("#producto1>.wrap");
    generateSeq(url, ext, len, "#producto1>.wrap");
    setTimeout(function(){
      wr.style.opacity = 0;
      setTimeout(function(){
        wr.style.display = "none";
        wrap.style.opacity = "1";
        requestAnimationFrame(animationSeqHome);
      },700);
    },2000);
  }//displaySeqHome
  function generateSeq(url, ext, len, parent){
    var wr = _(parent), frameDiv;
    for (var i = len; i >= 0; i--) {
      frameDiv = document.createElement("DIV");
      frameDiv.setAttribute("class", "frame");
      frameDiv.style.backgroundImage = "url('"+url+i+ext+"')";
      wr.appendChild(frameDiv);
    }
  }//generateSeq
  function animationSeqHome(){
    var seq = __(".frame"),
        menu = _("#menu"),
        footer = _("#footer");
    seq[fpsHome].style.display = "none";
    seq[fpsHome].setAttribute("class", "remove");
    fpsHome--;
    if(fpsHome !== 0){
      setTimeout(function(){
        requestAnimationFrame(animationSeqHome);
      },1000/fps);
    }
    if(fpsHome === 2){
      buttonHome.setAttribute("class", "buttonG scaleUpButtonAnimation");
      setTimeout(function(){
        buttonHome.setAttribute("class", "buttonG scaleUpButtonDefault trans3");
      },1200);
    }
    if(fpsHome === 0){
      footer.style.opacity = "1";
      menu.style.opacity = "1";
      cleanSeq();
    }
  }//animationSeqHome
  function animationSeqCoupon(){
      var seq = __(".frame");
      seq[fpsCoupon].style.display = "none";
      seq[fpsCoupon].setAttribute("class", "remove");
      fpsCoupon--;
      if(fpsCoupon !== 0){
        setTimeout(function(){
          requestAnimationFrame(animationSeqCoupon);
        },1000/fps);
      }
  }
  function cleanSeq(){
    var els = __(".remove");
    for (var i = 0; i < els.length; i++) {
      els[i].parentNode.removeChild(els[i]);
    }
    var el = __(".frame");
    el[0].setAttribute("id", "seqHome");
    el[0].setAttribute("style", " ");
    el[0].setAttribute("class", " ");
  }//cleanSeq
  function lauchCoupon(){
    var tx = _('#stateText').innerHTML = "Cargando Cupón...";
    var carrusel = _('#carrusel').style.display = "none";
    var loadCoupon1 = _("#loadCoupon1>.wrap").style.opacity = "1";
    setTimeout(function(){
      animationSeqCoupon();
    },700);
      obtencupon();
  }//lauchCoupon
  function loadingSeq(url, ext, len, seq){
    if(seq === "home"){
      fpsHome = len;
    } else {
      fpsCoupon = len;
    }
    var c = 0;
    for(var i = 0; i < len; i++){
  	xhrListHome[i] = new XMLHttpRequest();
  	xhrListHome[i].open("GET", url+i+ext, true);
  	xhrListHome[i].responseType = "blob";
      	xhrListHome[i].onload = function (e){
        	if(this.readyState == 4){
            c++;
            //home
            if(c === len && seq === "home"){
              displaySeqHome(url, ext, len);
              if(cB === true){
                loadingSeq("ui/img/seqLoadCoupon/mob-", ".jpg", 26, "coupon");
              } else if (cB === false && w < 960) {
                loadingSeq("ui/img/seqLoadCoupon/mob-", ".jpg", 26, "coupon");
              } else if(cB === false && w >= 960){
                loadingSeq("ui/img/seqLoadCoupon/desk-", ".jpg", 26, "coupon");
              }
            }
            //coupon
            else if (c === len && seq === "coupon") {
              generateSeq(url, ext, len, "#loadCoupon1>.wrap");
            }
        	}
      }
      xhrListHome[i].send();
    }
  }//loadingSeq
}

function handleSizeCoupon(wid){
  if(cB){
    cupon.style.backgroundImage = "url('ui/img/promoMob-"+interno+".jpg')";
  } else if (cB === false && wid < 960) {
    cupon.style.backgroundImage = "url('ui/img/promoMob-"+interno+".jpg')";
  } else if (cB === false && wid >= 960) {
    cupon.style.backgroundImage = "url('ui/img/promoDesk-"+interno+".jpg')";
  }
}

function generateCoupon(i){
  interno = i;
  if(cB){
    cupon.style.backgroundImage = "url('ui/img/promoMob-"+interno+".jpg')";
  } else if (!cB && w < 960) {
    cupon.style.backgroundImage = "url('ui/img/promoMob-"+interno+".jpg')";
  } else if (!cB && w >= 960) {
    cupon.style.backgroundImage = "url('ui/img/promoDesk-"+interno+".jpg')";
  }
}



function horasDisplay(c){
  var wr = _("#horasDiv");
  if(c === "displayBlock"){
    var tx = _('#stateText').innerHTML = " ";
    wr.style.display = "block";
  } else {
    var tx = _('#stateText').innerHTML = "Cupón Listo";
    displayCoupon();
    wr.style.display = "none";
  }
}
//agotadoDiv
function agotadoDisplay(c){
  var wr = _("#agotadoDiv");
  if(c === "displayBlock"){
    var tx = _('#stateText').innerHTML = " ";
    wr.style.display = "block";
  } else {
    var tx = _('#stateText').innerHTML = "Cupón Listo";
    displayCoupon();
    wr.style.display = "none";
  }
}


function loadingCoupon(d){
    var generando = _("#generandocupon");
    var n = 0;
    var counter = _("#counter>p");
    var interval = setInterval(function(){
      n++;
      counter.innerHTML = n;
      if(n===100) {
        clearInterval(interval);
        setTimeout(function(){
          generando.style.opacity = "0";
          setTimeout(function(){ generando.style.display = "none"; },800);
          if(d==="VUELVE")
          {
            horasDisplay("displayBlock");
          }
          else if(d==="AGOTADO") {

              horasDisplay("displayNone");
              var cupon = _("#cupon").style.display = "none";
              agotadoDisplay("displayBlock");
          }
          else {
            generateCoupon(d);
            var arch='';
            if(cB){
              arch='ui/img/promoMob-'+d+'.jpg';
            } else if (!cB && w < 960) {
              arch='ui/img/promoMob-'+d+'.jpg';
            } else if (!cB && w >= 960) {
              arch='ui/img/promoDesk-'+d+'.jpg';
            }
            toDataURL(arch, function(dataUrl) {
               console.log('RESULT:',dataUrl);
               var dow=_("#download");
               dow.download="cupon.jpg"
               //dow.href=dataUrl;
               dow.href=arch;
               dow.target='_blank';
            });

            horasDisplay("displayNone");
          }

        },3000);
      }
    });
}


function displayCoupon(){
  var cupon = _("#cupon").style.display = "block";
}

function savedCoupon(){

  var cupon = _("#cupon").style.display = "none";
  var guardado = _("#guardado").style.display = "block";
  var tx = _('#stateText').innerHTML = "Cupón Guardado Exitosamente";
}

function detectLandscape(){

}
window.onorientationchange = function(){
  var wr = _('#preventLandscape');
  if(window.orientation == 90 || window.orientation == -90){
    wr.setAttribute("class", "flexDisplay");
  } else {
    wr.setAttribute("class", "dislplayNone");
  }
}
window.onresize = function(){
  var wid = window.innerWidth;
  //handleSizeCoupon(wid);
};
