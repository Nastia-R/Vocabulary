<?php
namespace Controllers;

use Models;

class AuthorisationController extends BasicController {

	private $newUser;
	public function __construct()
	{
		$this->newUser = new Models\Users;
		$this->newUser->logout();
	}

	public function request()
	{
		if(isset($_GET['cong']))
		{
			$congratulation = "Congratulations! You have been successfully registered!";
		}

		if(isset($_POST['email']) && isset($_POST['pass']))
		{
			$remember = isset($_POST['remember']);
			$enter_site = $this->newUser->login($_POST['email'], $_POST['pass'], $remember);

			if($enter_site)
			{
				header("Location:index.php");
				exit;
			}
			else
			{
				$warning = "You entered wrong email or pass!";
			}

		}

		$router = new Models\Router;
		include "templates/authorisation.phtml";
	}
}