<?php 
include_once 'Models/ConnectionModel.php';

class UserSession extends DataBase
{
  // Credenciales de Inicio de sesión
  protected $nickname;
  protected $password;

  // Nombre de la tabla en la que se trabajará
  public $table = 'users';

  /**
   * @param string $nick Representa el nickname del usuario
   * @param string $pass Representa la contraseña del usuario
   * 
   * @return string Retorna una cadena en caso de error
   * @return bool Retorna true si la contraseña coincide con el nickname 
   */
  public function __construct($nick, $pass)
  {
    $this->nickname = $nick;
    $this->password = $pass;
  }

  /**
   * Valida las credenciales pasadas a la clase ($nick & $pass)
   */
  public function startSession()
  {
    
    if (!$this->checkIfExists('nickname', $this->nickname)) 
    {
      return 'Oops, Usuario inexistente.';
    }
    else 
    {
      // contraseña en la base de datos
      $dbPass = $this->preSelect(['password'])->where('nickname', '=', $this->nickname)->runQuery();
      $dbPass = $dbPass->fetch_row();

      if (!password_verify($this->password, $dbPass[0]))
      {
        return 'Oops, Contraseña equivocada.';
      }
      else
      {
        $_SESSION['user'] = $this->nickname;
        $_SESSION['status'] = 1;

        return true;
      }
    }
  }

  /**
   * Cierrra la sesion completamente la sesion 
   */
  public static function closeSession()
  {
    session_start();
    setcookie (session_id(), "", time() - 3600);
    session_destroy();
    session_write_close();
  }


  public static function validateSession()
  {
    
  }

  public static function homeSessionNav()
  {
    if (!isset($_SESSION['status']) || $_SESSION['status'] != 1){
      return 'Views/html/navBar/nbfalse.php';
    }
    else{
      return 'Views/html/navBar/nbtrue.php';
    }
  }
}