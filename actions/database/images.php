<?php

	require 'vendor/autoload.php';

	$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$query = new MongoDB\Driver\Query([]); 

	$rows = $mng->executeQuery("wai.images", $query);
	$img = array();

	$i = 0;

	foreach ($rows as $row) {
		if ($row->role == 'public') {
			$img[$i] = array();
			$img[$i]['title'] = $row->img;
			$img[$i]['author'] = $row->username;
			$i++;
		}
	}

	//echo getcwd();

?>