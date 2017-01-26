<?php

	$url = $_GET['url'] ?? 'indexController';
	//echo 'URL = "' . $url . '"<br />';

	$controllerName = mb_strtolower(explode('/', $url)[0]).'Controller';

	if (!is_file('./controllers/'.$controllerName.'.php'))
	$controllerName = 'indexController';
	//echo 'controller = "' . $controllerName . '"<br />';

  	require_once ('./controllers/'.$controllerName.'.php');

	$controller = new $controllerName;
	$controller->parseUrl($url);
	$controller->do();
?>