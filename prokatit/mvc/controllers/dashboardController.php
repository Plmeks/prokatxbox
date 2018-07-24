<?php
	class dashboardController extends Controller{	

		function __construct(){
			parent::__construct();
			$logged = Session::get('loggedIn');
			if(!$logged) {
				Session::destroy();
				header('Location: ' .URL ."login");
			}
		}

        function logOut(){
            Session::init();
            Session::destroy();
            header('Location: ' .URL);
        }
	}