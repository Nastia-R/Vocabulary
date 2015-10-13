<?php
namespace Models;

use Controllers;

class ControllerFactory {

	public static function getController($page) {

		switch ($page) 
		{
			case 'browse':
				$controller = new Controllers\BrowseController();
				break;
			case 'wordAdd':
				$controller = new Controllers\AddWordController();
				break;
			case 'wordDelete':
				$controller = new Controllers\WordDeleteController();
				break;
			case 'wordEdit':
				$controller = new Controllers\WordEditController();
				break;
			case 'userDelete':
				$controller = new Controllers\UserDeleteController();
				break;
			case 'userEdit':
				$controller = new Controllers\UserEditController();
				break;
			case 'wordRandom':
				$controller = new Controllers\RandomController();
				break;
			case 'usersList':
				$controller = new Controllers\UsersListController();
				break;
			case 'revise':
				$controller = new Controllers\ReviseController();
				break;
			case 'authorisation':
				$controller = new Controllers\AuthorisationController();
				break;
			case 'registration':
				$controller = new Controllers\RegistrationController();
				break;
			case 'getWordsForRevise':
				$controller = new Controllers\GetWordsForReviseController();
				break;
			default:
				$controller = new Controllers\AboutUsController();
				break;
		}

		return $controller;
	}
}
