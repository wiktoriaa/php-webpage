<?php
	session_start();

	$images = array_keys($_POST);

	if (!isset($_SESSION['saved']))
		$_SESSION['saved'] = array();


	foreach ($images as $img) {
		$img[strlen($img)-4] = '.';
		
		if (!in_array($img, $_SESSION['saved']))
			$_SESSION['saved'][] = $img;
	}

	header('Location: ../?page=gallery');
?>