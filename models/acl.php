﻿<?php
require_once('session.php');

if(!isset($_SESSION['email']) && isset($_COOKIE['email']) && isset($_COOKIE['pass']))
{
	$_SESSION['email'] = $_COOKIE['email'];
	$_SESSION['pass'] = $_COOKIE['pass'];
}

if(isset($_SESSION['email']) && isset($_SESSION['pass']))
{
	$email = $_SESSION['email'];
	$panel_user = true;
}
else
{
	header("Location:authorisation.php");
}