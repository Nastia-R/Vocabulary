<?php
require_once ('models/acl.php');
require_once ('models/words.php');
$newWords = new ModelWords;
$data = $newWords->getAllWords();

include "templates/main.phtml";
