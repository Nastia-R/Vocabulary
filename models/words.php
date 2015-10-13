<?php
namespace Models;
use PDO;

class Words 
{
  private $connection;
  protected $userId;
  public $userEmail;

  protected $usersObject;//shit-object

  public function __construct()
  {
    $this->connection = ConnectionFabric::getInstance()->getConnection();
    $this->userEmail = Authorisation::getInstance()->getEmail();
    $this->usersObject = new Users();
    $this->userId = $this->usersObject->getUserIdByEmail($this->userEmail)->user_id;//shit
  }

  public function getAllWords()
  {
    $userId = $this->userId;
    $query = 'SELECT id, word, descr, trans FROM words WHERE user_id = "'.$userId.'"';
    $allWordsStatement = $this->connection->query($query);
    $wordsArray = $allWordsStatement->fetchAll();
    return $wordsArray;
  }

  public function getSomeWords($count)
  {
    $userId = $this->userId;
    $query = 'SELECT id, word, descr, trans FROM words WHERE user_id = "'.$userId.'" LIMIT '.$count;
    $wordsStatement = $this->connection->query($query);
    $wordsArray = $wordsStatement->fetchAll(PDO::FETCH_ASSOC);
    return $wordsArray;
  }

  public function selectRandomId()
  {
    $query = "SELECT MAX(`id`) AS max_id , MIN(`id`) AS min_id FROM `words` WHERE `user_id`= $this->userId";
    $randomIdStatement = $this->connection->query($query);
    $randomIdObject = $randomIdStatement->fetchObject();
    $randomId = mt_rand( $randomIdObject->min_id , $randomIdObject->max_id );
    $query1 =  "SELECT * FROM `words` WHERE `id` >= $randomId AND `user_id`= $this->userId LIMIT 0,1";
    $result = $this->connection->query($query1);
  	$data = $result->fetch();
  	return $data['id'];
  }

  public function getWordById($id)
  {
    $query = "SELECT word FROM `words` WHERE id = '$id'";
    $wordRandomStatement = $this->connection->query($query);
    $wordRandomArray = $wordRandomStatement->fetch();
    return $wordRandomArray['word'];
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
    $userId = $this->userId;
    $wordExist = "'".strtolower($word)."'";
    $stm = $this->connection->prepare("SELECT * FROM `words` WHERE `word` = $wordExist AND `user_id` = $userId");
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

  public function addWord($word, $description, $translation, $userId)
  {
  	$word = htmlentities($word, ENT_QUOTES);
  	$description = htmlentities($description, ENT_QUOTES);
  	$translation = htmlentities($translation, ENT_QUOTES);
    $addWordStatement = $this->connection->exec("INSERT INTO `words` (`word`, `descr`, `trans`, `user_id`)
  		VALUES ('".$word."','".$description."', '".$translation."','".$userId."')");
      
    return (bool) $addWordStatement;
  }

  public function getWord($num)
  {
    $query = "SELECT id, word, descr, trans FROM words WHERE id = '$num'";
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

  public function recordRandomWordAnswer($wordId, $trigger)
  {
    $recordingDate = date('Y-m-d H:i:s');
    $query = "INSERT INTO `random_history` (`word_id`, `answer`, `date`) VALUES ('".$wordId."','".$trigger."','".$recordingDate."')";
    $recordAnswerStatement = $this->connection->query($query);
  }

}