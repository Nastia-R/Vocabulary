<?php
namespace Controllers;

use Models;
use Services;

class GetWordsForReviseController extends BasicController {

	private $wordsObject;

	public function __construct()
	{
		$this->wordsObject = new Models\Words;
	}

	public function request()
	{
		$words = $this->wordsObject->getSomeWords(3);
		$response = new Services\JsonResponse($words);
		$response->makeResponse();
	}
}