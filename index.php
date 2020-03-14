<?php

session_start();

require 'access.php';
require 'views/topbar.php';

$action_url = $_GET['page'];

switch ($action_url) {
	case 'quiz':
		require 'views/quiz.html';
		break;
	case 'home':
		require 'views/home.html';
		break;
	case 'gallery':
		require 'views/gallery.php';
		break;
	case 'login':
		require 'views/login.php';
		break;
	case 'panel':
		if ($logged_in) {
			require 'views/panel.php';
			break;
		}
	default:
		require 'views/home.html';
		break;
}

include 'views/footer.php';
?>
