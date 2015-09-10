<?php
namespace Controllers;

use Models;

class ReviseController  extends BasicController {

	public function request()
	{
		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		include "templates/revise.phtml";
	}
}