<?php
namespace Controllers;

use Models;

class UserDeleteController extends BasicController {

	public function __construct()
	{
	}

	public function request()
	{
		$router = new Models\Router;
		$usersObject = new Models\Users;
		if (isset($_GET['del']) && !empty($_GET['del'])) 
		{
			$userId = $_GET['num'];
			$usersObject->deleteUser($userId);
			header("Location:".$router->getUrl('usersList', array('cong'=>'1'))."");
		}

		$email = Models\Authorisation::getInstance()->getEmail();
		require_once('templates/userDelete.phtml');
	}

}