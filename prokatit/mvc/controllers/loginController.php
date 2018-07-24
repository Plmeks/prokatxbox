<?php
	class loginController extends Controller{
		function __construct() {
			parent::__construct();
			/*$logged = Session::get('loggedIn');
			if($logged)
				header("Location: " .URL ."dashboard");
			else
			    $this->model = new loginModel();*/
		}
		


        function isDataExists() {
            $isExists = false;
            $response = array();

            $login = $_POST['login'];

            switch($_POST['type']) {
                case 'login or email':
                    $data = $this->model->selectData("users", array("login" => $login, "email" => $login), array("id"), "OR");
                    if($data->rowCount()) {
                        $isExists = true;
                    }
                    break;
                case 'password':
                    $validLogin = $_POST['loginValid'];
                    $password = $_POST['password'];

                    $userCheck = $this->model->selectData("users", array("login" => $validLogin, "email" => $validLogin), array("id", "passwordKey"), "OR");

                    if($userCheck->rowCount()){
                        $userCheckData = $userCheck->fetchAll();
                        $hashedPassword = hash('sha256', $password .$userCheckData[0]['passwordKey']);

                        $userData = $this->model->selectData("users", array("id" => $userCheckData[0]['id'], "password" => $hashedPassword), array("*"));
                        if($userData->rowCount()){
                            $isExists = true;
                            $this->loginSession($userData->fetchAll()[0]);
                        }
                    }
                    break;
            }

            $response['valid'] = $isExists;
            echo json_encode($response);
        }

        //POST method
        private function loginSession ($userData){
            Session::set('loggedIn', true);
            if($userData['role'] === "admin")
                Session::set('admin', true);

            Session::set('idUser', $userData['id']);
            Session::set('loginUser', $userData['login']);
            Session::set('emailUser', $userData['email']);
        }
	}