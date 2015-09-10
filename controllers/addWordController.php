<?php
namespace Controllers;

use Models;

class AddWordController extends BasicController {

	private $wordsObject;
	private $usersObject;

	public function __construct()
	{
		$this->wordsObject = new Models\Words();
		$this->usersObject = new Models\Users();
	}

	public function request()
	{
		$email = Models\Authorisation::getInstance()->getEmail();

		if(isset($_POST['word']))
		{
			//Проверка на заполнение полей ввода слова и его перевода
			if (empty($_POST['word']) || empty($_POST['trans']))
			{
				$warning = "Заполнены не все поля!";
			}
			else
			{
				if($this->wordsObject->isWordExist($_POST['word']) == false)
				{
					$userId = $this->usersObject->getUserIdByEmail($email);
					$result = $this->wordsObject->addWord($_POST['word'], $_POST['descr'], $_POST['trans'], $userId->user_id);
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
		
		$router = new Models\Router;
		include "templates/wordAdd.phtml";
	}
}