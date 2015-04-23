<?php
require_once('autoload.php');
require_once ('models/acl.php');

$usersObject = new Models\Users;
mysql_query("SET NAMES utf8");
require_once('templates/delete_user.phtml');