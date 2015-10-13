<?php 
namespace Controllers;

use Models;

class RandomController extends BasicController {

	private $newWords;
	public function __construct()
	{
		$this->newWords = new Models\Words();
	}

	public function request()
	{
		// -=-=-=-=-= рандомайзер=-=-=-=--
		// 1) генерируем random ай ди
		$rand_id = $this->newWords->selectRandomId();
		// 2) достаем по нему данные из БД
		$rand_word = $this->newWords->getWordById($rand_id);
		// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=--

		if(isset($_POST['trans']))
		{
			// 1) получаем айди с рандом.рнр
			$id = $_POST['id'];
			// 2) получаем то, что ввел юзер
			$userTrans = $_POST['trans'];
			// 3) вытягиваем из БД транс по ай ди
			$trans = $this->newWords->getTranslationById($id);
			// 4) сравниваем ввод юзера и перевод из БД
			if($trans == $userTrans)
			{
				$msg = "Right!";
				$trigger = 'right';
			}
			else
			{
				$msg = "Wrong! Right translation is \"$trans\" and you typed \"$userTrans\"";
				$trigger = 'wrong';
			}

			$this->newWords->recordRandomWordAnswer($rand_id, $trigger);
		}

		$email = Models\Authorisation::getInstance()->getEmail();
		$router = new Models\Router;
		include "templates/wordRandom.phtml";
	}

}