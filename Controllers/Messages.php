<?php

namespace Controllers;

class Messages{
  
  public static $messages =  array(
    // User session messages 
    "a10" => "Session Iniciada :)",
    "e100" => "Las contraseñas no coinciden.",
    "e105" => "El nickname no se encuentra registrado.",

    // Insert user messages
    "a20" => "Usuario registrado correctamente :)",
    "e203" => "El email ingresado ya ha sido registrado.",
    "e205" => "El nickname ingresado ya ha sido tomado.",    
    "e209" => "Ha ocurrido un error interno, intenta mas tarde.",

    // Delet user messages
    "a30" => "Usuario Eliminado correctamente",
    "e309" => "Ha ocurrido un problema en la eliminacion",

    // Update user messages
    "a40" => "Informacion actualizada correctamente",
    "e409" => "Ha ocurrido un problema en la actualizacion",

    // Inser new Avatar messages
    "a50" => "Se agregó el avatar correctamente.",
    "e509" => "Ha ocurrido un problema al agregar el nuevo avatar.",

    // Delet avatar message
    "a60" => "Se eliminó el avatar correctamente.",
    "e609" => "Ha ocurrido un problema al borrar el archivo.",
    "e603" => "Ha ocurrido un error en la eliminacion",

    "e991" => "La cuenta a la que está intentando acceder está temporalmente Baneada"
  );

  public static function showMessage()
  {
    if (isset($_GET['mess'])){
      $cod = $_GET['mess'];

      if ($cod[0] == "e" && array_key_exists($cod, self::$messages)) {
        $mess = self::$messages[$cod];
        include_once 'Views/html/messages/errorMessage.php';
      } else {
        $mess = self::$messages[$cod];
        include_once 'Views/html/messages/message.php';
      }
    }
  }
}
