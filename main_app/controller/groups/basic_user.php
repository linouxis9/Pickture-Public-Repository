<?php
if (!file_exists('data/picktures/'.$LoginHandler->nickname)) {
    mkdir("data/picktures/" . $LoginHandler->nickname, 0777);
} else {
    echo "";
}
                $files = $Picktures->ReturnPicktureInfoByUser($LoginHandler->nickname);

require 'view/groups/basic_user.php';
