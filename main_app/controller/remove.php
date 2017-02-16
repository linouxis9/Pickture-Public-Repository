<?php
session_start();

require 'model/handle.php';

$LoginHandler = new LoginHandler();
$Picktures = new Picktures();
if ($LoginHandler->islogin() == 1)
   {
	$id = $_GET['file'];
	$array = $Picktures->ReturnPicktureInfoByID($id);
	if ($array[$id]['owner'] == $LoginHandler->nickname)
		{
		unlink($array[$id]['path']);
		$Picktures->DeletePicktureByUser($id);
		}
}
header("Location: panel.php");
