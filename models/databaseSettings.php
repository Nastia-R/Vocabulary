<?php
namespace Models;
class DatabaseSettings{

  public function getUser()
  {
    return 'root';
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
