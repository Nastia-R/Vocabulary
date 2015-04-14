<?php
require_once "connectionFabric.php";
class ModelUsers
{
  public function isUserExist($user, $email)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $userExist = "'".strtolower($user)."'";
    $stm = $connection->prepare("SELECT * FROM users WHERE user = $userExist");
    $stm->execute();
    $isUserExist = $stm->fetch();

  	if($isUserExist == false)
  	{
      $emailExist = "'".$email."'";
      $stm1 = $connection->prepare("SELECT * FROM users WHERE email = $emailExist");
      $stm1->execute();
      $isEmailExist = $stm1->fetch();

    	if ($isEmailExist == false)
      {
        return false;
      }
      else
      {
        return true;
      }
  	}
  	else
  	{
      return true;
    }
  }

  public function addUser ($user, $email, $pass)
  {
  	$user = htmlentities($user, ENT_QUOTES);
  	$email = htmlentities($email, ENT_QUOTES);
  	$pass = htmlentities($pass, ENT_QUOTES);
  	// $explode_trans = explode("/r/n", $trans);
    $connection = ConnectionFabric::getInstance()->getConnection();
    $addUserStatement = $connection->exec("INSERT INTO `users` (`user`, `email`, `pass`)
      VALUES ('".$user."','".$email."', '".$pass."')");
    if($addUserStatement == false)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

  public function login ($email, $pass, $remember)
  {
  	//checking security user by email and pass
    $connection = ConnectionFabric::getInstance()->getConnection();
    $stm = $connection->prepare("SELECT * FROM `users` WHERE email='$email' AND pass='$pass'");
    $stm->execute();
    $count = $stm->fetchAll();

  	if($count != false)
  	{
  		$_SESSION['email'] = $email;
  		$_SESSION['pass'] = $pass;
  		if($remember)
  		{
  			setcookie('email', $email, time() + 3600 * 24 * 7);
  			setcookie('pass', $pass, time() + 3600 * 24 * 7);
  		}
  	}
  	else
  	{
  		return false;
  	}
  	return $count;
  }

  public function logout()
  {
  	//making cookie too old

  	setcookie('email', ' ', time() - 1);
  	setcookie('pass', ' ', time() - 1);

  	unset($_SESSION['email'], $_SESSION['pass']);
  }

  public function getAllUsers()
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = 'SELECT id, user, email FROM users';
    $allUsersStatement = $connection->query($query);
    return $allUsersStatement->fetchAll();
  }

  public function getUser($num)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "SELECT * FROM `users` WHERE id = '$num'";
    $getUserStatement = $connection->query($query);
    return $getUserStatement->fetch();
  }

  private function checkOnRussian($field)
  {
    if (!preg_match("#^[a-z0-9@]+$#i", $field))
    {
      die('Разрешены только символы a-z и цифры');
    }
  }

  public function editUser ($num, $user, $email)
  {
  	$user = htmlentities($user, ENT_QUOTES);
  	$email = htmlentities($email, ENT_QUOTES);
    $this->checkOnRussian($email);

    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "UPDATE users SET user='$user', email='$email' WHERE id='$num'";
    $editUserStatement = $connection->query($query);
  }

  public function deleteUser($userId)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "DELETE FROM `translator`.`users` WHERE `users`.`id` ='$userId'";
    $deleteWordStatement = $connection->query($query);
  }

}