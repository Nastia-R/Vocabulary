<?php
session_start();
include "db.php";
include "panel_users.php";
if(isset($_GET['num']))
{
	$edit_row = get_user($_GET['num']);
	//Проверка на отправку формы
	if(isset($_POST['user']))
	{
		//Проверка на заполнение полей ввода слова и его перевода
		if (empty($_POST['user']) || empty($_POST['email'])) 
		{
			$warning = "Заполнены не все поля!";
		}
		else
		{
			edit_user ($_GET['num'], $_POST['user'], $_POST['email']);
			$edit_row = get_user ($_GET['num']);
			close_connection();
			//вставка прошла успешно
			$msg = "Данные успешно обновлены!";
		}		
	} 
}

include "templates/edit_user.phtml";