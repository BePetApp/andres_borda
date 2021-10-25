<?php 
require '../../connection.php';
  
$query = "SELECT * FROM avatares";
$res = mysqli_query($conn, $query)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="/blog/css/crudStyle.css">
  <title>Add avatar</title>

</head>
<body>

<!-- Este formulario recibe una imagen que será un avatar -->
  <div class="max-w-lg border-t-2 border-red-500 mx-auto my-5 text-white p-2 avatar">
    <form action="avatarValidate.php" method="post" enctype="multipart/form-data">
      <p class="p-2 text-center">Selecciona el <span class="text-red-500">NUEVO</span> avatar:</p>
      <input type="file" name="newavatar" accept="image/gif, .jpg, .png" required class="p-5 mx-auto"> <br>
      <div class="flex justify-between">
        <button class="p-3 bg-red-500 text-white rounded hover:bg-red-700 right" name="sendAvatar">Enviar</button>
        <a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Volver</a>  
      </div>
    </form>
  </div>

  <hr class="w-11/12 mx-auto pt-2 my-3 border-t-2 border-red-400">

  <!-- Este formulario es para eliminar uno de los avatares existentes  -->
  <div class="max-w-lg border-2 border-red-500 mx-auto my-5 text-white p-2 avatar mb-32">
    <form action="avatarValidate.php" method="post">
      <p class="p-2 text-center">Selecciona el avatar a <span class="text-red-500">ELIMINAR</span>:</p>
      <div class="flex gap-2 flex-wrap justify-between p-2 py-4">

      <!-- se listan todos los avatares realizando una consulta en la base de datos  -->
      <?php 
      while($row = mysqli_fetch_array($res))
      {
          echo "<div class=\"p-2 text-center avatars\">";
          echo "<input class=\"cursor-pointer\" type=\"radio\" name=\"idAvatar\" value=\"$row[0]\" required>";
          echo "<img class=\"mx-auto\" src=\"$row[1]\" alt=\"avatar\"></div>";
      }
      mysqli_close($conn); // <- se cierra la conexion a la base de datos
      ?>
      </div>
      <div class="flex justify-between p-4">
        <button class="p-3 bg-red-500 text-white rounded hover:bg-red-700 right" name="delAvatar">Enviar</button>
        <a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Volver</a>  
      </div>
    </form>
  </div>
</body>
</html>

<?php

// Se evaluan los valores resividos por $_GET[] 
// 0 & 1 son eventos de insercion de un nuevo avatr
// 3 & 4 corresponden a eventos en el proceso de eliminacion

// Eventos de insercion :
if (isset($_GET['avatar']) && $_GET['avatar'] == 1){
  ?>
    <div class="text-center text-white bg-green-500 p-5 fixed w-full bottom-2 z-50">
        Todo ha salido bien :)
    </div>
<?php 
}
elseif (isset($_GET['avatar']) && $_GET['avatar'] == 0){
  ?>
    <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
        Lo sentimos, ha ocurrido un error interno! :(
    </div>
<?php 
}


// Eventos de eliminacion:
if (isset($_GET['avatar']) && $_GET['avatar'] == 3){
  ?>
    <div class="text-center text-white bg-green-500 p-5 fixed w-full bottom-2 z-50">
        Se ha eliminado un avatar :)
    </div>
<?php 
}
elseif (isset($_GET['avatar']) && $_GET['avatar'] == 4){
  ?>
    <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
        Lo sentimos, ha ocurrido un error interno! :(
    </div>
<?php 
}
?>