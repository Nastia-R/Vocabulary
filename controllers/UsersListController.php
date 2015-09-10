<?php
namespace Controllers;

use Models;

class UsersListController{

	protected $newUser;

	public function __construct()
	{
		$this->newUser = new Models\Users;
	}

	public function request()
	{
		$users_list = $this->newUser->getAllUsers();

		if(isset($_GET['cong']))
		{
			$msg = "Удаление юзера прошло успешно!";
		}

		$router = new Models\Router;
		$email = Models\Authorisation::getInstance()->getEmail();
		include "templates/usersList.phtml";
	}
}




