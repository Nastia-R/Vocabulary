<?php
namespace Controllers;

use Models;

class UserDeleteController {

	public function __construct()
	{
	}

	public function request()
	{
		$usersObject = new Models\Users;
		if (isset($_GET['del']) && !empty($_GET['del'])) 
		{
			$userId = $_GET['num'];
			$usersObject->deleteUser($userId);
			header("Location:index.php?page=usersList&cong=1");
		}

		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		require_once('templates/userDelete.phtml');
	}

}