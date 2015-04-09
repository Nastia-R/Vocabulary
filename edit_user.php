<?php
session_start();
include "db.php";
include "panel_users.php";
require_once('models/users.php');
$newUser = new ModelUsers;
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
			close_connection();
			//вставка прошла успешно
			$msg = "Данные успешно обновлены!";
		}
	}
}

include "templates/edit_user.phtml";
