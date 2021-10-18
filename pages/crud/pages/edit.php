<?php 
	require '../../connection.php';
	require 'head.php'; // <- Trae la funcion 'head' la cual escribe el head y el title 
	
	head('Actualizar registro'); // <- Aqui ponemos el nombre de la pagina

	// El error producido al poner $idAModificar = "empty" es aproposito
	// Esto con el fin de evitar algun error de sintaxis de sql en $sqlEditReg
	// Podria surguir un error a la hora de validar los datos pues, como se cargan los valores en la misma
	// paguina, $_POST['RegId'] seria null generando un error. En resumen, asi lo puedo controlar
	if (isset($_POST['RegId'])){
		$idAModificar = $_POST['RegId'];
	}
	else{
		$idAModificar = "empty";
	}

	if ($idAModificar != 'empty'):	

		$sqlEditQuery = "SELECT nombre, apellido, nickname, email FROM usuarios WHERE id = $idAModificar";
		$sqlEditQueryRes = mysqli_query($conn, $sqlEditQuery);

		if ($sqlEditQueryRes):
			$data = mysqli_fetch_assoc($sqlEditQueryRes);

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
		<form method="POST" autocomplete="off">
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
			echo "<div class=\"fixed top-2 w-full p-3 text-white text-center bg-red-500 z-50\">Error en la consulta</div>";
		endif;
	elseif (isset($_POST['Id'])):
		require 'validarEdit.php';
	else:
		echo "<div class=\"fixed top-2 w-full p-3 text-white text-center bg-red-500 z-50\">Error en la consulta</div>";
	endif
?>
</body>
</html>