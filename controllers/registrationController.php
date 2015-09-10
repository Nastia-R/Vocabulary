<?php

namespace Controllers;

use Models;

class RegistrationController extends BasicController {

	private $newUser;
	public function __construct()
	{
		$this->newUser = new Models\Users;
	}

	public function request()
	{

		if(isset($_POST['ok']))
		{

			if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pass']))
			{
				$warning = "Not all fields are filled!";
			}
			else
			{

				if($this->newUser->isUserExist($_POST['user'], $_POST['email']) == false)
				{
					$result = $this->newUser->addUser($_POST['user'], $_POST['email'], $_POST['pass']);

					if ($result)
					{
						header("Location:index.php?page=authorisation&cong=1");
					}
					else
					{
						$warning = "Error!Smthng bad has been happened =(";
					}

				}
				else
				{
					$warning = "This user is already exist!";
				}

			}
		}
		
		$router = new Models\Router;
		include "templates/registration.phtml";
	}
}