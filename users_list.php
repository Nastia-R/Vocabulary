<?php
require_once('autoload.php');
require_once ('models/acl.php');

$newUser = new Models\Users;
$users_list = $newUser->getAllUsers();

if(isset($_GET['cong']))
{
	$msg = "Удаление юзера прошло успешно!";
}
include "templates/users_list.phtml";
