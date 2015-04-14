<?php
session_start();
require_once('models/users.php');
include "panel_users.php";
$usersObject = new ModelUsers;
mysql_query("SET NAMES utf8");
?>
	<!DOCTYPE html>
	<html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style_delete.css">
	<link rel="stylesheet" type="text/css" href="css/style_panel.css">
	<?php include "templates/panel.phtml"; ?>
	<div class="table-title">
		<h1 align="center">Do you really want to remove this user?</h1>
	</div>
	<table class="table-fill">
	<thead>
	<tr>
	<th class="text-left">ID</th>
	<th class="text-left">User</th>
	<th class="text-left">Email</th>
	</tr>
	<br/>
	</thead>
	<tbody class="table-hover">
<?php
if(isset($_GET['num']))
{
	$userId = $_GET['num'];
	$usersArray = $usersObject->getUser($userId);
	echo '<tr>';
	foreach($usersArray AS $data)
	{ 
		echo '<td>' . $data . '</td>';
	}
	echo '</tr>';
	echo '</tbody>';
	echo '</table>';
	echo "<br/>";
}

if ( isset($_GET['del']) && !empty($_GET['del']) ) 
{
	$usersObject->deleteUser($userId);
	header("Location:users_list.php?cong=1");
}
	echo "<a name=\"userId\" href=\"?num=".$userId."&del=1\" class=\"c\">Delete</a>";
	echo "<a name=\"back\" href=\"users_list.php\" class=\"c1\">Cancel</a>";
?>
</html>
