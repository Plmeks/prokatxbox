<?php
	class errorsController extends Controller{
		function __construct(){
            parent::__construct();
        }
		
        function error404(){
            header("Location: " .URL);
        }

        function error403(){
            $this->formView();
        }
	}
