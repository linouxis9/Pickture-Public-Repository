<?php
/* Copyright (C) 2015 Valentin D'Emmanuele */
require 'lib/OctoEngine.php';
require_once 'model/config.php';

class Picktures implements Configuration
	{
        protected $servername = Configuration::servername;
        protected $username = Configuration::username;
        protected $password = Configuration::password;
        protected $db = Configuration::db;
	function __construct()
		{
                $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

                if ($this->conn->connect_error)
                        {
                        die("Connection failed: " . $conn->connect_error);
                        }

                $result = $this->conn->query("SELECT 1 FROM OctoEngine_pictures LIMIT 1;");
                if ($result == FALSE)
                        {
                        $this->create_table();
                        }

		}
        protected function create_table()
                {
                        $sql = "CREATE TABLE OctoEngine_pictures (
                        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(50) NOT NULL,
                        path VARCHAR(200) NOT NULL,
                        owner VARCHAR(20) NOT NULL,
                        priv TINYINT(1) NOT NULL,
                        reg_date TIMESTAMP
                        )";
                $this->conn->query($sql);
                }

        function UploadPickture($name, $path, $owner, $priv)
                {
		$sql = "INSERT INTO OctoEngine_pictures (name, path, owner, priv)
                        VALUES ('$name', '$path', '$owner', '$priv');";
                $this->conn->query($sql);
                }

	function ReturnLastPicktures()
		{
		$sql = "SELECT * from OctoEngine_pictures where priv='0' ORDER by ID DESC LIMIT 10";
		$res = $this->conn->query($sql);
		$res->data_seek(0);
		$x = 0;
		while ($row = $res->fetch_assoc()) {
                        $array[$x] = $row;
			$x = $x+1;
                }
		return $array;
		}

        function ReturnPicktureInfoByID($id)
                {
                $sql = "SELECT * from OctoEngine_pictures where id='$id' LIMIT 1";
                $res = $this->conn->query($sql);
                $res->data_seek(0);
                while ($row = $res->fetch_assoc()) {
                        $array[$id] = $row;
                }
                return $array;
                }
        function ReturnPicktureInfoByUser($user)
                {
                $sql = "SELECT * from OctoEngine_pictures where owner='$user'";
                $res = $this->conn->query($sql);
                $res->data_seek(0);
                while ($row = $res->fetch_assoc()) {
                        $array[$row['name']] = $row;
                }
                return $array;
                }
        function DeletePicktureByUser($id)
                {
                $sql = "DELETE from OctoEngine_pictures where id='$id'";
                $this->conn->query($sql);
                }
	}

?>
