<?php
require_once('autoload.php');
//require_once ('models/acl.php');

$page = isset($_GET['page']) ? $_GET['page'] : false;

switch ($page) 
{
	case 'add-word':
		$controller = new Controllers\AddWordController();
		break;
	case 'word-delete':
		$controller = new Controllers\WordDeleteController();
		break;
	case 'word-edit':
		$controller = new Controllers\WordEditController();
		break;
	case 'user-delete':
		$controller = new Controllers\UserDeleteController();
		break;
	case 'user-edit':
		$controller = new Controllers\UserEditController();
		break;
	case 'randomWord':
		$controller = new Controllers\RandomController();
		break;
	case 'userList':
		$controller = new Controllers\UserListController();
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
	default:
		$controller = new Controllers\MainController();
		break;
}

$controller->request();
