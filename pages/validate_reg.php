<?php 
    $conn = new mysqli("127.0.0.1", "root", null, "blog", 3308, "127.0.0.1:3308");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['Enviar']))
    {
        $nick = mysqli_query($conn, "SELECT EXISTS (SELECT * FROM usuarios WHERE nickname = '$_POST[Reg_Nick]')");
        $nickResult = mysqli_fetch_row($nick);
        $avatar = $_POST['Reg_av'];

        if ($_POST['Reg_Pass'] != $_POST['Reg_Pass_1']){
            echo '1';
            ?>
                <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                    Oops, Las contraseñas no coinciden. Por favor, intentalo de nuevo.
                </div>
            <?php
        }
        elseif ($nickResult[0] == 1){
            echo 2;
            ?>
                <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                    Oh no, Ese nick, ya ha sido tomado. Por favor, intentalo de nuevo.
                </div>
            <?php
        }
        else{
            $query = "INSERT INTO usuarios (nombre, apellido, nickname, email, password, avatares_id)
                    VALUES ('$_REQUEST[Reg_name]', '$_REQUEST[Reg_apl]', '$_REQUEST[Reg_Nick]', '$_REQUEST[Reg_Email]', '$_REQUEST[Reg_Pass]', $avatar)";
                    
            if (mysqli_query($conn, $query)){
                ?>
                    <div class="text-center text-white bg-green-500 p-5 fixed w-full bottom-2 z-50">
                        Gracias, te has registrado correctamente! :)
                    </div>
                <?php 
            }
            else{
                ?>
                    <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                        Lo sentimos, ha ocurrido un error interno! :(
                    </div>
                <?php 
            }
            
        }  
    }
?>