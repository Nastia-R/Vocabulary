<?php // определ€ем начальные данные
$db_host = 'localhost';
$db_name = 'translator';
$db_username = 'root';
$db_password = '';

// соедин€емс€ с сервером базы данных
$connect_to_db = mysql_connect($db_host, $db_username, $db_password)
	or die("Could not connect: " . mysql_error());
// подключаемс€ к базе данных
mysql_select_db($db_name, $connect_to_db)
	or die("Could not select DB: " . mysql_error());

//дл€ работы русского €зыка
mysql_query("SET NAMES utf8");


function get_all_words()
{
	$qr_result = mysql_query("select * from words")
		or die(mysql_error());

	$data = array() ;
	while($row = mysql_fetch_array($qr_result))
	{
		$data[] = $row;	
	}
	return $data;
}

function close_connection()
{
	// закрываем соединение с сервером  базы данных
	mysql_close($GLOBALS['connect_to_db']);
}

function is_word_exist ($word)
{
	//ѕроверка на существование добавл€емого слова в словаре
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
	
	//ѕеревод строки в массив по переводу строки
	// $explode_trans = explode("/r/n", $trans);

	//¬ставл€ем данные, подставл€€ их в запрос
	return mysql_query("INSERT INTO `words` (`word`, `descr`, `trans`) 
		VALUES ('".$word."','".$descr."', '".$trans."')");
}

function get_word ($num)
{
	//¬ыбираем запись дл€ редактировани€ из бд
	
	$result1 = mysql_query("SELECT * FROM words WHERE id = '$num'")
		or die(mysql_error());
	$row = mysql_fetch_array($result1);
	return $row;
}

function get_trans ($id)
{
	//¬ыбираем запись дл€ редактировани€ из бд
	$result = mysql_query("SELECT trans FROM words WHERE id = '$id'")
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	return $row["trans"];
}


function edit_word ($num, $word, $descr, $trans)
{
	$word = htmlentities($word, ENT_QUOTES);
	$descr = ucfirst(htmlentities($descr, ENT_QUOTES));
	$trans = htmlentities($trans, ENT_QUOTES);
	$result = mysql_query ("UPDATE words SET word='$word', descr='$descr', trans ='$trans' WHERE id='$num'");  
}

function get_random_word ($random)
{
	$qr_result = mysql_query("SELECT word FROM `words` WHERE id = '$random'")
		or die(mysql_error());
	$row = mysql_fetch_array($qr_result);
	return $row["word"];
}

function select_random_id()
{
	$range_result = mysql_query( " SELECT MAX(`id`) AS max_id , MIN(`id`) AS min_id FROM `words` ");
	$range_row = mysql_fetch_object( $range_result );
	$random = mt_rand( $range_row->min_id , $range_row->max_id );
	$result = mysql_query( " SELECT * FROM `words` WHERE `id` >= $random LIMIT 0,1 ");
	if($result)
	{
		$data = mysql_fetch_assoc($result);
		return $data['id'];
	}
}

function is_user_exist ($user)
{
	//ѕроверка на существование добавл€емого слова в словаре
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
	
	//ѕеревод строки в массив по переводу строки
	// $explode_trans = explode("/r/n", $trans);

	//¬ставл€ем данные, подставл€€ их в запрос
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
