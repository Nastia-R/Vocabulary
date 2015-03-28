<?php 	
session_start();
include "db.php";
include "panel_guests.php";
$data = get_all_words();
close_connection();
include "templates/main.phtml";