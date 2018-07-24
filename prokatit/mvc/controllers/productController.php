<?php
class productController extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index() {
        if($this->isAjax())
            echo json_encode($this->getProduct());
        else {
            $this->viewBag["product"] = $this->getProduct();
            $this->formView();
        }
    }


    function getProduct() {
        $productShortName = $_GET['name'];

        $products = $this->model->selectData("product", array("shortName" => $productShortName))->fetchAll();
        foreach($products as &$product){
            $product["shortDescription"] = html_entity_decode($product["shortDescription"]);
            $product["description"] = html_entity_decode($product["description"]);
        }

        return $products;
    }
}
