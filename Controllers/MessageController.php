<?php

class Messages{
  
  public static $messages =  array(
    // Insert user messages
    1100 => "Usuario registrado correctamente :)",
    1111 => "Las contraseñas no coinciden.",
    1133 => "El email ingresado ya ha sido registrado.",
    1155 => "El nickname ingresado ya ha sido tomado.",    
    1199 => "Ha ocurrido un error interno, intenta mas tarde.",

    // Delet user messages
    2200 => "Usuario Eliminado correctamente",
    2299 => "Ha ocurrido un problema en la eliminacion",

    // Update user messages
    3300 => "Informacion actualizada correctamente",
    3399 => "Ha ocurrido un problema en la actualizacion",

    // Inser new Avatar messages
    6600 => "Se agregó el avatar correctamente.",
    6699 => "Ha ocurrido un problema al agregar el nuevo avatar.",

    // Delet avatar message
    6655 => "Se eliminó el avatar correctamente.",
    6679 => "Ha ocurrido un problema al borrar el archivo.",
    6633 => "Ha ocurrido un error en la eliminacion"
  );

  public static function showMessage()
  {
    if (isset($_GET['mess']) && array_key_exists($_GET['mess'], self::$messages)) {
      $mess = self::$messages[$_GET['mess']];
      include_once 'Views/html/message.php';
    }
  }
}
