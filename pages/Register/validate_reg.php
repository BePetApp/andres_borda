<?php 
    include '../connection.php';

    if (isset($_POST['Enviar']))
    {
        // "SELECT SUM(IF(nickname = '$_POST[Reg_Nick]', '1', '0')) AS nick, SUM(IF(email = '$_POST[Reg_Email]', '1', '0')) AS email FROM usuarios";
        $email = mysqli_query($conn, "SELECT EXISTS (SELECT * FROM usuarios WHERE email = '$_POST[Reg_Email]')");
        $emailResult = mysqli_fetch_row($email);

        if ($emailResult[0] == 0){
            $nick = mysqli_query($conn, "SELECT EXISTS (SELECT * FROM usuarios WHERE nickname = '$_POST[Reg_Nick]')");
            $nickResult = mysqli_fetch_row($nick);

            if ($_POST['Reg_Pass'] != $_POST['Reg_Pass_1']){
                ?>
                    <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                        Oops, Las contraseñas no coinciden. Por favor, intentalo de nuevo.
                    </div>
                <?php
            }
            elseif ($nickResult[0] == 1){
                ?>
                    <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                        Oh no, Ese nick, ya ha sido tomado. Por favor, intentalo de nuevo.
                    </div>
                <?php
            }
            else{
                $nombre = $_POST['Reg_name'];
                $apellido = $_POST['Reg_apl'];
                $nick = $_POST['Reg_Nick'];
                $mail = $_POST['Reg_Email'];
                $pass = password_hash($_POST['Reg_Pass'], PASSWORD_BCRYPT);
                $avatar = $_POST['Reg_av'];
           
                $query = "INSERT INTO usuarios (nombre, apellido, nickname, email, password, avatares_id)
                VALUES ('$nombre', '$apellido', '$nick', '$mail', '$pass', $avatar)";
                        
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
        else{
            ?>
                <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                    Oh no, Ese email, ya ha sido tomado. Por favor, intentalo de nuevo.
                </div>
            <?php
        }
    }

    mysqli_close($conn);
?>