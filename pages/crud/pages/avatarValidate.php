<?php 
require '../../connection.php'; // <- conexion a la base de datos

if (isset($_POST['sendAvatar'])){

  // Le damos un nombre Unico a nuestro avatar  
  $avatarName = uniqid();

  /* 
  Para evitar errores con la ruta en PHP debo hacerlo de la siguiente manera: 
  1. usar $_SERVER['DOCUMENT_ROOT'] para obtener la ruta absoluta de la carpeta 
  del proyecto : C:\laragon\www (en mi caso)
  2. Añadir la ruta de los avatares: /Blog/Img/avatar/  a la anterior; qudando de  
  la siguiente manera:  C:\laragon\www/Blog/Img/avatar/
  */
  $Path = $_SERVER['DOCUMENT_ROOT'];
  $avatarPath = "/Blog/Img/avatar/";

  // Evaluamos la extension del archivo, pudiendo ser solamente los que están en el switch
  switch ($_FILES['newavatar']['type']) {
    case 'image/png':
      $avatarName .= ".png";
      break;
    case 'image/jpg':
      $avatarName .= ".jpg";
      break;
    case 'image/gif':
      $avatarName .= ".gif";
      break;
  }

  // Completamos la ruta anterior (C:\laragon\www/Blog/Img/avatar/) con el nombre del archivo
  // esto con la fnalidad de realizar el cambio de carpeta
  $Path .= $avatarPath;

  // Movemos la imagen de la carpeta temp a nuestro directorio 
  move_uploaded_file($_FILES['newavatar']['tmp_name'], $Path . $avatarName);

  // Realizamos la insercion en la base de datos
  $q = "INSERT INTO avatares (enlace) VALUES ('$avatarPath$avatarName')";

  // Eniamos mensajes de error o exito: 1 = exito || 0 = error
  if (mysqli_query($conn, $q)){
    header('Location: avatar.php?avatar=1');
  }
  else{
    header('Location: avatar.php?avatar=0');
  }
}
elseif (isset($_POST['delAvatar'])){
  $idAvatar = $_POST['idAvatar'];

  /*
  Se procederá a reemplazar el valor de la llave del avatar (foreign key) en la tabla 'usuarios'.
  Para esto, se usara el 'id' del primer registro de la tabla 'avatares' (Siempre y cuando no sea el mismo 
  que el id que se está eliminando)
  */
  $dataAvAvatar = mysqli_query($conn, "SELECT id FROM avatares WHERE id != $idAvatar LIMIT 1") or die ("Error al obtener el id" . mysqli_error($conn));
  $dataAv = mysqli_fetch_row($dataAvAvatar);

  // Consulta de reemplazo 
  $replace = "UPDATE usuarios SET avatares_id = $dataAv[0] WHERE avatares_id = $idAvatar";

  if (mysqli_query($conn, $replace)){

    // Obetenemos el enlace del avatar para poder eliminarlo
    $delImgPath = mysqli_query($conn, "SELECT enlace FROM avatares WHERE id = $idAvatar") or die ("Error al obtener el id" . mysqli_error($conn));
    $delImgPathRes = mysqli_fetch_row($delImgPath); // <- array con el 'Path' de la imagen

    // Elimina de la tabla el avatar con el id $idAvatar(id a eliminar)
    $qAvatar = "DELETE FROM avatares WHERE id = $idAvatar";
    

    if (mysqli_query($conn, $qAvatar)){

      // Escenario de exito:

      // Se elimina de la carpeta del proyecto el archivo del avatar
      $imgPath = $_SERVER['DOCUMENT_ROOT'];
      $imgPath .= $delImgPathRes[0];
      unlink($imgPath);

      // Redireccionamos a la pagina principal de avatares
      header('Location: avatar.php?avatar=3');
    }else{
      // Escenario de error
      header('Location: avatar.php?avatar=4?');
    }  
  }
  else{
      // Escenario de error
    header('Location: avatar.php?avatar=4?');
  }
}
else{

  // Si no hay datos en $_POST se redirecciona automaticamente
  header('Location: avatar.php?');
}

mysqli_close($conn);
?>
