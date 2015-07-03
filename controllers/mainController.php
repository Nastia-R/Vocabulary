<?php
namespace Controllers;

use Models;

class MainController {
	
	private $newWords;

	public function __construct()
	{
		$this->newWords = new Models\Words;
	}

	public function request()
	{
		$data = $this->newWords->getAllWords();

		if(isset($_GET['cong']))
		{
			$msg = "Слово успешно удалено!";
		}

		$router = new Models\Router;
		$email = Models\Authorisation::getInstance()->getEmail();
		include "templates/main.phtml";

	}
}