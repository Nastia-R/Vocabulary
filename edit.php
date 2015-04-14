<?php
session_start();
require_once('models/connectionFabric.php');
include "panel_users.php";
require_once ('models/words.php');
if(isset($_GET['num']))
{
	$newWords = new ModelWords;
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
