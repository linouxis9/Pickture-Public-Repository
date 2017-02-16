<?php
session_start();

require 'model/handle.php';

$LoginHandler = new LoginHandler();
$Picktures = new Picktures();

	$id = $_GET['file'];
	$array = $Picktures->ReturnPicktureInfoByID($id);
	$data = getimagesize($array[$id]['path']);
	$size = filesize($array[$id]['path']);
		#header('Content-Description: File Transfer');
		header('Content-Type: '.$data['mime']);
		header('Content-Disposition: inline; filename="'.$array[$id]['name'].'"');
		header('Content-Length: '.$size);
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		readfile($array[$id]['path']);
