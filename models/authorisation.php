<?php
namespace Models;
require_once('session.php');

class Authorisation {

	private static $instance = NULL;
	private $email;

	public function getEmail()
	{
		return $this->email;
	}

	public static function getInstance()
	{
		if(self::$instance === NULL)
		{
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct()
	{
		$this->authorize();
	}

	private function authorize()
	{	
		if(!isset($_SESSION['email']) && isset($_COOKIE['email']) && isset($_COOKIE['pass']))
		{
			$_SESSION['email'] = $_COOKIE['email'];
			$_SESSION['pass'] = $_COOKIE['pass'];
		}

		if(isset($_SESSION['email']) && isset($_SESSION['pass']))
		{
			$this->email = $_SESSION['email'];
		}
		else
		{
			header("Location:index.php?page=authorisation");
		}
	}
}