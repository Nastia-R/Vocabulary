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
		$email = $this->newWords->userEmail;
		if(empty($data))
		{
			include "templates/noWords.phtml";
		}
		else
		{
			include "templates/main.phtml";
		}
		
	}
}