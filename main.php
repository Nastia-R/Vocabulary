<?php
require_once('autoload.php');
require_once ('models/acl.php');
$newWords = new Models\Words;
$data = $newWords->getAllWords();

if(isset($_GET['cong']))
{
	$msg = "Слово успешно удалено!";
}

include "templates/main.phtml";
