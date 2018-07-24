<?php
	class HashPassword {
        private $key;
        function __construct() {
            //random key for user
            $this->key = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
        }

		function writeHash($password) {
            $keyedPassword = $password .$this->key;
            $hashedPassword = hash('sha256', $keyedPassword);

            return $hashedPassword;
        }
	}