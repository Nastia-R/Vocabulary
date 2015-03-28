<?php
require_once "panel_guests.php";
require_once "models/words.php";

$data = getAllWords();

include "templates/main.phtml";
