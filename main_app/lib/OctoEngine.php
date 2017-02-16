<?php
/* Copyright (C) 2015 Valentin D'Emmanuele */

require 'model/config.php';


class OctoEngine implements Configuration
	{
        protected $servername = Configuration::servername;
        protected $username = Configuration::username;
        protected $password = Configuration::password;
        protected $db = Configuration::db;
        protected $salt = Configuration::salt;

	public $conn;
	function __construct()
		{
		$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

		if ($this->conn->connect_error)
			{
			die("Connection failed: " . $conn->connect_error);
			}

		$result = $this->conn->query("SELECT 1 FROM OctoEngine LIMIT 1;");
		if ($result == FALSE)
			{
			$this->create_table();
			}
		$this->users_informations();
		}
	protected function create_table()
		{
			$sql = "CREATE TABLE OctoEngine (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			nickname VARCHAR(30) NOT NULL,
			password VARCHAR(200) NOT NULL,
			user_group VARCHAR(20) NOT NULL,
			token VARCHAR(200),
			reg_date TIMESTAMP
			)";
		$this->conn->query($sql);
		$this->registeruser("admin", "admin");
		}
	public function users_informations()
		{
                $res = $this->conn->query("SELECT * FROM OctoEngine");
                $res->data_seek(0);
                while ($row = $res->fetch_assoc()) {
                        $array[$row['nickname']] = $row;
                }
		$this->array_db = $array;
		}

	public function loginme($username, $hashedkey)
		{
		$login = 2;
                        if (isset($this->array_db[$username]["nickname"]))
                                {
				if ($hashedkey == $this->array_db[$username]["password"])
					{
					$login = 1;
					}
				}
		return $login;
		}

	public function checkif($username, $perm)
	{
		if ($this->returnperm($username) == $perm) {
			return 1;
		}
		return 2;
	}

	public function returnperm($username)
		{
			return $this->array_db[$username]["user_group"];
		}

	public function registeruser($username, $key)
		{
			if (!($this->array_db[$username]["nickname"] == $username))
                        	{
				$hashed_password = crypt($key, $this->salt);
				                $sql = "INSERT INTO OctoEngine (nickname, password, user_group)
				                VALUES ('$username', '$hashed_password', 'basic_user');";
                				$this->conn->query($sql);

				}
		}

        public function changepassword($username, $key)
                {
                        if ($this->array_db[$username]["nickname"] == $username)
                                {
                                $hashed_password = crypt($key, $this->salt);
				$sql = "UPDATE OctoEngine SET password='$hashed_password' WHERE nickname='$username';";
				$this->conn->query($sql);
                                }
                }

	public function removeuser($username)
	{
		if ($this->array_db[$username]["nickname"] == $username)
			{
			$sql = "DELETE FROM OctoEngine WHERE nickname='$username';";
			$this->conn->query($sql);
			}
	}

	public function editperm($username, $perm)
	{
		$sql = "UPDATE OctoEngine SET user_group='$perm' WHERE nickname='$username';";
                $this->conn->query($sql);
	}
	public function token($username)
	{
	$sql = "SELECT token FROM OctoEngine where nickname='$username' LIMIT 1";
        if ($this->conn->query($sql)->fetch_assoc()['token'] == NULL)
        	{
	        $sql = "UPDATE OctoEngine SET token='".bin2hex(openssl_random_pseudo_bytes(64))."' WHERE nickname='$username';";
		$this->conn->query($sql);
        	}
	$this->users_informations();
	return $this->array_db[$username]['token'];
	}

	}


?>
