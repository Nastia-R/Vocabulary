<?php
require_once('models/users.php');
require_once ('models/acl.php');

$usersObject = new ModelUsers;
mysql_query("SET NAMES utf8");
require_once('templates/delete_user.phtml');