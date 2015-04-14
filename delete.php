<?php
session_start();
require_once('models/words.php');
include "panel_users.php";
$wordsObject = new ModelWords;
mysql_query("SET NAMES utf8");
?>
	<!DOCTYPE html>
	<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style_delete.css">
	<link rel="stylesheet" type="text/css" href="css/style_panel.css">
	<?php include "templates/panel.phtml"; ?>
	<div class="table-title">
		<h1 align="center">Do you really want to remove this word?</h1>
	</div>
	<table class="table-fill">
	<thead>
	<tr>
	<th class="text-left">ID</th>
	<th class="text-left">Word</th>
	<th class="text-left">Description</th>
	<th class="text-left">Translate</th>
	</tr>
	<br/>
	</thead>
	<tbody class="table-hover">
<?php
if(isset($_GET['num']))
{
	$wordId = $_GET['num'];
	$wordsArray = $wordsObject->getWord($wordId);
	echo '<tr>';
	foreach($wordsArray AS $data)
	{ 
		echo '<td>' . $data . '</td>';

	}
		echo '</tr>';
		echo '</tbody>';
		echo '</table>';
		echo "<br/>";
}
	echo "<a name=\"wordId\" href=\"?num=".$wordId."&del=1\" class=\"c\">DELETE</a>";
	echo "<a name=\"back\" href=\"main.php\" class=\"c1\">To main page</a>";

if ( isset($_GET['del']) && !empty($_GET['del']) ) 
{
	$wordsObject->deleteWord($wordId);

	header("Location:delete_word.php");
}	
?>
</html>