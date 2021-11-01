<?php
    include './pages/connection.php';
    session_start();

    if (isset($_SESSION['status']) && $_SESSION['status'] == 1)
    {
        include 'nbtrue.php';
    }
    elseif (isset($_POST['Log_Enter']))
    {
        // User credentials
        $userNick = $_POST['Log_Nick'];
        $userPass = $_POST['Log_Pass'];

        //sql query
        $nick = mysqli_query($conn, "SELECT EXISTS (SELECT * FROM usuarios WHERE nickname = '$userNick')");
        $nickResult = mysqli_fetch_row($nick);

        if ($nickResult[0] == 0){
            include 'nbfalse.php';
            ?>
                <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                    Oops, Usuario inexistente.
                </div>
            <?php
        }
        else{
            $pass = mysqli_query($conn, "SELECT password FROM usuarios WHERE nickname = '$userNick'");

            if ($pass){
                $passResult = mysqli_fetch_row($pass);

                if (!password_verify($userPass, $passResult[0])){
                    include 'nbfalse.php';
                    ?>
                        <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                            Oops, Contraseña equivocada.
                        </div>
                    <?php
                }
                else{
                    $_SESSION['user'] = $userNick;
                    $_SESSION['status'] = 1;

                    include 'nbtrue.php';
                    ?>
                        <div class="text-center text-white bg-green-500 p-4 rounded-r-full fixed left-0 bottom-2 z-50">
                            Sesion Iniciada
                        </div>
                    <?php
                }
            } else {
                include 'nbfalse.php';
                ?>
                    <div class="text-center text-white bg-red-500 p-5 fixed w-full bottom-2 z-50">
                        Oh no. Ha sucedido un error interno. :(
                    </div>
                <?php
            }
        }
    }
    else
    {
        include 'nbfalse.php';
    }

    mysqli_close($conn);
?>