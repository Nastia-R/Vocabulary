<?php 
//Подключение к БД
include "db.php";
//Проверка на отправку формы
if(isset($_POST['ok']))
{
	//Проверка на заполнение всех полей регистрации
	if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pass'])) 
	{
		$warning = "Not all fields are filled!";
	}
	else
	{
		if(is_user_exist ($_POST['user']) == false)
		{
			$result = add_user ($_POST['user'], $_POST['email'], $_POST['pass']);
			close_connection();
			//Если регистрация прошла успешно
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