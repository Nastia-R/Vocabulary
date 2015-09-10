<?php
namespace Controllers;

use Models;

class UserEditController extends BasicController {

	public function __construct()
	{
	}

	public function request()
	{
		$newUser = new Models\Users;
		if(isset($_GET['num']))
		{
			$edit_row = $newUser->getUser($_GET['num']);
			//Проверка на отправку формы
			if(isset($_POST['user']))
			{
				//Проверка на заполнение полей 
				if(empty($_POST['user']) || empty($_POST['email']))
				{
					$warning = "Заполнены не все поля!";
				}
				else
				{
					
					if($newUser->editUser($_GET['num'], $_POST['user'], $_POST['email']) != false)
					{
						$warning = $newUser->editUser($_GET['num'], $_POST['user'], $_POST['email']);
					}
					else
					{
						$edit_row = $newUser->getUser($_GET['num']);
						//вставка прошла успешно
						$msg = "Данные успешно обновлены!";
					}
					
				}
			}
		}

		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		include "templates/userEdit.phtml";
	}
}