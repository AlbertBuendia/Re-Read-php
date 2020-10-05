<!DOCTYPE html>
<html>
<head>
<title>Ebooks</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Estilos enlazados-->
<link rel="stylesheet" href="../css/estilos.css" type="text/css">
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
    <div id="form">
      <!--HACEMOS EL FORMULARIO -->
      <form action="ebooks.php" method="POST">
        <label for="fautor">Autor</label>
        <input type="text" id="fautor" name="fautor" placeholder="Introduce el autor...">
        <label for="ftitulo">Título</label>
        <input type="text" id="ftitulo" name="ftitulo" placeholder="Introduce el título...">
        <label for="country">País</label>
        <select name="country">
        <option value="%">Todos los paises</option>
        <?php 
        // CONECTAMOS CON LA BASE DE DATOS
        include '../services/connection.php';
          $result=mysqli_query($conn,"SELECT DISTINCT authors.country from authors order by country");
            while ($row = mysqli_fetch_array($result)) {
              echo "<option value='" . $row['country'] . "'>" . $row['country'] . "</option>";
          }
        ?>
        </select>
        <input type="submit" value="Buscar">
      </form>
    </div>
    <?php 
      // BUSQUEDA DE AUTOR Y TITULO
      if(isset($_POST['fautor']) || isset($_POST['ftitulo'])){
        $result=mysqli_query($conn,"SELECT Books.Description, Books.img, Books.Title From Books INNER JOIN booksauthors ON books.id=booksauthors.BookId 
        INNER JOIN authors ON authors.id=booksauthors.AuthorId WHERE authors.Name LIKE '%{$_POST['fautor']}%' AND authors.country LIKE '{$_POST['country']}'AND books.title LIKE '%{$_POST['ftitulo']}%'");
      }else {
        // MUESTRA TODOS LOS LIBROS
        $result=mysqli_query($conn,"SELECT Books.Description, Books.img, Books.Title From Books");
      }
      // MUESTRA TODOS LOS EBOOKS Y DESCRIPCIONES
      if (!empty($result) && mysqli_num_rows($result) > 0) {
        $i=0;
        while ($row = mysqli_fetch_array($result)) {
          $i=$i+1;
          echo "<div class='eBook'>";
          echo "<img src=../img/".$row['img']." alt='".$row['Title']."'>";
          echo "<div class='desc'>".$row['Description']."</div>";
          echo "</div>";
          if ($i % 3 == 0) {
            echo "<div style='clear:both;'></div>";
          }
        }
      }else {
        echo "0 resultados";
      }
    ?>
  </div>
  <div class="column right">
  <h2>Top ventas</h2>
    <?php 
      $result=mysqli_query($conn,"SELECT Books.Description, Books.img, Books.Title From Books WHERE Top='1'");
      if (!empty($result) && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
          echo "<p>".$row['Title']."</p>";
        }
      }else {
        echo "0 resultados";
      }
    ?>
  </div>
</div>
</body>
</html>