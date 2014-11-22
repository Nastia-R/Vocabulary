<?php // определяем начальные данные
$db_host = 'localhost';
$db_name = 'translator';
$db_username = 'root';
$db_password = '';

// соединяемся с сервером базы данных
$connect_to_db = mysql_connect($db_host, $db_username, $db_password)
	or die("Could not connect: " . mysql_error());
// подключаемся к базе данных
mysql_select_db($db_name, $connect_to_db)
	or die("Could not select DB: " . mysql_error());

//для работы русского языка
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
	//Проверка на существование добавляемого слова в словаре
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
	
	//Перевод строки в массив по переводу строки
	// $explode_trans = explode("/r/n", $trans);

	//Вставляем данные, подставляя их в запрос
	return mysql_query("INSERT INTO `words` (`word`, `descr`, `trans`) 
		VALUES ('".$word."','".$descr."', '".$trans."')");
}

function get_word ($num)
{
	//Выбираем запись для редактирования из бд
	
	$result1 = mysql_query("SELECT * FROM words WHERE id = '$num'")
		or die(mysql_error());
	$row = mysql_fetch_array($result1);
	return $row;
}

function edit_word ($num, $word, $descr, $trans)
{
	$word = htmlentities($word, ENT_QUOTES);
	$descr = ucfirst(htmlentities($descr, ENT_QUOTES));
	$trans = htmlentities($trans, ENT_QUOTES);
	$result = mysql_query ("UPDATE words SET word='$word', descr='$descr', trans ='$trans' WHERE id='$num'");  
}