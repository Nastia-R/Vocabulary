<?php
namespace Controllers;

use Models;

class WordDeleteController extends BasicController {

	private $wordsModel;

	public function __construct()
	{
		$this->wordsModel = new Models\Words();
	}

	public function request()
	{
		if (isset($_GET['del']) && !empty($_GET['del'])) 
		{
			$wordId = $_GET['num'];
			$this->wordsModel->deleteWord($wordId);
			header("Location:./index.php?page=browse&cong=1");
		}

		$wordsObject = $this->wordsModel;
		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		require_once('templates/wordDelete.phtml');
	}

}