<?php
session_start();
if (isset($_SESSION['stat']))
	{
	unset($_SESSION['stat']);
	}
require 'model/handle.php';
$LoginHandler = new LoginHandler();
$Picktures = new Picktures();

$mime = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['file']['tmp_name']);

$arrayIMG = array(
    image_type_to_mime_type(IMAGETYPE_GIF),
    image_type_to_mime_type(IMAGETYPE_JPEG),
    image_type_to_mime_type(IMAGETYPE_PNG),
    image_type_to_mime_type(IMAGETYPE_SWF),
    image_type_to_mime_type(IMAGETYPE_PSD),
    image_type_to_mime_type(IMAGETYPE_BMP),
    image_type_to_mime_type(IMAGETYPE_TIFF_II),
    image_type_to_mime_type(IMAGETYPE_TIFF_MM),
    image_type_to_mime_type(IMAGETYPE_JPC),
    image_type_to_mime_type(IMAGETYPE_JP2),
    image_type_to_mime_type(IMAGETYPE_JPX),
    image_type_to_mime_type(IMAGETYPE_JB2),
    image_type_to_mime_type(IMAGETYPE_SWC),
    image_type_to_mime_type(IMAGETYPE_IFF),
    image_type_to_mime_type(IMAGETYPE_WBM),
    image_type_to_mime_type(IMAGETYPE_XBM),
    image_type_to_mime_type(IMAGETYPE_ICO),
    'image/x-tga',
    'image/x-targa',
    'image/x-hdr'
);



if ($LoginHandler->islogin() == 1)
	{
        if (($LoginHandler->returnperm() == "basic_user" ) or ($LoginHandler->returnperm() == "admin"))
                {
		if (in_array($mime, $arrayIMG))
			{
				$newdir = 'data/picktures/'.$LoginHandler->nickname.'/'.$_FILES['file']['name'];
				move_uploaded_file($_FILES['file']['tmp_name'], $newdir);
				$Picktures->UploadPickture($_FILES['file']['name'], $newdir, $LoginHandler->nickname, 0);
			}

                header('Location: panel.php');
		}
}
