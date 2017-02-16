<?php
                if (isset($_POST['action']))
                        {
                        switch ($_POST['action'])
                                {
                        case "register":
                                $LoginHandler->octo->registeruser($_POST['username'], $_POST['todo']);
                                break;
                        case "changeperm":
                                $LoginHandler->octo->editperm($_POST['username'], $_POST['todo']);
                                break;
                        case "remove":
                                $LoginHandler->octo->removeuser($_POST['username']);
                                break;
                        case "showperm":
                                echo '<div class="alert alert-success" role="alert">' . $LoginHandler->returnperm($_POST['username']) . '</div>';
                                break;
                        case "editmainmsg":
                                $db = new ValDB("data/mainmsg");
                                $db->EditData("news" . $_POST['username'], $_POST['todo']);
                                $db->CommitJson();
                                break;
                                }
                        }

require 'controller/groups/basic_user.php';
require 'view/groups/admin.php';
