<?php
namespace Models;
class DatabaseSettings{

  public function getUser()
  {
    return 'vkpost_vocab';
  }

  public function getPassword()
  {
    return 'xkylbhsc';
  }

  public function getHost()
  {
    return 'vkpost.mysql.ukraine.com.ua';
  }

  public function getDatabaseName()
  {
    return 'vkpost_vocab';
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
