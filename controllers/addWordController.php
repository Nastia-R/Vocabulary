<?php
namespace Controllers;

use Models;

class AddWordController {

	private $wordsModel;

	public function __construct()
	{
		$this->wordsModel = new Models\Words();
	}

	public function request()
	{
		if(isset($_POST['word']))
		{
			//Проверка на заполнение полей ввода слова и его перевода
			if (empty($_POST['word']) || empty($_POST['trans']))
			{
				$warning = "Заполнены не все поля!";
			}
			else
			{
				if($this->wordsModel->isWordExist($_POST['word']) == false)
				{
					$result = $this->wordsModel->addWord($_POST['word'], $_POST['descr'], $_POST['trans']);
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
		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		include "templates/add.phtml";
	}
}