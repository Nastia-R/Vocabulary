<?php
	//Подключение к БД
	include "db.php";
	// here
	
	if(isset($_GET['num']))
	{
		$edit_row = get_word ($_GET['num']);
	}
	//Проверка на отправку формы
	if(isset($_POST['word']))
	{
		//Проверка на заполнение полей ввода слова и его перевода
		if (empty($_POST['word']) || empty($_POST['trans'])) 
		{
			$warning = "Заполнены не все поля!";
		}
		else
		{
			edit_word ($_GET['num'], $_POST['word'], $_POST['descr'], $_POST['trans']);
			$edit_row = get_word ($_GET['num']);
			close_connection();
			//вставка прошла успешно
			$msg = "Данные успешно обновлены!";
		}		
	} 
	include "templates/edit.phtml";