<?php 
include 'Views/html/head.php';
head('Eliminar registro');
?>
<body>
<div class="container mx-auto text-white px-4">

	<!-- Contenedor del Formulario con algunos textos  -->
	<div class="form-reg max-w-3xl mx-auto my-4 rounded-lg pt-1">
		<h1 class="text-center text-gray-200 text-2xl my-4">Formulario de Registro</h1>
		<p class="text-center font-bold">-- Modifica solamente los campos que quieras alterar --</p>
	
		<!-- Formulario -->

		<form action="index.php?page=crudEditCon" method="POST" autocomplete="off">
			<!-- 
				Enviamos los datos del formulario a la misma pagina.
				En todos los campos a modificar estará el valor actual de los datos del usuario. 
				La idea es que se editen solamente los campos deseados
			 -->

			<!-- Enviamos el ID del usuario -->
			<input type="hidden" name="Id" value="<?php echo $_GET['Id']?>">

			<div class="grid grid-cols-1 gap-9 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2 my-8">
				<div>
					<p>Digita tu nombre: </p>
					<input type="text" name="name" value="<?php echo $udUser->name?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white" required>
				</div>
				<div>
					<p>Digita tu apellido: </p>
					<input type="text" name="lastname" value="<?php echo $udUser->lastName?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white">
				</div>
			</div>

			<!-- Por cada div hay dos inputs, esto por temas de responsive -->

			<div class="grid grid-cols-1 gap-9 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 2xl:grid-cols-2 my-8">
				<div>
					<p>Digita tu Nick: </p>
					<input type="text" name="nick" value="<?php echo $udUser->nickName?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white" required>
				</div>
				<div>
					<p>Digita tu correo: </p>
					<input type="email" name="email" value="<?php echo $udUser->email?>" class="w-full mt-2 p-1 rounded text-gray-500 bg-gray-800 focus:bg-gray-900 focus:text-white" required>
				</div>
			</div>
			
			<!-- Botonoes de accion -->
			<div class="flex flex-row justify-between">
				<button type="submit" name="send" class="p-4 bg-green-800 rounded hover:bg-green-900">Actualizar</button>
				<a href="index.php?page=crud" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Cancelar</a>
			</div>
		</form>
		<!-- fin formulario -->
	</div>
</div>
</body>
</html>