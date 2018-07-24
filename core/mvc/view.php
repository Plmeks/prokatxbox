<?php
	class View {
        private $viewConfig;
        private $header;
        private $resources;
        private $partials;
        private $viewBag;

        function initDaoView() {
            include_once PROJECT ."mvc/views/pages/" .$this->viewConfig["contentPath"] ."/" ."dao.php";
            // From *Dao.php
            $this->header = $getHeaderMeta($this->viewBag);
            $this->resources = $getResources();
            $this->partials = $getPartials();
        }

		function initTemplateView(){
			include_once PROJECT ."mvc/views/layouts/" .$this->viewConfig["layout"] .".php";
        }

        private function generatePartial($name) {
            $file = PROJECT ."mvc/views/partials/" .$name .".php";

            if(file_exists($file))
                include $file;
        }


        function generateBody(){
            if(!empty($this->partials))
                $this->generatePagePartialViews();
            else
                $this->generatePageView();
        }

        private function generatePagePartialViews() {
            foreach($this->partials as $val)
                if($val["simpleView"])
                    $this->generatePageView();
                else
                    $this->generatePartial($val["name"]);
        }

        private function generatePageView() {
            $simpleViewFile = PROJECT ."mvc/views/pages/" .$this->viewConfig["contentPath"] ."/" ."index.php";
            if(file_exists($simpleViewFile))
                include_once $simpleViewFile;
        }


        function getResources(){
            return $this->resources;
        }

        function getPartials(){
            return $this->partials;
        }

        function getViewBag() {
            return $this->viewBag;
        }

        function setViewConfig($viewConfig) {
            $this->viewConfig = $viewConfig;
        }

        function setViewBag($viewBag) {
            $this->viewBag = $viewBag;
        }

	}