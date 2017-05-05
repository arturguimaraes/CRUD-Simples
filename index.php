<?php
	require_once('config/connection.php');

	if (isset($_GET['controller']) && isset($_GET['action'])) {
		$controller = $_GET['controller'];
		$action     = $_GET['action'];
	}
	else {
		$controller = 'pages';
		$action     = 'search';
	}
	
	require_once('views/templates/layout.php');
?>