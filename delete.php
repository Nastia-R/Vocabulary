<?php
session_start();
include "db.php";
include "panel_users.php";

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
	$row = $_GET['num'];
	$qr_result = mysql_query("select * from words WHERE id = $row")
		or die(mysql_error());

	while($data = mysql_fetch_array($qr_result))
	{ 
		echo '<tr>';
		echo '<td>' . $data['id'] . '</td>';
		echo '<td>' . $data['word'] . '</td>';
		echo '<td>' . $data['descr'] . '</td>';
		echo '<td>' . $data['trans'] . '</td>';
		echo '</tr>';
		echo '</tbody>';
		echo '</table>';
		echo "<br/>";
	}
}

if ( isset($_GET['del']) && !empty($_GET['del']) ) 
{
	$query = "delete from words where id='".$_GET['num']."'"; 
	mysql_query($query) or die(mysql_error());
	header("Location:delete_word.php");
}	
	echo "<a name=\"row\" href=\"?num=".$row."&del=1\" class=\"c\">DELETE</a>";
	echo "<a name=\"back\" href=\"main.php\" class=\"c1\">To main page</a>";

	
	mysql_close($connect_to_db);
?>
</html>