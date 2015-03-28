<?php
session_start();
include "db.php";
include "panel_users.php";
require_once "/models/words.php";
// -=-=-=-=-= рандомайзер=-=-=-=--
// 1) генерируем random ай ди
$rand_id = selectRandomId();
// 2) достаем по нему данные из БД
$rand_word = getWordById($rand_id);
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=--

if(isset($_POST['trans']))
{
// 1) получаем айди с рандом.рнр
$id = $_POST['id'];
// 2) получаем то, что ввел юзер
$user_trans = $_POST['trans'];
// 3) вытягиваем из БД транс по ай ди
$trans = getTranslationById($id);
// 4) сравниваем ввод юзера и перевод из БД
if($trans == $user_trans)
{
	$msg = "Right!";
}
else
{
	$msg = "Wrong! Right translation is \"$trans\" and you typed \"$user_trans\"";
}
}

// 3) отображаем форму с вордом
include "templates/random.phtml";
