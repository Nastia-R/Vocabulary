<?php
session_start();
include "db.php";
include "panel_users.php";
require_once ('models/words.php');
//Проверка на отправку формы
if(isset($_POST['word']))
{
	//Проверка на заполнение полей ввода слова и его перевода
	if (empty($_POST['word']) || empty($_POST['trans']))
	{
		$warning = "Заполнены не все поля!";
	}
	else
	{
		if(isWordExist($_POST['word']) == false)
		{
			$result = addWord($_POST['word'], $_POST['descr'], $_POST['trans']);
			close_connection();
			//Если вставка прошла успешно
			if ($result)
			{
				$msg = "Данные успешно добавлены в таблицу!";
			}
			else
			{
				$warning = "Произошла ошибка";
			}
		}
		else
		{
			$warning = "Это слово уже есть в словаре.";
		}
	}
}
include "templates/add.phtml";

