<?php 
include_once 'Models/ConnectionModel.php';

class UserSession extends DataBase
{
  // Credenciales de Inicio de sesión
  protected $nickname;
  protected $password;

  // Nombre de la tabla en la que se trabajará
  public $table = 'Users';

  /**
   * @param string $nick Representa el nickname del usuario
   * @param string $pass Representa la contraseña del usuario
   * 
   */
  public function __construct($nick, $pass)
  {
    $this->nickname = $nick;
    $this->password = $pass;
  }

  /**
   * Valida las credenciales pasadas a la clase ($nick & $pass)
   * @return int Retorna una cadena en caso de error
   * @return int Retorna true si la contraseña coincide con el nickname 
   */
  public function startSession()
  {
    
    if (!$this->checkIfExists('nickName', $this->nickname)){
      return "e105";
    }

    // contraseña en la base de datos
    $dbPass = $this->preSelect(['usrPassword', 'id', 'status', 'rol'])->where('nickname', '=', $this->nickname)->runQuery();
    $dbPass = $dbPass->fetch_row();

    if (!password_verify($this->password, $dbPass[0])){
      return "e100";
    }

    if ($dbPass[2] == 1) {
      return "e991";
    }

    $_SESSION['user'] = $this->nickname;
    $_SESSION['userId'] = $dbPass[1];
    $_SESSION['rol'] = $dbPass[3];

    return "a10";
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
    if (!isset($_SESSION['rol'])){
      return 0;
    } 
    if ($_SESSION['rol'] == 0) {
      return 1;
    } elseif ($_SESSION['rol'] == 1){
      return 2;
    }
  }

  public static function homeSessionNav()
  {
    session_start();
    if (self::validateSession() === 0){
      return 'Views/html/navBar/nbfalse.php';
    } elseif (self::validateSession() === 1){
      return 'Views/html/navBar/nbtrue.php';
    } elseif (self::validateSession() === 2){
      return 'Views/html/navBar/nbAdmin.php';
    }
  }
}
