<?php
session_start();
include "db.php";
require_once('models/users.php');
include "panel_users.php";
$newUser = new ModelUsers;
$users_list = $newUser->getAllUsers();
close_connection();
if(isset($_GET['cong']))
{
	$msg = "Удаление юзера прошло успешно!";
}
include "templates/users_list.phtml";