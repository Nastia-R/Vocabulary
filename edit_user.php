<?php
require_once('autoload.php');
require_once ('models/acl.php');

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
			$newUser->editUser($_GET['num'], $_POST['user'], $_POST['email']);
			$edit_row = $newUser->getUser($_GET['num']);
			//вставка прошла успешно
			$msg = "Данные успешно обновлены!";
		}
	}
}

include "templates/edit_user.phtml";
