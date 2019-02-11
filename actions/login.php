<?php
	session_start();
	
	require '../vendor/autoload.php';
	require_once 'database/user.php';
	
	$user = new User;
	
		if ($_POST["l-action"] == "register") {

			if ($_POST['password'] != $_POST['confirm-password']) {

				header("Location: ../?page=login&err=p");

			}

			$user->add($_POST['username'], $_POST['password'], $_POST['email']);

		}


		else if ($_POST["l-action"] == "login") {
			
			$user->login($_POST['username'], $_POST['password']);

		}


		else 
			header("Location: ../?page=home");


?>