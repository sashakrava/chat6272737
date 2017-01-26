<?php
echo
'<!DOCTYPE html>'.
'<html>'.
'<head>'.
	'<title>' . $this->model->getTitle() .'</title>'.
	'<link rel="stylesheet" href="../resource/style.css">'.
	'<script type="text/javascript" src="./view/js/' . $this->controller . '.js"></script>'.
'</head>'.
'<body>';
?>