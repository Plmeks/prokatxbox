<?php
	class registrationController extends Controller{

		function __construct(){
			parent::__construct();
           /* $logged = Session::get('loggedIn');
            if($logged)
                header("Location: " .URL ."dashboard");
            else
                $this->model = new registrationModel();*/
		}

        // submit button
        function registerUser(){
            $login = $_POST['login'];
            $email = $_POST['email'];
            $role = 'user';

            // hashPassword
            $password = $_POST['password'];
            $passwordKey = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
            $hashedPassword = hash('sha256', $password .$passwordKey);

            $insertData = array(
                'login' => $login, 'password' => $hashedPassword,
                'passwordKey' => $passwordKey,
                'email' => $email, 'role' => $role
            );

            $this->model->insertData(
                "users",
                $insertData
            );

            $userData = $this->model->selectData("users", array("login" => $login, "email" => $email))->fetchAll()[0];

            $this->loginSession($userData);
        }

        //POST method
        private function loginSession ($userData){
            Session::set('loggedIn', true);

            Session::set('idUser', $userData['id']);
            Session::set('loginUser', $userData['login']);
            Session::set('emailUser', $userData['email']);
        }

        function isDataDisable(){
            $isDisable = true;
            $login = $_POST['login'];
            $email = $_POST['email'];

            switch($_POST['type']) {
                case 'login':
                    $data = $this->model->selectData("users", array('login' => $login), array("id"));
                    if($data->rowCount()) {
                        $isDisable = false;
                    }
                    break;
                case 'email':
                    $data = $this->model->selectData("users", array('email' => $email), array("id"));
                    if($data->rowCount()) {
                        $isDisable = false;
                    }
                    break;
            }

            echo json_encode(array(
                'valid' => $isDisable,
            ));
        }
	}