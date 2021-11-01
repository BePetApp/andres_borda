<?php
    require '../connection.php';
    require './pages/head.php';
    require '../sessionValidate.php';
	
	head('Crud');

    // Cantidad de registros por pagina
    $regPerPage = 4;

    // validacion paginacion
    if (isset($_GET['regStart'])){
        $regStart = $_GET['regStart'];
    }
    else{
        $regStart = 0;
    }

    // Se realiza la consulta con base al filtro de nombre (form)
    if (isset($_POST['SearchReg'])){
        $select = "SELECT id, nombre, apellido, nickname, email FROM usuarios WHERE nickname like '%$_POST[SearchReg]%'";
    }
    // Si no se envian datos de usuarios en $_POST['SearchReg'] se ejecuta una consulta general 
    else{ 
        $select = "SELECT id, nombre, apellido, nickname, email FROM usuarios LIMIT $regStart, $regPerPage";
    }

    // Consulta. Si da error, se corta la ejecucion del script 
    $selected = mysqli_query($conn, $select) or die ("Error en select: " . mysqli_error($conn));
?>
<body>
    <div class="container mx-auto text-white">
        <div class="flex justify-between items-center header mx-auto my-4">
            <div><h2 class="text-3xl py-2">Lista de Registros <span class="italic text-gray-500 duration-300 hover:text-red-500"><a href="/Blog">Blog Burogu</a></span></h2></div>
        </div>
        <div class="flex justify-between items-center header mx-auto my-4">
            <a class="py-1 px-2 bg-blue-500 rounded hover:bg-blue-800" href="./crud.php">RESET</a>
            <a class="py-1 px-2 bg-green-500 rounded hover:bg-green-800" href="pages/avatar.php">Añadir/Borrar avatar</a>
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
                
                <?php 
                // ($printed) <-- control de registros impresos. Si se imprimen menos de la cantidad definida en $regPerPage entonces 
                // el botón next no tendrá función 
                $printed = 0; 
                    while ($sRow = mysqli_fetch_array($selected)){
                        $printed ++;
                        ?>
                        <tr>
                            <td><?php echo $sRow[1] . ' ' . $sRow[2]?></td>
                            <td><?php echo $sRow[3]?></td>
                            <td><?php echo $sRow[4]?></td>
                            <td>
                                <!-- se envia el ID del registro a editar por el metodo GET (en la url) -->
                                <a class="py-1 px-2 bg-yellow-500 rounded hover:bg-yellow-800" href="./pages/edit.php?RegId=<?php echo $sRow[0]?>">Edit</a>
                            </td>
                            <td>
                                <!-- Enviamos el ID y algunos datos del registro a eliminar -->
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
                mysqli_close($conn);
                ?>
            </tbody>
            </table>

            <!-- Paginacion (noob) -->
            <div class="text-center text-2xl">
                <?php
                // Si inicio ($regStart) no es 0 entonces no se puede ir atras (pues no habrá registros)
                if ($regStart <= 0){
                    echo "atras";
                }
                // Si inicio ($regStart) es diferente de 0 entonces le restamos la cantidad de registrod por pargina ($regPerPage)
                else{
                    ?>
                    <a class="text-green-500" href="./crud.php?regStart=<?php echo $regStart - $regPerPage?>">atras</a>
                    <?php
                }
                echo " | ";

                // Si se imprimen la misma cantidad de registrod por pargina ($regPerPage) entonces podremos 
                // buscar los siguientes. Si no, no. :v
                if ($printed == $regPerPage){
                    ?>
                    <a class="text-green-500" href="./crud.php?regStart=<?php echo $regStart + $regPerPage?>">next</a>
                    <?php
                }
                else{
                    echo "next";
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>
