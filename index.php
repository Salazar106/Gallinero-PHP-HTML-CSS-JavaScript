<?php
include("conexion.php");
$conexion = conectar();

$sql = "SELECT * FROM pollos";
$query = mysqli_query($conexion, $sql);
$row = mysqli_fetch_array($query);
$NGallinasGalpon = 0;
$galpon = [];

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./style.css" />
  <title>Document</title>
</head>

<body>
  <header>
    <div class="hora">
      <p id="hora"></p>
      <p>:</p>
      <p id="minutos"></p>
      <p>:</p>
      <p id="seg"></p>
    </div>

  </header>

  <div class="estadisticas">
    <p>Galpon:
    <h1 id='galpon'></h1>
    </p>

    <p>Gallinas en el Corral:
    <h1 id="nAfuera">0</h1>
    </p><br />
    <p>Gallinas en el Galpon:
    <h1 id="prueba">0</h1>
    </p>
  </div>

  <div class="granja">

    <div class="card">
      <?php
      while ($row = mysqli_fetch_array($query)) {
        array_push($galpon, $row);
        $NGallinasGalpon++;
      ?>

        <div class="gallinita">
          <img id="<?php echo $row['id'] ?> " class="gallinaAnimation" src="<?php echo $row['img'] ?>" onclick="GuardarGallina()">
          <p><?php echo $row['nombre'] ?></p>
        </div>
      <?php
      }
      ?>

    </div>
    <div class="card" style="background-color: #b39670;">
      <img class="galpon" src='./img/galpon.png' alt="" />
      <div className="botones">
        <button class="btn btn-soltar" onclick="soltar()">Soltar Gallinas</button>
        <button class="btn btn-abrir" onclick="abrir()">Abrir Galpon</button>
        <button class="btn btn-cerrar" onclick="cerrar()">Cerrar Galpon</button>
      </div>
    </div>



    <script>
      function abrir() {
        let puerta = document.getElementById("galpon");
        let hora = new Date().getHours()
        let min = new Date().getMinutes()
        let corral = document.getElementById('nAfuera')
        let galpon = document.getElementById('prueba')
        puerta.textContent = "Abierto"
        alert("Abriste la puerta a las |"+hora + ":" + min + "| hay "+ galpon.textContent+" gallinas adentro, !Se pueden salir!")
      }

      function cerrar() {
        let gns = '<?php echo $NGallinasGalpon ?>'
        let hora = new Date().getHours()
        let min = new Date().getMinutes()
        let puerta = document.getElementById('galpon')
        let corral = document.getElementById('nAfuera')
        let galpon = document.getElementById('prueba')


        if (hora < 18) {
          alert("Son las " + hora + " horas, no se puede cerrar la puerta hasta las 18 Horas")
        } else if (hora >= 18 && hora < 22) {
          if (galpon.textContent == gns) {
            alert("Todas la gallinas estan adentro, se Cerro la puerta a las |" + hora + ":" + min + "|")
            puerta.textContent = "Cerrado"
          } else {
            alert("No estan todas las gallinas en el Galpon, No se Puede cerrar la puerta")
          }
        } else if (hora >= 22) {
          if (galpon.textContent < 1) {
            alert("No se puede cerrar porque no hay ni una sola gallina adentro")
          } else {
            puerta.textContent = "Cerrado"
            alert("Se Cerro la puerta a las |" + hora + ":" + min + "| y quedaron " + corral.textContent + " gallinas por fuera y " + galpon.textContent + " adentro")
          }
        }



        console.log(gns)
      }

      function soltar() {
        let corral = document.getElementById('nAfuera')
        let galpon = document.getElementById('prueba')
        let puerta = document.getElementById('galpon')
        let nG = '<?php echo $NGallinasGalpon ?>'

        corral.textContent = nG
        galpon.textContent = 0
        puerta.textContent = "Abierto"

        alert("Abriste la puerta y se Salieron las Gallinas")

      }

      function cantidadGallinas() {

        let hora = new Date().getHours()
        let puerta = document.getElementById('galpon')
        let corral = document.getElementById('nAfuera')
        let galpon = document.getElementById('prueba')
        let nG = '<?php echo $NGallinasGalpon ?>'

        if (hora < 7 || hora > 18) {
          galpon.textContent = 'Cerrado'
          galpon.textContent = nG
          corral.textContent = 0


        } else {
          galpon.textContent = 'Abierto'
          corral.textContent = nG
          galpon.textContent = 0
        }
      }
      cantidadGallinas()

      function GuardarGallina() {
        let ho = document.getElementById("prueba")
        let h1 = document.getElementById("nAfuera")
        let puerta = document.getElementById('galpon')

        if (puerta.textContent == "Cerrado") {
          alert("La Puerta esta cerrada, La gallina no puede entrar!")
        } else {
          h1.textContent--
          ho.textContent++
        }



      }
    </script>
    <script src="./reloj.js"></script>
</body>

</html>