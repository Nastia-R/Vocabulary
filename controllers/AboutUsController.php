<?php
namespace Controllers;

use Models;

class AboutUsController {
	
	private $newWords;

	public function __construct()
	{
		$this->newWords = new Models\Words;
	}

	public function request()
	{
		$router = new Models\Router;
		$email = $this->newWords->userEmail;
		include "templates/aboutUs.phtml";	
	}
}