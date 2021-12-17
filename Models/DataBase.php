<?php 

namespace Models;

use mysqli;

class DataBase
{
  private $host = "127.0.0.1";
  private $user = "root";
  private $database = "Burogu_Blog";
  private $port = 3308;
  private $socket = "127.0.0.1:3308";

  protected $conn;
  
  public $table;

  protected function connect()
  {
    $this->conn =  new mysqli($this->host, $this->user, '', $this->database, $this->port, $this->socket);
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
      $sql = "SELECT EXISTS (SELECT id FROM $this->table WHERE $field = $value)";
    else
      $sql = "SELECT EXISTS (SELECT id FROM $this->table WHERE $field = '$value')";

    $result = $this->conn->query($sql);
    $result = $result->fetch_row();

    if ($result[0] == 1)
      return true;
    else
      return false;
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

    $this->sql = substr($this->sql, 0, -2) . " FROM $this->table";

    return $this;
  }


  /**
   * Complementa el metodo ___preSelect()__. Representa una sentencia _WHERE_
   * 
   * @param string $field_1 Campo que se va a comparar
   * @param string $operator Operador que se desea emplear ( =, <>, like)
   * @param mixed $equls Valor. Puede ser string o integer
   * 
   * @return Retorna una propiedad de tipo string para ejecutarse con el metodo ___runQuery()___
   */
  public function where(string $field_1, string $operator, $equals)
  {
    $this->sql .=  " WHERE {$field_1} {$operator}";
    $this->sql .= gettype($equals) == 'integer' ? " {$equals}" : " '{$equals}'";  
    return $this;
  }

  /**
   * Complementa el metodo ___preSelect()__. Representa una sentencia _WHERE_
   * 
   * @param array $fields Arreglo con los campos que se desean consultar
   * @param string $operator Operador que se desea emplear ( =, <>, like)
   * @param array $equal Arreglo con los valores de igualdad para los campos del array $fields. Ambos arreglos deben tener la misma longitud y $fields[i] debe corresponder a $equal[$i]
   * @param int $or 0 = OR, 1 = AND
   * 
   * @return Retorna una propiedad de tipo string para ejecutarse con el metodo ___runQuery()___
   */
  public function multipleWhere(array $fields, string $operator, array $equal, int $or){
    $this->sql .= " WHERE";
    for ($i=0; $i < count($fields); $i++) { 
      $this->sql .= " {$fields[$i]} {$operator}";
      $this->sql .=  gettype($equal[$i]) == 'integer' ? " $equal[$i]" : " '{$equal[$i]}'";
      $this->sql .=  $or == 0 ? " OR " : " AND ";
    }
    $this->sql = $or = 0 ? substr($this->sql, 0, -3) : substr($this->sql, 0, -4);
    return $this;
  }

  /**
   * Complementa el metodo ___preSelect()__. Representa una sentencia _ORDER BY_
   * 
   * @param string $column Campo mediante el cual se realizará la ordenamiento
   * @param string $direction Dirección del ordenamiento ASC o DESC
   * 
   * @return Retorna una propiedad de tipo string para ejecutarse con el metodo ___runQuery()___
   */
  public function orderBy(string $column, string $direction)
  {
    $this->sql .= "ORDER BY {$column} {$direction}";
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

