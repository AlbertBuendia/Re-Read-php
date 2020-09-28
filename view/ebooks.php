<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Website Layout</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="logo">Re-Read</div>

<div class="header">
  <h1>Re-Read</h1>
  <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
</div>

<div class="row">
  
  <div class="column left">
    <div class="topnav">
        <a href="../index.php">Re-Read</a>
        <a href="libros.php">Libros</a>
        <a href="ebooks.php">eBooks</a>
      </div>
      
    <h3>Toda la actualidad en eBook</h3>
    
    <!--<div class="eBook">
      <a href="https://www.amazon.es/Ultimo-deseo-Geralt-Alamut-Fantástica/dp/8498890373/ref=sr_1_1?__mk_es_ES=ÅMÅŽÕÑ&crid=2XKVBNZSYHD4K&dchild=1&keywords=saga+geralt+de+rivia&qid=1600765706&s=books&sprefix=saga+%2Cstripbooks%2C201&sr=1-1"><img src="../img/1.jpg" alt="eBook 1">
      <div>Ultimo deseo - Saga Geralt de Rivia 1 tela (Alamut Serie Fantástica)</div>
      </a>
    </div>-->
  
  <?php

  // 1. Conexion con la base de datos
  include '../services/connection.php';
  // 2. Selección y muestra de datos de la base de datos
  $result = mysqli_query($conn, "SELECT Books.Description, Books.img, Books.Title from Books");

  if(!empty($result) && mysqli_num_rows($result) > 0) {
    // datos de salida de cada fila (fila = row)
    $i=0;
      while ($row = mysqli_fetch_array($result)) {
        $i++;
        echo "<div class='eBook'>";
        //Añadimos la imagen a la pagina con la etiqueta img de html
        echo "<img src=../img/".$row['img']." alt'".$row['Title']."'>";
        //Añadimos el titulo a la pagina con la etiqueta h2 de html
        echo "<div class='desc'>".$row['Description']."</div>";
        echo "</div>";
        if ($i%3==0) {
          echo "<div style='clear:both;'></div>";
        }
      }
  }else {
    echo "0 resultados";
  }
  ?>
  </div>
  <div class='column right'>
    <h2>Top ventas</h2>
<?php
  $result = mysqli_query($conn, "SELECT Books.Title from Books");
  if(!empty($result) && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
  
    echo "<p>".$row['Title']."</p>";
   //<p>Cien años de soledad</p>
    //<p>Cronicas de una muerte anunciada</p>
    //<p>El otoño del patriarca</p>
    //<p>El general en su laberinto</p>
    }
  }
  ?>
  </div>
</div>
  
</body>
</html>
