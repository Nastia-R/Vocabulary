<?php
namespace Models;
require_once "DatabaseSettings.php";
require_once "PdoConnection.php";

class ConnectionFabric {

  protected static $instance = NULL;
  protected $connection;

  public static function getInstance()
  {
    if(self::$instance === NULL)
    {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function getConnection()
  {
    return $this->connection;
  }

  protected function __construct()
  {
    $databaseSettings = new DatabaseSettings();
    $adapter = new PdoConnection($databaseSettings);
    $this->connection = $adapter->getConnection();
  }

}
