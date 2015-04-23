<?php
require_once('autoload.php');
require_once ('models/acl.php');

$wordsObject = new Models\Words;
mysql_query("SET NAMES utf8");

if ( isset($_GET['del']) && !empty($_GET['del']) ) 
{
	$wordsObject->deleteWord($wordId);

	header("Location:templates/delete_word.phtml");
}	
require_once('templates/delete.phtml');