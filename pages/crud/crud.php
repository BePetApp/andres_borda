<?php
    require '../connection.php';
    require './pages/head.php';
	
	head('Crud');

    if (isset($_POST['RegPerPage'])){
        $RegPerPage = $_POST['RegPerPage'];
    }
    else{
        $RegPerPage = 5;
    }

    if (isset($_POST['SearchReg'])){
        $select = "SELECT id, nombre, apellido, nickname, email FROM usuarios WHERE nickname = '$_POST[SearchReg]'";
    }
    else{
        $select = "SELECT id, nombre, apellido, nickname, email FROM usuarios LIMIT $RegPerPage";
    }

    $selected = mysqli_query($conn, $select) or die ("Error en select: " . mysqli_error($conn));
?>
<body>
    <div class="container mx-auto text-white">
        <div class="flex justify-between items-center header mx-auto my-4">
            <div><h2 class="text-3xl py-2">Lista de Registros <span class="italic text-gray-500"><a href="../../index.php">Blog Burogu</a></span></h2></div>
        </div>
        <div class="flex justify-between items-center header mx-auto my-4">
            <form method="post">
                Cant. Registros: 
                <input type="number" name="RegPerPage" min="1" class="p-1 rounded text-gray-500 bg-gray-800 outline-none focus:bg-gray-900 focus:text-white">
                <button class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800">Enviar</button>
            </form>
            <a class="py-1 px-2 bg-blue-500 rounded hover:bg-blue-800" href="./crud.php">RESET</a>
            <form method="post" autocomplete="off">
                Busca: 
                <input type="text" name="SearchReg" placeholder="Tal cual esta" class="p-1 rounded text-gray-500 bg-gray-800 outline-none focus:bg-gray-900 focus:text-white">
                <button class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800">Enviar</button>
            </form>
        </div>
        <!-- Div contenedor de la tabla -->
        <div class="flex items-center justify-center gap-2 flex-wrap"> 
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
                
                <?php 
                    while ($sRow = mysqli_fetch_array($selected)){
                        ?>
                        <tr>
                            <td><?php echo $sRow[1] . ' ' . $sRow[2]?></td>
                            <td><?php echo $sRow[3]?></td>
                            <td><?php echo $sRow[4]?></td>
                            <td>
                                <form action="./pages/edit.php" method="post">
                                    <button class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800" name="RegId" value="<?php echo $sRow[0]?>">Edit</button>
                                </form>
                            </td>
                            <td>
                                <form action="./pages/delete.php" method="post">
                                    <button class="py-1 px-2 bg-red-500 rounded hover:bg-red-800" value="<?php echo $sRow[0]?>" name="delReg">Delete</button>

                                    <!-- Extra info -->
                                    <input type="hidden" name="delname" value="<?php echo $sRow[1] . ' ' . $sRow[2]?>" >
                                    <input type="hidden" name="delemail" value="<?php echo $sRow[4]?>">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
            </table>
        </div>
    </div>
</body>
</html>
