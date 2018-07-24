<?php
	class authorizationController extends Controller{
		function __construct() {
            parent::__construct();

            if(Session::get('admin'))
                header("Location: " .URL ."admin");
            else if(Session::get('loggedIn'))
                header("Location: " .URL);
		}

        function index() {
            $this->formView();
        }
	}