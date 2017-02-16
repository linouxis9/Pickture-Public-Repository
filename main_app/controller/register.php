<?php
session_start();
require 'model/handle.php';
$LoginHandler = new LoginHandler();
		if (isset($_POST['login']) and isset($_POST['key']))
			{
			$LoginHandler->octo->registeruser($_POST['login'], $_POST['key']);
			$_SESSION['stat'] = 1;
			header("Location: login.php");
			}
