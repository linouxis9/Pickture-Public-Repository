<?php
class OctoEngine_Outside
        {
	function __construct()
		{
		$this->apitoken = "6f368b795aab41586ed0f2ca5c13da2848769cbe5397d17531ba0a760509193e27ac18b32ea93bc30bfc162b55d569c6b3bb2cbd558c15521cf5007bf65b1023"; # Api_123's token
		$this->server_addr = "http://dev.sollidi.us/simple3/sso.php"; # Dev SSO Server
		# $this->array_db = json_decode(file_get_contents($this->server_addr."?api_token=".$this->apitoken."&full_get"), true);
		}
        public function returnperm($username)
                {
                        return $this->db["user_group"];
                }
        public function loginme($user, $token)
                {
		$url = file_get_contents($this->server_addr."?api_token=".$this->apitoken."&connect&token=".$token."&user=".$user);
		$arr = json_decode($url,true);
		$this->nickname = $arr['nickname'];
		$this->db = $arr;
                return $arr['success'];
                }
        public function checkif($username, $perm)
        	{
                if ($this->returnperm($username) == $perm)
			{
                        return 1;
                	}
                return 2;
        	}

	}

