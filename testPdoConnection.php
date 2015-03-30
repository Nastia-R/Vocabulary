<?php
require_once "models/connectionFabric.php";
require_once "db.php";
require_once "models/words.php";
require_once "models/users.php";

function displayTest($name, $success)
{
  echo $success ? 'SUCCESS: ' : 'FAILED: ';
  echo $name;
  echo '<br/>';
}

function testIsUserExist()
{
  displayTest('isUserExist: user should exist by nick', isUserExist('d', 'd@d.12312312312312') === true);
  displayTest('isUserExist: user should exist by email', isUserExist('d99999999999', 'd@d') === true);
  displayTest('isUserExist: user should not exist by nick', isUserExist('d999999999', '99999999') === false);
  displayTest('isUserExist: user should not exist by email', isUserExist('d999999999', '99999999') === false);
}

function testGetAllUsers()
{
  $newUsers = getAllUsers();
  var_dump($newUsers);
}
