<?php
	class Controller {
		public $view;
		public $model;

        public $viewBag;
        public $layoutView;

        private $controllerInfo;
        private $actionName;

        private $fileManager;

        function getViewConfig(){
            return $this->viewConfig;
        }

        function setActionName($action) {
            $this->actionName = $action;
        }

		function __construct(){
            Session::init();

			$this->view = new View();
            $this->fileManager = new FileManager();
            $this->initializeModel();
		}

        function initializeModel() {
            $modelName = str_replace("Controller", "", get_class($this)) ."Model";
            if(class_exists($modelName))
                $this->model = new $modelName();
        }

		function index(){
			$this->formView();
		}


        public function buildPage($resources){
            if(BUILD)
                $this->fileManager->buildPage($resources, $this->controllerInfo);
        }

        public function buildViewControl(){
            if(BUILD)
                $this->fileManager->buildViewControl($this->controllerInfo);
        }

		protected function formView($layoutView = DEFAULT_LAYOUT_VIEW){
            $this->controllerInfo = array(
                "layout" => $layoutView,
                "action" => ($selfAction = $this->actionName),
                "name" => ($selfName = str_replace("Controller", "", get_class($this))),
                "contentPath" => $selfName ."/" .$selfAction
            );

            $this->buildViewControl();

            $this->view->setViewConfig($this->controllerInfo);
            $this->view->setViewBag($this->viewBag);

            if(file_exists(PROJECT ."mvc/views/pages/" .$this->controllerInfo["contentPath"] ."/" ."dao.php")) {
                $this->view->initDaoView();
            }

            $this->buildPage($this->view->getPartials());
			$this->view->initTemplateView();
        }

        protected function isAjax() {
            return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        }
	}