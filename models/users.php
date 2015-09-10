<?php
namespace Models;
use PDO;

require_once('Session.php');
class Users
{
	private $connection;

  public function __construct()
  {
    $this->connection = ConnectionFabric::getInstance()->getConnection();
  }

  public function isUserExist($user, $email)
  {
    $userExist = "'".strtolower($user)."'";
    $stm = $this->connection->prepare("SELECT * FROM users WHERE user = $userExist");
    $stm->execute();
    $isUserExist = $stm->fetch();

  	if($isUserExist == false)
  	{
      $emailExist = "'".$email."'";
      $stm1 = $this->connection->prepare("SELECT * FROM users WHERE email = $emailExist");
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
    $addUserStatement = $this->connection->exec("INSERT INTO `users` (`user`, `email`, `pass`)
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
    $stm = $this->connection->prepare("SELECT * FROM `users` WHERE email='$email' AND pass='$pass'");
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
    $query = 'SELECT user_id, user, email FROM users';
    $allUsersStatement = $this->connection->query($query);
    return $allUsersStatement->fetchAll();
  }

  public function getUser($num)
  {
    $query = "SELECT user_id, user, email FROM `users` WHERE user_id = '$num'";
    $getUserStatement = $this->connection->query($query);
    return $getUserStatement->fetch(PDO::FETCH_ASSOC);
  }

  public function getUserIdByEmail($email)
  {
    $query = "SELECT user_id FROM users WHERE email = '$email'";
    $getUserIdStatement = $this->connection->query($query);
    $getUserId = $getUserIdStatement->fetch(PDO::FETCH_OBJ);
    return $getUserId;
  }

  private function validateEmail($field)
  {
    if (!filter_var($field, FILTER_VALIDATE_EMAIL))
    {
      $msg = 'Введите правильный email адрес.';
      return $msg;
    }
    else
    {
      return false;
    }
  }

  public function editUser ($num, $user, $email)
  {
  	$user = htmlentities($user, ENT_QUOTES);
  	$email = htmlentities($email, ENT_QUOTES);
    if($this->validateEmail($email))
    {
      $warning = $this->validateEmail($email);
      return $warning;
    }

    $query = "UPDATE users SET user='$user', email='$email' WHERE user_id='$num'";
    $editUserStatement = $this->connection->query($query);
    return false;
  }

  public function deleteUser($userId)
  {
    $deleteUsersWords = "DELETE FROM `translator`.`words` WHERE `words`.`user_id` ='$userId'";
    $deleteUsersWordsStatement = $this->connection->query($deleteUsersWords);
    $query = "DELETE FROM `translator`.`users` WHERE `users`.`user_id` ='$userId'";
    $deleteUserStatement = $this->connection->query($query);
  }

}