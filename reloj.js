(function () {
  const actualizarHora = function (hora) {
    let time = new Date(),
      hours = time.getHours(),
      minutes = time.getMinutes(),
      seg = time.getSeconds();

    var pHoras = document.getElementById("hora"),
      pMinutos = document.getElementById("minutos"),
      pSeg = document.getElementById("seg");

    if (minutes < 10) {
      minutes = "0" + minutes;
    }
    if (seg < 10) {
      seg = "0" + seg;
    }

    pHoras.textContent = hours;
    pMinutos.textContent = minutes;
    pSeg.textContent = seg;
  };

  const puerta = function () {
    let time = new Date(),
      hora = time.getHours(),
      puerta = document.getElementById("galpon");

    if (hora < 7) {
      puerta.textContent = "Cerrado";
    }
    if (hora >= 7 && hora <=18) {
      puerta.textContent = "Abierto";
    }
    if (hora > 18 || hora > 22) {
      puerta.textContent = "Cerrado";
    }
    if(hora==18){
        
       alert('no hay ninguna Gallina en el Galpon no se cerrara')
    }
  };

  puerta();
  actualizarHora();
  var intervalo = setInterval(actualizarHora, 1000);
})();
