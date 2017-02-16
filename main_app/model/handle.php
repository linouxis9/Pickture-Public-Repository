<?php
/* Copyright (C) 2015 Valentin D'Emmanuele */
require 'model/picktures.php';
require 'model/sso.php';

class LoginHandler
	{
	public $nickname;
	protected $login;
	protected $admin;
	public $octo;
        protected $salt = '$2a$07$usesomesillystringforsalt$';

	function __construct()
		{
		$this->sso = new OctoEngine_Outside();
		$this->octo = new OctoEngine();

		if (isset($_POST['key']))
        		{
        		$_SESSION['login'] = $_POST['login'];
			$d = crypt($_POST['key'], $this->salt);
			}
		  else
			{
			$d = $_SESSION['hashkey'];
			unset($_SESSION['hashkey']);
			}
		$this->d = $d;
		if (isset($_SESSION['token']) or isset($_GET['token']))
			{
			if (isset($_GET['token']))
        			{
				$_SESSION['token'] = $_GET['token'];
       				$_SESSION['login'] = $_GET['user'];
  				}
			$this->login_token();
			}
		else
			{
			$this->login_password();
			}
		$this->nickname = $_SESSION['login'];
		}

	function login_password()
		{
                $this->login = $this->octo->loginme($_SESSION['login'], $this->d);
                if ($this->login == 1)
                        {
                        $_SESSION['hashkey'] = $this->d;
                        }

		}
	function login_token()
                {
                $this->login = $this->sso->loginme($_SESSION['login'], $_SESSION['token']);
                }
	function returnperm()
		{
		if (isset($_SESSION['token']))
			{
			return $this->sso->db["user_group"];
			}
		else
			{
			return $this->octo->returnperm($this->nickname);
			}
		}
	function islogin()
		{
		return $this->login;
		}

	function isadmin()
		{
		return $this->admin;
		}
	}

?>
