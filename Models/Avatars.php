<?php 

namespace Models;

use Models\DataBase;

class Avatars extends DataBase{

  // Seleccionamos la tabla en la que se ejecutarán las consultas
  public $table =  'Avatars';

  // Propiedades de la clase
  public $id;
  public $link;  


  /**
   * Realiza la insercion de un nuevo avatar dandole un nombre aleatorio
   * 
   * @return int 6600 cuando la insercion se realiza correctamente
   * @return int 6699 cuando ocurre algun error en la consulta 
   */
  public static function addAvatar()
  {
    // Nombre unico para el avatar
    $avatarName = uniqid();

    // Path en la cual sera guardado el nuevo avatar
    $avatarPath = "Views/img/avatar/";

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

    // La path finalmente sería la ruta de la carpeta + el nombre del archico creado anteriormente en el switch
    $path = $avatarPath . $avatarName;

    // Movemos la imagen de la carpeta temp a nuestro directorio 
    move_uploaded_file($_FILES['newavatar']['tmp_name'], $path);

    // Realizamos la insercion en la base de datos
    $conection = new DataBase;
    $conection->connect();
    $sql = $conection->conn->prepare("INSERT INTO Avatars (link) VALUES (?)");
    $sql->bind_param('s', $path);

    if ($sql->execute()) {
      return "a50";
    } else {
      return "e509";
    }
  }

  /**
   * Elimina un avatar de la tabla __avatars__ eliminando tabien el archivo en cuestion
   */
  public function deleteAvatar($idAvatar)
  {
    /*
    Se procederá a reemplazar el valor de la llave del avatar (foreign key) en la tabla 'usuarios'.
    Para esto, se usara el 'id' del primer registro de la tabla 'avatares' (Siempre y cuando no sea el mismo 
    que el id que se está eliminando)
    */
    $this->connect();
    $idFirstAvatar = $this->conn->query("SELECT id FROM Avatars WHERE id != $idAvatar LIMIT 1");
    $idFirstAvatar = $idFirstAvatar->fetch_row();

    // Consulta de reemplazo 
    $replace = $this->conn->prepare("UPDATE Users SET Avatars_id = ? WHERE Avatars_id = ?");
    $replace->bind_param('ii', $idFirstAvatar[0], $idAvatar);

    // Se hay algún fallo en la consulta retornamos el codigo de error:
    if ($replace->execute() == false){
      return "e603";
    }
    
    // Obetenemos el enlace del avatar para poder eliminarlo
    $imgLink = $this->conn->query("SELECT link FROM Avatars WHERE id = $idAvatar");
    $imgLinkRes = $imgLink->fetch_row(); // <- en la posicion 0 del array se encuentra el 'Path' de la imagen

    // Elimina de la tabla el avatar con el id $idAvatar(id a eliminar)
    $removeAvatar = $this->conn->prepare("DELETE FROM Avatars WHERE id = ?");
    $removeAvatar->bind_param('i', $idAvatar);

    if ($removeAvatar->execute()){
      // Escenario de exito:
      // Se elimina de la carpeta del proyecto el archivo del avatar
      unlink($imgLinkRes[0]);
      return "a60";
    }else{
      // Escenario de error:
      return "e609";
    }
  }


  /**
   * Realiza una busqueda en la base de datos y convierte los resultados en objetos de la clase Avatars
   * @return Regresa un array de Objetos de la clase __Avatars__. 
   */  
  public static function showAvatars()
  {
    $conection = new DataBase;
    $conection->table = "Avatars";

    $sql = $conection->preSelect()->runQuery();

    $avatars = array();

    while ($avatar = $sql->fetch_object(Avatars::class)){
      $avatars[] = $avatar;
    }

    return $avatars;
  }
}
