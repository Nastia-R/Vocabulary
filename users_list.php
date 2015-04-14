<?php
session_start();
require_once('models/connectionFabric.php');
require_once('models/users.php');
include "panel_users.php";
$newUser = new ModelUsers;
$users_list = $newUser->getAllUsers();

if(isset($_GET['cong']))
{
	$msg = "Удаление юзера прошло успешно!";
}
include "templates/users_list.phtml";
