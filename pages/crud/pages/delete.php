<?php 
	require '../../connection.php';
	require 'head.php';

	head('Borrar Registro'); // <-- viene de head.php | pone el head en el archivo
	echo "<body>";

	// El error producido al poner $RegId = "empty" es aproposito
	// Esto con el fin de evitar algun error de sintaxis de sql en $sqlDeleteReg
	// Podria surguir un error a la hora de validar los datos pues, como se cargan los valores en la misma
	// paguina, $_POST['delReg'] seria null generando un error. En resumen, asi lo puedo controlar
	if(isset($_POST['delReg'])){
		$RegId = $_POST['delReg'];
	}
	else{
		$RegId = "empty";
	}

	if ($RegId != 'empty' && !isset($_POST['confirmed'])):
		$nombre = $_POST['delname'];
		$email = $_POST['delemail'];
?>
	<div class="container mx-auto py-4">
		<div class="deleteWarning mx-auto">
			<!-- Mostramos la advertencia  -->
		<p class="text-2xl text-center text-white">Estas a punto de <span class="text-red-500 font-bold">ELIMINAR</span> a:</p>
		<br>

		<!-- Se muetra el nombre y el correo en un div -->
		<div class="bg-red-900 w-full p-3 rounded-lg">
			<p class="text-3xl text-center text-white font bold">
				<?php echo $nombre ?>
			</p>
			<p class="text-xl text-center text-gray-300 font bold">
				Email: <span class="text-gray-400"><?php echo $email?></span>
			</p>
		</div>
		
		<div class="flex justify-between max-w-md p-2 mx-auto text-white">
			<form method="post">
				<button value="<?php echo $RegId ?>" name="confirmed" class="p-4 bg-red-600 rounded hover:bg-red-900">ELIMINAR</button>
			</form>
			<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Cancelar</a>
		</div>
		</div>
	</div>
<?php
	elseif (isset($_POST['confirmed'])):
		$delete = "DELETE FROM usuarios WHERE id = $_POST[confirmed]";

		if (mysqli_query($conn, $delete)){
			?>
			<div class="fixed top-2 w-full p-5 text-white text-center bg-green-500 z-50">
				<p class="mb-4">Se ha eliminado un registro</p>
				<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
			</div>
			<?php
		}
		else{
			?>
			<div class="fixed top-2 w-full p-5 text-white text-center bg-red-500 z-50 hover:bg-red-700">
				<p class="mb-4">Error en la eliminacion</p>
				<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
			</div>
			<?php
		}
	else:
		?>
		<div class="fixed top-2 w-full p-5 text-white text-center bg-red-500 z-50 hover:bg-red-700">
			<p class="mb-4">Error en la eliminacion - No hay parametros</p>
			<a href="../crud.php" class="p-4 bg-gray-600 rounded hover:bg-gray-800">Regresar</a>
		</div>
		<?php
	endif;
	mysqli_close($conn);
?>
</body>
</html>
