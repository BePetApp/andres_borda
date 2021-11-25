<?php 
include 'Views/html/head.php';
head('Eliminar registro');
?>
<body>
	<div class="container mx-auto py-4">
		<div class="deleteWarning mx-auto">
			<!-- Mostramos la advertencia  -->
		<p class="text-2xl text-center text-white">Estas a punto de <span class="text-red-500 font-bold">ELIMINAR</span> a:</p>
		<br>

		<!-- Se muetra el nombre y el correo en un div -->
		<div class="bg-red-900 w-full p-3 rounded-lg">
			<p class="text-3xl text-center text-white font bold">
				<?php echo $delUser->name . ' ' . $delUser->last_name?>
			</p>
			<p class="text-xl text-center text-gray-300 font bold">
				Email: <span class="text-gray-400"><?php echo $delUser->email ?></span>
			</p>
		</div>
		
		<div class="flex justify-between max-w-md p-2 mx-auto text-white">
			<a href="index.php?page=crudDelCon&Id=<?php echo $_GET['Id'] ?>" class="p-4 bg-red-600 rounded hover:bg-red-800">Eliminar</a>
			<a href="index.php?page=crud" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Cancelar</a>
		</div>
		</div>
	</div>
</body>
</html>
