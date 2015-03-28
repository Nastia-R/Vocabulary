<?php
require_once "connectionFabric.php";
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
