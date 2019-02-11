<?php
	require_once 'vendor/autoload.php';
	require_once 'actions/database/user.php';

	$user = new User;
	$images_public = $user->get_all_images($_SESSION['user']);
	$images_private = $user->get_all_images($_SESSION['user'], 'private');
	
?>