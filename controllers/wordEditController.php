<?php
namespace Controllers;

use Models;

class WordEditController {

	public function __construct()
	{
	}

	public function request()
	{
		if(isset($_GET['num']))
		{
			$newWords = new Models\Words;
			$edit_row = $newWords->getWord($_GET['num']);
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
					$newWords->editWord($_GET['num'], $_POST['word'], $_POST['descr'], $_POST['trans']);
					$edit_row = $newWords->getWord($_GET['num']);
					//вставка прошла успешно
					$msg = "Данные успешно обновлены!";
				}
			}
		}

		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		include "templates/wordEdit.phtml";
	}
}