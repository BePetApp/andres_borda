<?php 
include_once 'Views/html/head.php'; 
head('CRUD') 
?> 
<body>
  <div class="container mx-auto text-white">
    <div class="flex justify-between items-center header mx-auto my-4">
      <!-- Encabezado -->
      <div>
        <h2 class="text-3xl py-2">Lista de Registros <span class="italic text-gray-500 duration-300 hover:text-red-500"><a href="index.php">Blog Burogu</a></span></h2>
      </div>
    </div>
    <div class="flex justify-between items-center header mx-auto my-4">
      <!-- Opciones -->
      <a class="py-1 px-2 bg-blue-600 rounded hover:bg-blue-900" href="index.php?page=Crud">RESET</a>
      <a class="py-1 px-2 bg-purple-600 rounded hover:bg-purple-900" href="index.php?page=CrudAddAv">Añadir/Borrar avatar</a>
      <a class="py-1 px-2 bg-green-600 rounded hover:bg-green-900" href="index.php?page=CrudAdd">Añadir User</a>
      <form method="post" autocomplete="off">
        Busca: 
        <input type="text" name="SearchReg" placeholder="Search" class="p-1 rounded text-gray-500 bg-gray-800 outline-none focus:bg-gray-900 focus:text-white">
        <button class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800">Enviar</button>
      </form>
    </div>
    <!-- Div contenedor de la tabla -->
    <div class="flex flex-col items-center justify-center gap-2 flex-wrap"> 
      <!-- Tabla que listará los datos extraidos de la base de datos -->
      <table class="data-table my-4">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Nickname</th>
              <th>Email</th>
              <th colspan="2">Acciones</th>
          </tr>
      </thead>
      <tbody>
          
          <?php foreach ($datas as $user):?>
          <tr>
              <td><?php echo $user->name . ' ' . $user->last_name?></td>
              <td><?php echo $user->nickname?></td>
              <td><?php echo $user->email?></td>
              <td>
                  <!-- se envia el ID del registro a editar por el metodo GET (en la url) -->
                  <a class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800" href="index.php?page=CrudEdit&Id=<?php echo $user->id?>">Edit</a>
              </td>
              <td>
                  <!-- Enviamos el ID y algunos datos del registro a eliminar -->
                  <a class="py-1 px-2 bg-red-500 rounded hover:bg-red-800" href="index.php?page=CrudDel&Id=<?php echo $user->id?>">Delete</a>
              </td>
          </tr>
          <?php endforeach ?>
      </tbody>
      </table>               
    </div>
  </div>
</body>
</html>
