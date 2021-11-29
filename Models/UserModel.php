<?php
require_once 'Models/ConnectionModel.php';


class Users extends DataBase
{
  // Tabla en la que se realizan las consultas
  public $table = 'users';

  // Atributos de usuarios
  public $id;
  public $name;
  public $lastName;
  public $nickName;
  public $email;
  public $avatars_id;
  public $pass;

  protected $usrPassword;


  /**
   * Para la creacion de un usuario es __necesario__ otorgar _antes_ valores a las propiedades de la clase:
   * * ___name___ -> _obligatorio_;
   * * ___last_name___ -> __opcional__;
   * * ___nickname___ -> _obligatorio_;
   * * ___email___ -> _obligatorio_;
   * * ___avatars_id___ -> _obligatorio_;
   * * ___pass___ -> _obligatorio_;
   */
  public function createUser()
  {
    // Se comprueba si el Nickname Ya ha sido Tomado [no se puede repetir en bd]
    if ($this->checkIfExists('nickName', $this->nickName)){
      return "e205";
    }
    // Si verifica tambien, si el email ya está en uso [no se puede repetir en bd]
    if ($this->checkIfExists('email', $this->email)){
      return "e203";
    }
    // Conexion a la base de datos
    $this->connect();

    // Consulta sql
    $this->usrPassword = password_hash($this->pass, PASSWORD_BCRYPT);
    $sqlPrepare = $this->conn->prepare("INSERT INTO users (name, lastName, nickName, email, usrPassword, avatars_id)
    VALUES (?, ?, ?, ?, ?, ?)");
    $sqlPrepare->bind_param('sssssi', $this->name, $this->lastName, $this->nickName, $this->email, $this->usrPassword, $this->avatars_id);

    if ($sqlPrepare->execute()) {
      // Insercion exitosa
      return "a20";
    } else {
      // Error en la insercion
      return "e209";
    } 
  }

  
  /**
   * Para la actualización de un usuario es __obligatorio__ otorgar _antes_ valores a las siguientes propiedades:
   * * __id__ -> _obligatorio_
   * * ___name___ -> _obligatorio_
   * * ___last_name___ -> __opcional__
   * * ___nickname___ -> _obligatorio_
   * * ___email___ -> _obligatorio_
   */
  public function updateUser()
  {
    $this->connect();

    $sqlPrepare = $this->conn->prepare("UPDATE users
    SET name = ?, lastName = ?, nickName = ?, email = ? 
    WHERE id = ?");

    $sqlPrepare->bind_param('ssssi', $this->name, $this->lastName, $this->nickName, $this->email, $this->id);

    if ($sqlPrepare->execute()) 
      return true;
    else
      return false;
  }


  /**
   * Para llevar a cabo la eliminacion de un registro ___antes___ se debe dar un valor a la propiedad:
   * * __id__ -> Id del registro a Eliminar
   * 
   * @return True Cuando se elimina satisfactoriamente un registro registro
   * @return False Cuando no se elimina ningun registro
   */
  public function deleteUser()
  {
    $this->connect();

    $sqlPrepare = $this->conn->prepare("DELETE from users WHERE id = ?");
    $sqlPrepare->bind_param('i', $this->id);
    $sqlPrepare->execute();

    if ($sqlPrepare->affected_rows > 0)
      return true;
    else
      return false;
  }

  
  /**
   * Realiza una busqueda en la base de datos y convierte los resultados en objetos UserControl
   * @return Regresa un array de Objetos de la clase __Users__. 
   */
  public static function showUsers()
  {
    $connection = new DataBase;
    $connection->connect();
    $connection->table = 'Users';

    $res = $connection->preSelect(['id', 'name', 'lastName', 'nickName', 'email'])->where('id', '<>', $_SESSION['userId'])->runQuery();

    $users = array();

    while ($user = $res->fetch_object(Users::class)) {
      $users[] = $user;
    }

    return $users;
  }


  public function showSearchedUsers($value)
  {
    $res = $this->preSelect(['id', 'name', 'lastName', 'nickName', 'email'])->where('nickName', 'like', "%$value%")->runQuery();
    
    $users = array();

    while ($user = $res->fetch_object(Users::class)) {
      $users[] = $user;
    }

    return $users;
  }
}
