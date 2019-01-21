<?php

	require 'vendor/autoload.php';
	require_once 'actions/database/user.php';

	$user = new User;
	$logged_in = false;

	if (isset($_SESSION['id']))
		$logged_in = true;


?>