<?php
session_start();
include "db.php";
include "panel_users.php";
$users_list = get_all_users();
close_connection();
if(isset($_GET['cong']))
{
	$msg = "Удаление юзера прошло успешно!";
}
include "templates/users_list.phtml";