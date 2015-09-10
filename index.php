<?php
require_once('autoload.php');
define('ROOT_FOLDER', __DIR__);
//require_once ('models/acl.php');

$page = isset($_GET['page']) ? $_GET['page'] : false;

$controller = \Models\ControllerFactory::getController($page);

$controller->request();
