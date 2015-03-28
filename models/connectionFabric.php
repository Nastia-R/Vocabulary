<?php
require_once "databaseSettings.php";
require_once "pdoConnection.php";

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
