<?php
require_once('autoload.php');
require_once ('models/acl.php');
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
		$newWords = new Models\Words();
		if($newWords->isWordExist($_POST['word']) == false)
		{
			$result = $newWords->addWord($_POST['word'], $_POST['descr'], $_POST['trans']);
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




