<?php 
    $conn = new mysqli("127.0.0.1", "root", null, "blog", 3308, "127.0.0.1:3308");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $nick = mysqli_query($conn, "SELECT EXISTS (SELECT * FROM usuarios WHERE nickname = '$_POST[Reg_Nick]')");
    $nickResult = mysqli_fetch_row($nick);
    $avatar = $_POST['Reg_av']
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Thank You </title>
</head>
<body>
    <div class="flex justify-center items-center h-screen bg-black">
        <div class="text-white text-5xl text-center">
            <?php 
                if ($_REQUEST['Reg_Pass'] != $_REQUEST['Reg_Pass_1']){
                    echo 'Ojo, las contraseñas no coinciden... <br>';
                    echo '<br><a href="reg.php" class="text-red-500 font-bold underline">Volver</a>';
                }
                elseif ($nickResult[0] == 1){
                    echo 'Ojo, el nick que elegiste ( ' . $_POST['Reg_Nick'] . ' ) ya a sido tomado...<br>';
                    echo '<br><a href="reg.php" class="text-red-500 font-bold underline">Volver</a>';
                }
                else{
                    $query = "INSERT INTO usuarios (nombre, apellido, nickname, email, password, avatares_id)
                     VALUES ('$_REQUEST[Reg_name]', '$_REQUEST[Reg_apl]', '$_REQUEST[Reg_Nick]', '$_REQUEST[Reg_Email]', '$_REQUEST[Reg_Pass]', $avatar)";
                    
                    if (mysqli_query($conn, $query)){
                        echo 'Te has registrado correctamente. :) <br>';
                        echo '<br><a href="index.php" class="text-red-500 font-bold underline">Ir a Inicio</a>';
                    }
                    else{
                        echo 'Ha ocurrido un error. Lo sentimos. :( <br>';
                        echo '<br><a href="reg.php" class="text-red-500 font-bold underline">Volver</a>';
                    }
                }
            ?>
        </div>
    </div>
    
</body>
</html>