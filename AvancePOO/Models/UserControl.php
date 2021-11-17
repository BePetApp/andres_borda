<?php
require_once 'Controllers/connControl.php';


class UserControl extends Connection
{

  // Atributos de usuarios
  public $id;
  public $nombre;
  public $apellido;
  public $nickname;
  public $email;
  public $avatares_id;
  public $pass;

  protected $password;


  /**
   * Para la creacion de un usuario es __necesario__ otorgar _antes_ valores a las propiedades de la clase:
   * * ___nombre___ -> _obligatorio_;
   * * ___apellido___ -> __opcional__;
   * * ___nickname___ -> _obligatorio_;
   * * ___email___ -> _obligatorio_;
   * * ___avatares_id___ -> _obligatorio_;
   * * ___pass___ -> _obligatorio_;
   */
  public function createUser()
  {
    // Se comprueba si el Nickname Ya ha sido Tomado [no se puede repetir en bd]
    if (!$this->checkIfExists('nickname', $this->nickname))
     {
      // Si verifica tambien, si el email ya está en uso [no se puede repetir en bd]
      if (!$this->checkIfExists('email', $this->email)) 
      {
        $this->connect();

        $this->password = password_hash($this->pass, PASSWORD_BCRYPT);

        $sqlPrepare = $this->conn->prepare("INSERT INTO usuarios (nombre, apellido, nickname, email, password, avatares_id)
        VALUES (?, ?, ?, ?, ?, ?)");

        $sqlPrepare->bind_param('sssssi', $this->nombre, $this->apellido, $this->nickname, $this->email, $this->password, $this->avatares_id);

        // Si no se produce ningun error en la consulta 
        // if ($this->conn->query($sql))
        if ($sqlPrepare->execute()) 
        {
          return 'Usuario Ingresado correctamente :)';
        } else {
          return 'Error: ' . $this->conn->error;
        } 

      } else {
        return 'El email ya se encuentra en uso';
      }
    } else {
      return 'El Nickname ya ha sido tomado';
    }
  }

  /**
   * Para la actualización de un usuario es __obligatorio__ otorgar _antes_ valores a las siguientes propiedades:
   * * __id__ -> _obligatorio_
   * * ___nombre___ -> _obligatorio_
   * * ___apellido___ -> __opcional__
   * * ___nickname___ -> _obligatorio_
   * * ___email___ -> _obligatorio_
   */
  public function updateUser()
  {
    $this->connect();

    $sqlPrepare = $this->conn->prepare("UPDATE usuarios
    SET nombre = ?, apellido = ?, nickname = ?, email = ? 
    WHERE id = ?");

    $sqlPrepare->bind_param('ssssi', $this->nombre, $this->apellido, $this->nickname, $this->email, $this->id);

    if ($sqlPrepare->execute()) 
      return true; 
    else
      return 'Error: ' . $this->conn->error;
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

    $sqlPrepare = $this->conn->prepare("DELETE from usuarios WHERE id = ?");
    $sqlPrepare->bind_param('i', $this->id);
    $sqlPrepare->execute();

    if ($sqlPrepare->affected_rows > 0)
      return true;
    else
      return false;
  }

  /**
   * Realiza una busqueda en la base de datos y convierte los resultados en objetos UserControl
   * @return Regresa un array de Objetos de la clase __UserControl__. 
   */
  public static function showUsers()
  {
    $connection = new Connection;
    $connection->connect();

    $sql = $connection->conn->prepare("SELECT id, nombre, apellido, nickname, email FROM usuarios");
    $sql->execute();
    $res = $sql->get_result();

    $users = array();

    while ($user = $res->fetch_object(UserControl::class)) {
      $users[] = $user;
    }

    return $users;
  }

  /**
   * Verifica si __$value__ se encuentra en la base de datos en la columna __$field__: 
   * 
   * Ejemplo de la sintaxis empleada:
   * 
   * ___SELECT EXISTS (SELECT id FROM usuarios WHERE $field = '$value')___
   * 
   * @param string $field Campo a verificar 
   * @param mixed $value Valor a comprobar
   */
  public function checkIfExists(string $field, $value)
  {
    $this->connect();

    if (gettype($value) == 'integer')
      $sql = "SELECT EXISTS (SELECT id FROM usuarios WHERE $field = $value)";
    else
      $sql = "SELECT EXISTS (SELECT id FROM usuarios WHERE $field = '$value')";

    $result = $this->conn->query($sql);
    $result = $result->fetch_row();

    if ($result[0] == 1)
      return true;
    else
      return false;
  }


  public function showInfo()
  {
    echo "{$this->id}| Nombre {$this->nombre} {$this->apellido}. Mi nick es {$this->nickname} y mi correo es {$this->email}...";
  }


  /**
   * Prepara una sentencia SLQ de tipo SELECT a la tabla usuarios. |
   * _Para completar la consulta, se debe ejecutar el metodo ___runQuery()____
   * 
   * @param array $fields Representa los campos a seleccionar de la tabla, si no se
   * pasan atributos, se hará un _SELECT *_ 
   * @return Retorna una propiedad de tipo string para ejecutarse con el metodo ___runQuery()___
   */
  public function preSelect(array $fields = ['*'])
  {
    $this->sql = "SELECT ";

    foreach ($fields as $field){
      $this->sql .= $field . ", "; 
    }

    $this->sql = substr($this->sql, 0, -2) . " FROM usuarios";

    return $this;
  }


  /**
   * Complementa el metodo ___preSelect()__. Representa una sentencia _WHERE_
   * 
   * @param string $field_1 Campo que se va a comparar
   * @param string $operator Operador que se desea emplear ( =, <>, like)
   * @param mixed $field_2 Valor. Puede ser string o integer
   * 
   * @return Retorna una propiedad de tipo string para ejecutarse con el metodo ___runQuery()___
   */
  public function where(string $field_1, string $operator, $field_2)
  {
    if (gettype($field_2) == 'integer')
    {
      $this->sql = $this->sql . " WHERE {$field_1} {$operator} {$field_2}";
    }
    else
    {
      $this->sql = $this->sql . " WHERE {$field_1} {$operator} '{$field_2}'";
    }
    
    return $this;
  }

  /**
   * Ejecuta la sentencia establecida por el metodo __preSelect()__ y sus metodos allegados
   * 
   * @return $result Regresa un Objeto Mysqli_Result 
   */
  public function runQuery()
  {
    $this->connect();

    $result = $this->conn->query($this->sql);

    return $result;
  }
}

