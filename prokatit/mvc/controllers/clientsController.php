<?php

class clientsController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if ($this->isAjax()) {
            echo json_encode($this->getClients());//json_encode($this->getTreeCatalogue());
        } else {
            $this->viewBag["clients"] = $this->getClients();
            $this->formView();
        }
    }

    private function getClients()
    {
        $links = $this->model->selectData("clients", array(), array("name", "shortName"))->fetchAll();
        $paper = $this->model->selectData("clients", array("shortName" => $_GET["paper"]))->fetchAll()[0];


        if(!empty($paper)) {
            $paper["description"] = html_entity_decode($paper["description"]);
        } else {
            header("Location:" .URL ."clients/paper/" .$links[0]["shortName"]);
        }

        return array(
            "links" => $links,
            "paper" => $paper
        );
    }

}
