<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

  <link rel="stylesheet" href="VIews/css/crudStyle.css">
  <title>Add avatar</title>

</head>
<body>

<!-- Este formulario recibe una imagen que será un avatar (Subimos un nuevo avatar)-->
  <div class="max-w-lg border-t-2 border-red-500 mx-auto my-5 text-white p-2 avatar">
    <form action="index.php?page=crudAvAdd" method="post" enctype="multipart/form-data">
      <p class="p-2 text-center">Selecciona el <span class="text-red-500">NUEVO</span> avatar:</p>
      <input type="file" name="newavatar" accept="image/gif, .jpg, .png" required class="p-5 mx-auto"> <br>
      <div class="flex flex-row-reverse justify-between">
        <button class="p-3 bg-red-500 text-white rounded hover:bg-red-700 right" name="sendAvatar">Enviar</button>
        <a href="index.php?page=crud" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Volver</a>  
      </div>
    </form>
  </div>

  <!-- Hr Para separar los formularios -->
  <hr class="w-11/12 mx-auto pt-2 my-3 border-t-2 border-red-400">

  <!-- Este formulario es para eliminar uno de los avatares existentes  -->
  <div class="max-w-lg border-2 border-red-500 mx-auto my-5 text-white p-2 avatar mb-32">
    <form action="index.php?page=crudAvDel" method="post">
      <p class="p-2 text-center">Selecciona el avatar a <span class="text-red-500">ELIMINAR</span>:</p>
      <div class="flex gap-2 flex-wrap justify-between p-2 py-4">

      <!-- se listan todos los avatares realizando una consulta en la base de datos  -->
      <?php foreach($avatars as $avatar): ?>
        <div class="p-2 text-center avatars">
          <input class="cursor-pointer" type="radio" name="idAvatar" value="<?php echo $avatar->id ?>" required>
          <img class="mx-auto" src="<?php echo $avatar->link ?>" alt="avatar"></div>
      <?php endforeach?>

      </div>
      <div class="flex flex-row-reverse justify-between p-4">
        <button class="p-3 bg-red-500 text-white rounded hover:bg-red-700 right" name="delAvatar">Enviar</button>
        <a href="index.php?page=crud" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Volver</a>  
      </div>
    </form>
  </div>
</body>
</html>
