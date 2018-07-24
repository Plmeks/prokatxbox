<?php
	class catalogueController extends Controller{
        function __construct(){
            parent::__construct();
        }

        function index() {
//			header("Location: " .URL ."catalogue/show/category/vse_tovari");
            if($this->isAjax()) {
                echo json_encode($this->getCatalogue());//json_encode($this->getTreeCatalogue());
            }
            else {
                $this->viewBag["catalogue"] = $this->getCatalogue();
                $this->formView();
            }
        }

        function showWithPhp() {
            $this->viewBag = $this->getCatalogue();
            $this->formView();
        }

        private function getCatalogue() {
            $categoryShortName = $_GET['category'];
            $subcategoryShortName = $_GET['subcategory'];

            if(!isset($categoryShortName)) {
                header("Location: " .URL ."catalogue/category/vse_tovari");
            }

            $catalogueTree = $this->getCatalogueTree();
            $data = $this->findCategoryByShortName($catalogueTree, $categoryShortName, $subcategoryShortName);
            if($data['categoryData']['shortName'] == 'vse_tovari') {
                $products = $this->getAllProducts();
            } else {
                $products = $this->getProducts($data['categoryData']['id'], $data['subcategoryData']['id']);
            }

            return array(
                "currentBranch" => $data['subcategoryData'] ? $data['subcategoryData'] : $data['categoryData'],
                "catalogueTree" => $catalogueTree,
                "products" => $products
            );
        }

        private function findCategoryByShortName($catalogueTree, $category, $subcategory){
            foreach($catalogueTree as $tree){
                if(array_search($category, $tree['category'])){
                    $categoryData = $tree['category'];
                    if(isset($subcategory)){
                        foreach($tree['subcategory'] as $subcat){
                            if(array_search($subcategory, $subcat))
                                $subcategoryData = $subcat;
                        }
                    }
                }
            }

            return array("categoryData" => $categoryData, "subcategoryData" => $subcategoryData);
        }

        private function getProducts($categoryId, $subcategoryId) {
            if(isset($subcategoryId)) {
                $products = $this->model->getSubcategoryProducts($categoryId, $subcategoryId);
            } else {
                $products = $this->model->selectData(
                    "product",
                    array("idCategory" => $categoryId),
                    null,
                    null,
                    "id desc"
                );
            }

            return $products->fetchAll();
        }

        function getAllProducts() {
            $products = $this->model->selectData("product", null, null, null, "id desc");
            return $products->fetchAll();
        }

        private function getCatalogueTree() {
            $categories = $this->model->selectData("category")->fetchAll();
            $catalogueTree = array();

            foreach($categories as $category) {
                $subcategories = $this->model->selectData("subcategory", array("idCategory" => $category['id']))->fetchAll();
                foreach($subcategories as &$subcategory) {
                	$subcategory["categoryShortName"] = $category["shortName"];
                }
                
                array_push($catalogueTree, array("category" => $category, "subcategory" => $subcategories));
            }

            return $catalogueTree;
        }
	}
