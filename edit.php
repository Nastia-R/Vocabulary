<?php
require_once('autoload.php');
require_once('models/connectionFabric.php');
require_once ('models/acl.php');

if(isset($_GET['num']))
{
	$newWords = new Models\Words;
	$edit_row = $newWords->getWord($_GET['num']);
	//Проверка на отправку формы
	if(isset($_POST['word']))
	{
		//Проверка на заполнение полей ввода слова и его перевода
		if(empty($_POST['word']) || empty($_POST['trans']))
		{
			$warning = "Заполнены не все поля!";
		}
		else
		{
			$newWords->editWord($_GET['num'], $_POST['word'], $_POST['descr'], $_POST['trans']);
			$edit_row = $newWords->getWord($_GET['num']);
			//вставка прошла успешно
			$msg = "Данные успешно обновлены!";
		}
	}
}

include "templates/edit.phtml";
