<?php
namespace Controllers;

use Models;

class WordEditController extends BasicController {

	private $wordsObject;
	private $usersObject;

	public function __construct()
	{
		$this->wordsObject = new Models\Words();
		$this->usersObject = new Models\Users();
	}

	public function request()
	{
		if(isset($_GET['num']))
		{
			$email = Models\Authorisation::getInstance()->getEmail();
			$userId = $this->usersObject->getUserIdByEmail($email)->user_id;
			
			$edit_row = $this->wordsObject->getWord($_GET['num'], $userId);
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
					$wordsObject->editWord($_GET['num'], $_POST['word'], $_POST['descr'], $_POST['trans']);
					$edit_row = $wordsObject->getWord($_GET['num'], $userId);
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