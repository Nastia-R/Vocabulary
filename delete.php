<?php
require_once('models/words.php');
require_once ('models/acl.php');

$wordsObject = new ModelWords;
mysql_query("SET NAMES utf8");

if ( isset($_GET['del']) && !empty($_GET['del']) ) 
{
	$wordsObject->deleteWord($wordId);

	header("Location:templates/delete_word.phtml");
}	
require_once('templates/delete.phtml');