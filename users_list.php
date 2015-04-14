<?php
require_once('models/connectionFabric.php');
require_once('models/users.php');
require_once ('models/acl.php');

$newUser = new ModelUsers;
$users_list = $newUser->getAllUsers();

if(isset($_GET['cong']))
{
	$msg = "Удаление юзера прошло успешно!";
}
include "templates/users_list.phtml";
