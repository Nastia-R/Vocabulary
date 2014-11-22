<?php 	
	include "db.php";
	$data = get_all_words();
	close_connection();
	include "templates/main.phtml";