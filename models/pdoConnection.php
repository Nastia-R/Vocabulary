<?php
class PdoConnection {

  private $connection;
  private $settings;

  public function __construct(DatabaseSettings $settings)
  {
      $this->settings = $settings;
      $this->connect();
      $this->setCharset();
  }

  public function getConnection()
  {
    return $this->connection;
  }

  private function connect()
  {
    $user = $this->settings->getUser();
    $password = $this->settings->getPassword();
    $connectionString = $this->settings->getPdoConnectionString();
    $this->connection = new PDO($connectionString, $user, $password);
  }

  private function setCharset()
  {
    $charset = $this->settings->getCharset();
    $query = sprintf("set names %s", $charset);
    $this->connection->exec($query);
  }

}
