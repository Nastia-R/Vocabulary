<?php
class DatabaseSettings{

  protected $firsletter = 'r';

  protected function getUserP1()
  {return $this->firsletter;}

  protected function getUserP2()
  {return 'o';}

  protected function getUserP3()
  {
    return $this->getUserP2();
  }

  protected function getUserP4()
  {return 't';}

  public function getUser()
  {
    return $this->getUserP1() . $this->getUserP2() . $this->getUserP3(). $this->getUserP4();
  }

  public function getPassword()
  {
    return '';
  }

  public function getHost()
  {
    return 'localhost';
  }

  public function getDatabaseName()
  {
    return 'translator';
  }

  public function getCharset()
  {
    return 'utf8';
  }

  public function getPdoConnectionString()
  {
    $host = $this->getHost();
    $databaseName = $this->getDatabaseName();
    $charset = $this->getCharset();
    $format = 'mysql:host=%s;dbname=%s;charset=%s';
    $connectionString = sprintf($format, $host, $databaseName, $charset);
    return $connectionString;
  }

}
