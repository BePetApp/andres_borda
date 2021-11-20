<?php 
  if (isset($_POST['send'])){

    // Guardamos los datos de POST en variables para un manejo mas cómodo
    $id = $_POST['Id'];
    $nombre = $_POST['name'];
    $apellido = $_POST['lastname'];
    $nick = $_POST['nick'];
    $email = $_POST['email'];

    // Generamos la actualizacion en la base de datos
    $sqlUpdtate = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', nickname = '$nick', email = '$email' WHERE id = $id";

    $sqlUpdtateRes = mysqli_query($conn, $sqlUpdtate);

    if ($sqlUpdtateRes) {
      ?>
      <div class="fixed top-2 w-full p-5 text-white text-center bg-green-500 z-50 hover:bg-green-700">
        <p class="mb-4">Actualizacion Completa</p>
        <a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
      </div>
      <?php
    }
    else{
      ?>
      <div class="fixed top-2 w-full p-5 text-white text-center bg-red-500 z-50 hover:bg-red-700">
        <p class="mb-4">Error en la actualizacion</p>
        <a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
      </div>
      <?php
    }
  }
?>