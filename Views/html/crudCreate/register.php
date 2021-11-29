<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link rel="stylesheet" href="Views/css/reg.css">
    <script src="https://kit.fontawesome.com/fe08a25bb7.js" crossorigin="anonymous"></script>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <title>Registrate</title>
</head>
<body>
    <div class="container pb-20 mx-auto">
        <div class="registro mt-2 mx-auto">
            <form action="index.php?page=crudAddCon" method="post" autocomplete="off">
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
                </div>
                <div class="py-3">
                    <p>Selecciona tu avatar: </p>
                    
                    <div class="flex gap-x-1 gap-y-2 text-center justify-between flex-wrap">
                        
                    <!-- Listamos los avatares con un while -->
                    <?php while($row = $av->fetch_object()): ?>
                            <div class="p-2 text-center avatar">
                                <input class="cursor-pointer" type="radio" name="Reg_av" value="<?php echo $row->id?>" required>
                                <img class="mx-auto" src="<?php echo $row->link?>" alt="avatar">
                            </div>
                    <?php endwhile?>
                    </div>
                </div>
                <div class="buttons">
                    <!-- <button value="Enviar">Enviar</button> -->
                    <input type="submit" name="Enviar" value="Enviar" class="text-white p-4 bg-red-500 cursor-pointer hover:bg-red-800">
                    <a href="index.php?page=crud" class="text-white p-4 bg-gray-500 cursor-pointer hover:bg-gray-800">Volver</a>
                </div>
            </form>
        </div>
        <!-- Mensaje -->
        <?php Messages::showMessage() ?>
</body>
</html>