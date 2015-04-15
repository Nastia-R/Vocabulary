<?php
require_once ('models/acl.php');
require_once ('models/words.php');
$newWords = new ModelWords;
$data = $newWords->getAllWords();

if(isset($_GET['cong']))
{
	$msg = "Слово успешно удалено!";
}

include "templates/main.phtml";
