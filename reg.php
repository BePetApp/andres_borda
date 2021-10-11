<?php 
    $conn = new mysqli("127.0.0.1", "root", null, "blog", 3308, "127.0.0.1:3308");
    $query = "SELECT * FROM avatares";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $res = mysqli_query($conn, $query)
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reg.css">
    <script src="https://kit.fontawesome.com/fe08a25bb7.js" crossorigin="anonymous"></script>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <title>Registrate</title>
</head>
<body>
    <div class="container">
        <div class="registro">
            <form action="thanks.php" method="post">
                <h1><span class="red">Burogu</span> Blog</h1>
                <div class="formulario">
                    <div>
                        <p>Digita tu nombre:</p>
                        <input type="text" name="Reg_name" placeholder="Tu nombre" required>
                    </div>
                    <div>
                        <p>Digita tu apellido: </p>
                        <input type="text" name="Reg_apl" placeholder="Tu apellido">
                    </div>
                    <div>
                        <p>Nickname: </p>
                        <input type="text" name="Reg_Nick" placeholder="Tu nick" required>
                    </div>
                    <div>
                        <p>Email:</p>
                        <input type="email" name="Reg_Email" placeholder="Email" required>
                    </div>
                    <div>
                        <p>Contraseña: </p>
                        <input type="password" name="Reg_Pass" placeholder="Password" required>
                    </div>
                    <div>
                        <p>Repite la contraseña: </p>
                        <input type="password" name="Reg_Pass_1" placeholder="Password" required>
                    </div>
                    <div>
                        <p>Selecciona tu avatar: </p>
                        <select name="Reg_av">
                        <?php 
                            while($row = mysqli_fetch_array($res))
                            {
                                echo '<option value="' . $row[0] . '">' . $row[1] ."</option>";
                            }
                            mysqli_close($conn);
                        ?>
                        </select>
                    </div>
                </div>
                <button>Enviar</button>
            </form>

        </div>
    </div>

</body>
</html>