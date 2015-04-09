<?php
include "db.php";
require_once('models/users.php');
if(isset($_POST['ok']))
{
	if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pass']))
	{
		$warning = "Not all fields are filled!";
	}
	else
	{
		$newUser = new ModelUsers;
		if($newUser->isUserExist($_POST['user'], $_POST['email']) == false)
		{
			$result = $newUser->addUser($_POST['user'], $_POST['email'], $_POST['pass']);
			close_connection();

			if ($result)
			{
				header("Location:authorisation.php?cong=1");
			}
			else
			{
				$warning = "Error!Smthng bad has been happened =(";
			}
		}
		else
		{
			$warning = "This user is already exist!";
		}
	}
}
include "templates/registration.phtml";
