<?php
	session_start();
	echo 'ok';
	$images = array_keys($_POST);

	if (isset($_SESSION['saved'])) {

		foreach ($images as $img) {
			$img[strlen($img)-4] = '.';
			$pos = array_search($img, $_SESSION['saved']);

			unset($_SESSION['saved'][$pos]);
		}

	}


	header('Location: ../?page=panel');
?>