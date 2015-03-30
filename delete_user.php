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
	$row = $_GET['num'];
	$qr_result = mysql_query("select id, user, email from users WHERE id = $row")
		or die(mysql_error());

	while($users_list = mysql_fetch_array($qr_result))
	{
		echo '<tr>';
		echo '<td>' . $users_list['id'] . '</td>';
		echo '<td>' . $users_list['user'] . '</td>';
		echo '<td>' . $users_list['email'] . '</td>';
		echo '</tr>';
		echo '</tbody>';
		echo '</table>';
		echo "<br/>";
	}
}
// ���� ���� ������ ������ ��������, ������� ������
if(isset($_GET['del']) && !empty($_GET['del']) )
{
	$query = "DELETE FROM users WHERE id = $row";
	mysql_query($query) or die(mysql_error());
	header("Location:users_list.php?cong=1");
}
	echo "<a name=\"row\" href=\"?num=".$row."&del=1\" class=\"c\">Delete</a>";
	echo "<a name=\"back\" href=\"users_list.php\" class=\"c1\">Cancel</a>";

	// Ǉ�������� ���������� � ��������  ���� ������
	mysql_close($connect_to_db);
?>
</html>
