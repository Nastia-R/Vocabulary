<?php
$db_host = 'localhost';
$db_name = 'translator';
$db_username = 'root';
$db_password = '';

$connect_to_db = mysql_connect($db_host, $db_username, $db_password)
	or die("Could not connect: " . mysql_error());

mysql_select_db($db_name, $connect_to_db)
	or die("Could not select DB: " . mysql_error());

mysql_query("SET NAMES utf8");

function close_connection()
{
	mysql_close($GLOBALS['connect_to_db']);
}

function is_word_exist ($word)
{
	$word_exist="'".strtolower($word)."'";
	$query = mysql_query("SELECT LOWER('word') FROM 'words' WHERE `word` = $word_exist");
	$count = mysql_result(mysql_query("SELECT count(1) FROM `words` WHERE `word` = $word_exist"), 0);
	if($count == 0)
	{
		return false;
	}
	else
	{
		return true;
	}
}

function add_word ($word, $descr, $trans)
{
	$word = htmlentities($word, ENT_QUOTES);
	$descr = ucfirst(htmlentities($descr, ENT_QUOTES));
	$trans = htmlentities($trans, ENT_QUOTES);
	// $explode_trans = explode("/r/n", $trans);
	return mysql_query("INSERT INTO `words` (`word`, `descr`, `trans`)
		VALUES ('".$word."','".$descr."', '".$trans."')");
}

function get_word ($num)
{
	$result = mysql_query("SELECT * FROM words WHERE id = '$num'")
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row;
}

function edit_word ($num, $word, $descr, trans)
{
	$word = htmlentities($word, ENT_QUOTES);
	$descr = ucfirst(htmlentities($descr, ENT_QUOTES));
	$trans = htmlentities($trans, ENT_QUOTES);
	$result = mysql_query ("UPDATE words SET word='$word', descr='$descr', trans ='$trans' WHERE id='$num'");
}

function is_user_exist ($user)
{
	$query = mysql_query("SELECT * FROM users WHERE user = '$user'");
	$counter = mysql_query("SELECT count(1) FROM users WHERE `user` = '$user'");
	if ($counter === false)
	{
		echo mysql_error();
	}
	else
	{
		$count = mysql_result($counter, 0);
		if($count == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

function add_user ($user, $email, $pass)
{
	$user = htmlentities($user, ENT_QUOTES);
	$email = htmlentities($email, ENT_QUOTES);
	$pass = htmlentities($pass, ENT_QUOTES);

	// $explode_trans = explode("/r/n", $trans);

	return mysql_query("INSERT INTO `users` (`user`, `email`, `pass`)
		VALUES ('".$user."','".$email."', '".$pass."')");
}

function login ($email, $pass, $remember)
{
	//checking security user by email and pass
	$result = mysql_query("SELECT * FROM users WHERE email='$email' AND pass='$pass'")
		or die(mysql_error());
	$row = mysql_fetch_array($result);

	if($row)
	{
		$_SESSION['email'] = $email;
		$_SESSION['pass'] = $pass;
		if($remember)
		{
			setcookie('email', $email, time() + 3600 * 24 * 7);
			setcookie('pass', $pass, time() + 3600 * 24 * 7);
		}
	}
	else
	{
		return false;
	}
	return $row;
}


function logout()
{
	//making cookie too old

	setcookie('email', ' ', time() - 1);
	setcookie('pass', ' ', time() - 1);

	unset($_SESSION['email'], $_SESSION['pass']);
}

function get_all_users()
{
	$qr_result = mysql_query("select id, user, email from users")
		or die(mysql_error());

	$data = array() ;
	while($row = mysql_fetch_array($qr_result))
	{
		$data[] = $row;
	}
	return $data;
}

function get_user ($num)
{

	$result = mysql_query("SELECT * FROM users WHERE id = '$num'")
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row;
}

function edit_user ($num, $user, $email)
{
	$user= htmlentities($user, ENT_QUOTES);
	$email = htmlentities($email, ENT_QUOTES);
	$result = mysql_query ("UPDATE users SET user='$user', email='$email' WHERE id='$num'");
}
