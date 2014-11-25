<?php 
include "db.php";
$random_id = (int)select_random_id();
$rand_word = get_random_word ($random_id);

if(!empty($_POST['trans']))
{
	get_trans ($rand_word);
	$translate = get_trans ($rand_word);
	var_dump($translate);
	if($_POST['trans'] == $translate)
	{
		echo "Right!";
	}
	else
	{
		echo "False!";
	}
}
else
{
echo "Input your translate!";
}
include "templates/random.phtml";