<?php
require_once('autoload.php');

$newUser = new Models\Users;
$newUser->logout();

if(isset($_GET['cong']))
{
	$congratulation = "Congratulations! You have been successfully registered!";
}

if(isset($_POST['email']) && isset($_POST['pass']))
{
	$remember = isset($_POST['remember']);
	$enter_site = $newUser->login($_POST['email'], $_POST['pass'], $remember);

	if($enter_site)
	{
		header("Location:main.php");
		exit;
	}
	else
	{
		$warning = "You entered wrong email or pass!";
	}
}

include "templates/authorisation.phtml";
