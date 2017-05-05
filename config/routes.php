<?php
	function call($controller, $action) {
		require_once('controllers/' . $controller . '_controller.php');

		switch ($controller) {
			case 'pages':
				$controller = new PagesController();
				break;
		}
		
		$controller->{ $action }();
	}
	
	/************************* MAPPING **********************************************/
	$controllers = array('pages' => array('search','create','remove','update','error'));
	/********************************************************************************/
	
	if (array_key_exists($controller, $controllers)) {
		if (in_array($action, $controllers[$controller])) {
			call($controller, $action);
		}
		else {
			call('pages', 'error');
		}
	}
	else {
		call('pages', 'error');
	}
?>