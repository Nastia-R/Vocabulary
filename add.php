<?php
	//Подключение к БД
	include "db.php";
	//Проверка на отправку формы
	// БЛА БЛА БЛА
	if(isset($_POST['word']))
	{
		//Проверка на заполнение полей ввода слова и его перевода
		if (empty($_POST['word']) || empty($_POST['trans'])) 
		{
			$warning = "Заполнены не все поля!";
		}
		else
		{
			if(is_word_exist ($_POST['word']) == false)
			{
				$result = add_word ($_POST['word'], $_POST['descr'], $_POST['trans']);
				close_connection();
				//Если вставка прошла успешно
				if ($result) 
				{
					$msg = "Данные успешно добавлены в таблицу!";
				} 
				else 
				{
					$warning = "Произошла ошибка";
				}
			}
			else
			{
				$warning = "Это слово уже есть в словаре.";
			}
		}		
	} 
	include "templates/add.phtml";
	