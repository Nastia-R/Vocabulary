<?php
namespace Controllers;

use Models;

class ReviseController {

	public function request()
	{
		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		include "templates/revise.phtml";
	}
}