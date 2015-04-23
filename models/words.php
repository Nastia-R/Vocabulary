<?php
namespace Models;
use PDO;

class Words 
{
  private $connection;

  public function __construct()
  {
    $this->connection = ConnectionFabric::getInstance()->getConnection();
  }

  public function getAllWords()
  {
    $query = 'SELECT * FROM words';
    $allWordsStatement = $this->connection->query($query);
    return $allWordsStatement->fetchAll();
  }

  public function selectRandomId ()
  {
    $query = "SELECT MAX(`id`) AS max_id , MIN(`id`) AS min_id FROM `words`";
    $randomIdStatement = $this->connection->query($query);
    $randomIdObject = $randomIdStatement->fetchObject();
    $randomId = mt_rand( $randomIdObject->min_id , $randomIdObject->max_id );
    $query1 =  "SELECT * FROM `words` WHERE `id` >= $randomId LIMIT 0,1 ";
    $result = $this->connection->query($query1);
  	$data = $result->fetch();
  	return $data['id'];
  }

  public function getWordById($id)
  {
    $query = "SELECT word FROM `words` WHERE id = '$id'";
    $randomWordStatement = $this->connection->query($query);
    $randomWordArray = $randomWordStatement->fetch();
    return $randomWordArray['word'];
  }

  public function getTranslationById($id)
  {
    $query = "SELECT trans FROM words WHERE id = '$id'";
    $translationStatement = $this->connection->query($query);
    $translationArray = $translationStatement->fetch();
    return $translationArray['trans'];
  }

  public function isWordExist ($word)
  {
    $wordExist = "'".strtolower($word)."'";
    $stm = $this->connection->prepare("SELECT * FROM `words` WHERE `word` = $wordExist");
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

  public function addWord($word, $description, $translation)
  {
  	$word = htmlentities($word, ENT_QUOTES);
  	$description = ucfirst(htmlentities($description, ENT_QUOTES));
  	$translation = htmlentities($translation, ENT_QUOTES);
    $addWordStatement = $this->connection->exec("INSERT INTO `words` (`word`, `descr`, `trans`)
  		VALUES ('".$word."','".$description."', '".$translation."')");
      
    return (bool) $addWordStatement;
  }

  public function getWord($num)
  {
    $query = "SELECT * FROM words WHERE id = '$num'";
    $getWordStatement = $this->connection->query($query);
    $getWordArray = $getWordStatement->fetch(PDO::FETCH_ASSOC);
    return $getWordArray;
  }

  public function editWord($num, $word, $description, $translation)
  {
  	$word = htmlentities($word, ENT_QUOTES);
  	$description = ucfirst(htmlentities($description, ENT_QUOTES));
    $translation = htmlentities($translation, ENT_QUOTES);

    $query = "UPDATE words SET word='$word', descr='$description', trans ='$translation' WHERE id='$num'";
    $editWordStatement = $this->connection->query($query);
  }

  public function deleteWord($num)
  {
    $query = "DELETE FROM `translator`.`words` WHERE `words`.`id` ='$num'";
    $deleteWordStatement = $this->connection->query($query);
  }

}