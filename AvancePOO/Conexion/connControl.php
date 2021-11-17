<?php 
class Connection
{
  private $host = "127.0.0.1";
  private $user = "root";
  private $database = "copy";
  private $port = 3308;
  private $socket = "127.0.0.1";

  protected $conn;
  
  protected function connect()
  {
    $this->conn =  new mysqli($this->host, $this->user, '', $this->database, $this->port, $this->socket);
  }
}
