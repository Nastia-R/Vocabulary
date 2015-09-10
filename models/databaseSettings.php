<?php
namespace Models;
class DatabaseSettings{

  private $conf;

  public function __construct()
  {
    $this->conf = \Noodlehaus\Config::load(ROOT_FOLDER.'/config/development.json');
  }

  public function getUser()
  {
    return $this->conf->get('user');
  }

  public function getPassword()
  {
    return $this->conf->get('password');
  }

  public function getCharset()
  {
    return $this->conf->get('charset');
  }

  public function getPdoConnectionString()
  {
    $host = $this->conf->get('host');
    $databaseName = $this->conf->get('database');
    $charset = $this->getCharset();
    $format = 'mysql:host=%s;dbname=%s;charset=%s';
    $connectionString = sprintf($format, $host, $databaseName, $charset);
    return $connectionString;
  }

}