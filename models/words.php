<?php
require_once "connectionFabric.php";
class ModelWords 
{

  function getAllWords()
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = 'SELECT * FROM words';
    $allWordsStatement = $connection->query($query);
    return $allWordsStatement->fetchAll();
  }

  function selectRandomId ()
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "SELECT MAX(`id`) AS max_id , MIN(`id`) AS min_id FROM `words`";
    $randomIdStatement = $connection->query($query);
    $randomIdObject = $randomIdStatement->fetchObject();
    $randomId = mt_rand( $randomIdObject->min_id , $randomIdObject->max_id );
    $query1 =  "SELECT * FROM `words` WHERE `id` >= $randomId LIMIT 0,1 ";
    $result = $connection->query($query1);
  	$data = $result->fetch();
  	return $data['id'];
  }

  function getWordById($id)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "SELECT word FROM `words` WHERE id = '$id'";
    $randomWordStatement = $connection->query($query);
    $randomWordArray = $randomWordStatement->fetch();
    return $randomWordArray['word'];
  }

  function getTranslationById($id)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "SELECT trans FROM words WHERE id = '$id'";
    $translationStatement = $connection->query($query);
    $translationArray = $translationStatement->fetch();
    return $translationArray['trans'];
  }

  function isWordExist ($word)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $wordExist = "'".strtolower($word)."'";
    $stm = $connection->prepare("SELECT * FROM `words` WHERE `word` = $wordExist");
    $stm->execute();
    $count = $stm->fetchAll();
  	if($count == false)
  	{
  		return false;
  	}
  	else
  	{
  		return true;
  	}
  }

  function addWord($word, $description, $translation)
  {
  	$word = htmlentities($word, ENT_QUOTES);
  	$description = ucfirst(htmlentities($description, ENT_QUOTES));
  	$translation = htmlentities($translation, ENT_QUOTES);
  	// $explode_trans = explode("/r/n", $trans);

    $connection = ConnectionFabric::getInstance()->getConnection();
    $addWordStatement = $connection->exec("INSERT INTO `words` (`word`, `descr`, `trans`)
  		VALUES ('".$word."','".$description."', '".$translation."')");

    if($addWordStatement == false)
    {
      return false;
    }
    else
    {
      return true;
    }
  }

  function getWord($num)
  {
    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "SELECT * FROM words WHERE id = '$num'";
    $getWordStatement = $connection->query($query);
    $getWordArray = $getWordStatement->fetch();
    return $getWordArray;
  }

  function editWord ($num, $word, $description, $translation)
  {
  	$word = htmlentities($word, ENT_QUOTES);
  	$description = ucfirst(htmlentities($description, ENT_QUOTES));
    $translation = htmlentities($translation, ENT_QUOTES);

    $connection = ConnectionFabric::getInstance()->getConnection();
    $query = "UPDATE words SET word='$word', descr='$description', trans ='$translation' WHERE id='$num'";
    $editWordStatement = $connection->query($query);
  }
}