<?php
if(!isset($_SESSION['email']) && isset($_COOKIE['email']) && isset($_COOKIE['pass']))
{
	$_SESSION['email'] = $_COOKIE['email'];
	$_SESSION['pass'] = $_COOKIE['pass'];
}

if(isset($_SESSION['email']) && isset($_SESSION['pass']))
{
	$email = $_SESSION['email'];
	$panel_username = true;
}
else
{
	$panel_login = true;
}