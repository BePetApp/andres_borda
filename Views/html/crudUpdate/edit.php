<?php 
	require '../../connection.php';
	require '../../sessionValidate.php';
	require 'head.php'; // <- Trae la funcion 'head' la cual escribe el head y el title 
	
	head('Actualizar registro'); // <- Aqui ponemos el nombre de la pagina

	/*
	Para evitar problemas con el SQL controlamos el valor de $idAModificar:

		Si esta seteado $_GET['RegId'] entonces $idAModificar tomara ese valor.
		Si no, su valor sera "empty"
	*/
	if (isset($_GET['RegId'])){
		$idAModificar = $_GET['RegId'];
	}
	else{
		$idAModificar = 'empty';
	}

	// Si $idAModificar es empty significa que no hay datos en $_GET
	// Tambien, si $idAModificar es empty, podria significar que se ha realizado una modificacion
	if ($idAModificar != 'empty'):	

		// Seleccionamos la informacion que podrá ser modificada
		$sqlEditQuery = "SELECT nombre, apellido, nickname, email FROM usuarios WHERE id = $idAModificar";
		$sqlEditQueryRes = mysqli_query($conn, $sqlEditQuery);

		// Si la consulta nos devuelve un resultado con al menos una fila
		// realizamos el procedimiento de edicion
		if ($sqlEditQueryRes && mysqli_num_rows($sqlEditQueryRes) > 0):
			$data = mysqli_fetch_assoc($sqlEditQueryRes);

			// Datos actuales del usuario
			$oldData = array(
				'name' => $data['nombre'],
				'apellido' => $data['apellido'],
				'nick' => $data['nickname'],
				'email' => $data['email']
			)
?>
<body>
<div class="container mx-auto text-white px-4">

	<!-- Contenedor del Formulario con algunos textos  -->
	<div class="form-reg max-w-3xl mx-auto my-4 rounded-lg pt-1">
		<h1 class="text-center text-gray-200 text-2xl my-4">Formulario de Registro</h1>
		<p class="text-center font-bold">-- Modifica solamente los campos que quieras alterar --</p>
	
		<!-- Formulario -->

		<form action="./edit.php" method="POST" autocomplete="off">
			<!-- 
				Enviamos los datos del formulario a la misma pagina.
				En todos los campos a modificar estará el valor actual de los datos del usuario. 
				La idea es que se editen solamente los campos deseados
			 -->

			<!-- Enviamos el ID del usuario -->
			<input type="hidden" name="Id" value="<?php echo $idAModificar?>">

			<div class="grid grid-cols-1 gap-9 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2 my-8">
				<div>
					<p>Digita tu nombre: </p>
					<input type="text" name="name" value="<?php echo $oldData['name']?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white" required>
				</div>
				<div>
					<p>Digita tu apellido: </p>
					<input type="text" name="lastname" value="<?php echo $oldData['apellido']?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white">
				</div>
			</div>

			<!-- Por cada div hay dos inputs, esto por temas de responsive -->

			<div class="grid grid-cols-1 gap-9 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2 my-8">
				<div>
					<p>Digita tu Nick: </p>
					<input type="text" name="nick" value="<?php echo $oldData['nick']?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white" required>
				</div>
				<div>
					<p>Digita tu correo: </p>
					<input type="email" name="email" value="<?php echo $oldData['email']?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white" required>
				</div>
			</div>
			
			<!-- Botonoes de accion -->
			<div class="flex flex-row justify-between">
				<button type="submit" name="send" class="p-4 bg-green-800 rounded hover:bg-green-900">Actualizar</button>
				<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Cancelar</a>
			</div>
		</form>
		<!-- fin formulario -->
	</div>
</div>

<!-- Si sucede algun problema con la consulta -->
<?php
		else:
			?>
			<div class="fixed top-2 w-full p-5 text-white text-center bg-red-500 z-50 hover:bg-red-700">
				<p class="mb-4">Error en la actualizacion - ID </p>
				<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
			</div>
			<?php
		endif;

	// Si $_POST['Id'] esta seteado significa que se ha realizado una modificacion y se 
	// han enviado los valores a editar.
	elseif (isset($_POST['Id'])):

		// El Update se realiza en validarEdit.php
		require 'validarEdit.php';

	// Si ocurre algún problema inesperado nos mostrará el siguiente mensaje de error
	else:
		?>
		<div class="fixed top-2 w-full p-5 text-white text-center bg-red-500 z-50 hover:bg-red-700">
			<p class="mb-4">Error en la actualizacion</p>
			<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
		</div>
		<?php
	endif;

	// Cerramos la conexión con MySql
	mysqli_close($conn);
?>
</body>
</html>