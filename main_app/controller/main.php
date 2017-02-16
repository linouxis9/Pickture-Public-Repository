<?php
session_start();
require 'model/handle.php';
$LoginHandler = new LoginHandler();
$Picktures = new Picktures();
foreach($Picktures->ReturnLastPicktures() as $ids=>$dontcare)
	{
	$id[] = $dontcare['id'];
	}

require 'view/main.php';
