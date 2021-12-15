<?php 
use Controllers\Messages;
include_once 'Views/html/head.php'; 
head('CRUD') 
?> 
<body>
  <div class="container mx-auto text-white">
    <div class="flex justify-between items-center header mx-auto my-2">
      <!-- Encabezado -->
      <div>
        <h2 class="text-3xl py-2">Lista de Registros <span class="italic text-gray-500 duration-300 hover:text-red-500"><a href="index.php">Blog Burogu</a></span></h2>
      </div>
    </div>
    <div class="flex justify-between items-center header mx-auto my-2">
      <!-- Opciones -->
      <a class="py-1 px-2 bg-purple-600 rounded hover:bg-purple-900" href="index.php?page=crudAv">Añadir/Borrar avatar</a>
      <a class="py-1 px-2 bg-green-600 rounded hover:bg-green-900" href="index.php?page=crudAdd">Añadir User</a>
      
    </div>
    <!-- Div contenedor de la tabla -->
    <div class="flex flex-col items-center justify-center flex-wrap"> 
      <!-- Tabla que listará los datos extraidos de la base de datos -->
      <table id="dataTable" class="data-table nowrap">
      <thead>
          <tr>
              <th>Nombre</th>
              <th>Nick</th>
              <th>Email</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      </table>               
    </div>
  </div>
  <!-- Mensaje -->
  <?php Messages::showMessage() ?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="Views/js/main.js" type="text/javascript"></script>
</body>
</html>
