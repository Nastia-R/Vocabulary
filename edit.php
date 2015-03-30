<?php
session_start();
include "db.php";
include "panel_users.php";
require_once ('models/words.php');
if(isset($_GET['num']))
{
	$edit_row = getWord($_GET['num']);
	//Проверка на отправку формы
	if(isset($_POST['word']))
	{
		//Проверка на заполнение полей ввода слова и его перевода
		if(empty($_POST['word']) || empty($_POST['trans']))
		{
			$warning = "Заполнены не все поля!";
		}
		else
		{
			editWord($_GET['num'], $_POST['word'], $_POST['descr'], $_POST['trans']);
			$edit_row = getWord($_GET['num']);
			close_connection();
			//вставка прошла успешно
			$msg = "Данные успешно обновлены!";
		}
	}
}

include "templates/edit.phtml";
