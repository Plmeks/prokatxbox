<?php
	class adminController extends Controller{
		function __construct() {
			parent::__construct();
            if(!Session::get('admin'))
                header("Location: " .URL ."authorization");
		}

        function index() {
            $this->popularProducts();
        }
        
        function competition() {
            if($this->isAjax()) {
                $this->competitionRest($_SERVER['REQUEST_METHOD']);
            } else {
                $this->formView("admin");
            }
        }

        function articles() {
            if($this->isAjax()) {
                $this->articlesRest($_SERVER['REQUEST_METHOD']);
            } else {
                $this->formView("admin");
            }
        }

        function categories() {
            if($this->isAjax()) {
                $this->categoriesRest($_SERVER['REQUEST_METHOD']);
            } else {
                $this->formView("admin");
            }
        }

        function subcategories() {
            if($this->isAjax()) {
                $this->subcategoriesRest($_SERVER['REQUEST_METHOD']);
            }
        }

        function products() {
            if($this->isAjax()) {
                $this->productsRest($_SERVER['REQUEST_METHOD']);
            } else {
                $this->formView("admin");
            }
        }

        function catalogue() {
            if($this->isAjax())
                $this->catalogueRest($_SERVER['REQUEST_METHOD']);
        }

        function popularProducts() {
            if($this->isAjax()) {
                $this->popularProductsRest($_SERVER['REQUEST_METHOD']);
            } else {
                $this->formView("admin");
            }
        }
        
        private function competitionRest($type) {
        	$request = json_decode(file_get_contents('php://input'));
            $competitions = $request->models;
            $result = null;

            if($type == "GET") {
                $competitions = $this->model->selectData("competition")->fetchAll();

                $result = $competitions;
            }

            if($type == "PUT") {
                foreach($competitions as $competition) {
                	
                    $updatedData = array(
                        'link' => $competition->link
                    );

                    $where = array(
                        "id" => $competition->id
                    );

                    $this->model->updateData("competition", $updatedData, $where);
                }
            }

            if($type == "POST") {
                $result = array();

                foreach($competitions as $competition) {

                    $insertedData = array(
                        'link' => $competition->link
                    );

                    $this->model->insertData("competition", $insertedData);

                    $competition->id = $this->model->getDB()->lastInsertId();

                    $result[] = $competition;
                }
            }


            if($type == "DELETE") {
                foreach($competitions as $competition) {

                    $where = array(
                        "id" => $competition->id
                    );

                    $this->model->deleteData("competition", $where);
                }
            }

            echo json_encode($result);
        }

        private function articlesRest($type) {
            $request = json_decode(file_get_contents('php://input'));
            $articles = $request->models;
            $result = null;

            if($type == "GET") {
                $articles = $this->model->selectData("clients")->fetchAll();

                foreach($articles as &$article) {
                    $article["description"] = html_entity_decode($article["description"]);
                }

                $result = $articles;
            }

            if($type == "PUT") {
                foreach($articles as $article) {
                    $description = htmlentities($article->description);

                    $updatedData = array(
                        'name' => $article->name,
                        'shortName' => $article->shortName,
                        'description' => $description,
                    );

                    $where = array(
                        "id" => $article->id
                    );

                    $this->model->updateData("clients", $updatedData, $where);
                }
            }

            if($type == "POST") {
                $result = array();

                foreach($articles as $article) {

                    $insertedData = array(
                        'name' => $article->name,
                        'shortName' => $article->shortName,
                        'description' => $article->description,
                    );

                    $this->model->insertData("clients", $insertedData);

                    $article->id = $this->model->getDB()->lastInsertId();

                    $result[] = $article;
                }
            }


            if($type == "DELETE") {
                foreach($articles as $article) {

                    $where = array(
                        "id" => $article->id
                    );

                    $this->model->deleteData("clients", $where);
                }
            }

            echo json_encode($result);
        }


        private function popularProductsRest($type) {
            $request = json_decode(file_get_contents('php://input'));
            $popularProducts = $request->models;
            $result = null;

            if($type == "GET") {
                $popularProducts = $this->model->selectPopularProducts()->fetchAll();
                foreach($popularProducts as &$popularProduct) {
                    $popularProduct["product"] = array("name" => $popularProduct["name"], "id" => $popularProduct["idProduct"]);
                }

                $result = $popularProducts;
            }

            if($type == "PUT") {
                foreach($popularProducts as $popularProduct) {
                    $updatedData = array(
                        'idProduct' => $popularProduct->product->id
                    );

                    $where = array(
                        "id" => $popularProduct->id
                    );

                    $this->model->updateData("popularProducts", $updatedData, $where);
                }

            }

            if($type == "POST"){
                $result = array();

                foreach($popularProducts as $popularProduct) {
                    $insertedData = array(
                        'idProduct' => $popularProduct->product->id
                    );

                    $this->model->insertData("popularProducts", $insertedData);

                    $popularProduct->id = $this->model->getDB()->lastInsertId();

                    $result[] = $popularProduct;
                }
            }

            if($type == "DELETE") {
                foreach($popularProducts as $popularProduct) {

                    $where = array(
                        "id" => $popularProduct->id
                    );

                    $this->model->deleteData("popularProducts", $where);
                }
            }

            echo json_encode($result);
        }

        private function categoriesRest($type) {
            $request = json_decode(file_get_contents('php://input'));
            $categories = $request->models;
            $result = null;

            if($type == "GET") {
            	$categories = $this->model->selectCategories()->fetchAll();
            	foreach($categories as &$category) {
            		if($category["image"]) {
            			$initedImage = "<img src='" .IMG_URL .$category["image"] ."' width='200'/>";
            			$category["image"] = $initedImage;
            		}
                    //$initedImage .= "<span style='visibility: hidden;'>#" .$product["image"] ."#</span>";
                }
                $result = $categories;
            }

            if($type == "PUT") {
                foreach($categories as $category) {
                	if($category->image) {
                		$doc = new DOMDocument();
	                    $doc->loadHTML($category->image);
	                    $imageTags = $doc->getElementsByTagName('img');
	                    $src = $imageTags[0]->getAttribute('src');
	
	                    $imageSrc = substr($src, strpos($src, 'images/') + 7);
                	} else {
                		$imageSrc = null;
                	}
                	
                    $updatedData = array(
                        'name' => $category->name, 'shortName' => $category->shortName,
                        'description' => $category->description, 'image' => $imageSrc
                    );

                    $where = array(
                        "id" => $category->id
                    );

                    $this->model->updateData("category", $updatedData, $where);
                }

            }

            if($type == "POST"){
                $result = array();

                foreach($categories as $category) {
                	if($category->image) {
                		$doc = new DOMDocument();
	                    $doc->loadHTML($category->image);
	                    $imageTags = $doc->getElementsByTagName('img');
	
	                    $src = $imageTags[0]->getAttribute('src');
	                    $imageSrc = substr($src, strpos($src, 'images/') + 7);
                	} else {
                		$imageSrc = null;
                	}
                    
                    $insertedData = array(
                        'name' => $category->name, 'shortName' => $category->shortName,
                        'description' => $category->description, 'image' => $imageSrc
                    );

                    $this->model->insertData("category", $insertedData);

                    $category->id = $this->model->getDB()->lastInsertId();

                    $result[] = $category;
                }
            }

            if($type == "DELETE") {
                foreach($categories as $category) {

                    $where = array(
                        "id" => $category->id
                    );

                    $this->model->deleteData("category", $where);
                }
            }

            echo json_encode($result);
        }

        private function subcategoriesRest($type) {
            $request = json_decode(file_get_contents('php://input'));
            $subcategories = $request->models;
            $result = null;

            if($type == "GET") {
                if($_GET["categoryId"]) {
                    $subcategories = $this->model->selectData("subcategory", array("idCategory" => $_GET["categoryId"]))->fetchAll();

	            	foreach($subcategories as &$subcategory) {
	            		if($subcategory["image"]) {
	            			$initedImage = "<img src='" .IMG_URL .$subcategory["image"] ."' width='200'/>";
	                    	$subcategory["image"] = $initedImage;
	            		}
	
	                }
                    $result = $subcategories;
                } 
                // else {
                //     $subcategories = $this->model->selectSubcategories()->fetchAll();
                //     foreach($subcategories as &$subcategory) {
                //         $subcategory["category"] = array("id" => $subcategory["categoryId"], "name" => $subcategory["categoryName"]);
                //     }

                //     $result = $subcategories;
                // }
            }

            if($type == "PUT") {
                foreach($subcategories as $subcategory) {
                	if($subcategory->image) {
                		$doc = new DOMDocument();
	                    $doc->loadHTML($subcategory->image);
	                    $imageTags = $doc->getElementsByTagName('img');
	                    $src = $imageTags[0]->getAttribute('src');
	
	                    $imageSrc = substr($src, strpos($src, 'images/') + 7);
                	} else {
                		$imageSrc = null;
                	}
                	
                    
                    $updatedData = array(
                        'name' => $subcategory->name,
                        'shortName' => $subcategory->shortName,
                        'description' => $subcategory->description,
                        'idCategory' => $_GET["categoryId"],
                        'image' => $imageSrc
                    );

                    $where = array(
                        "id" => $subcategory->id
                    );

                    $this->model->updateData("subcategory", $updatedData, $where);
                }

            }

            if($type == "POST"){
                $result = array();

                foreach($subcategories as $subcategory) {
                	if($subcategory->image) {
                		$doc = new DOMDocument();
	                    $doc->loadHTML($subcategory->image);
	                    $imageTags = $doc->getElementsByTagName('img');
	
	                    $src = $imageTags[0]->getAttribute('src');
	                    $imageSrc = substr($src, strpos($src, 'images/') + 7);
                	} else {
                		$imageSrc = null;
                	}
                    
                    $insertedData = array(
                        'name' => $subcategory->name, 'shortName' => $subcategory->shortName,
                        'description' => $subcategory->description,
                        'idCategory' => $_GET["categoryId"], 'image' => $imageSrc
                    );

                    $this->model->insertData("subcategory", $insertedData);

                    $subcategory->id = $this->model->getDB()->lastInsertId();

                    $result[] = $subcategory;
                }
            }

            if($type == "DELETE") {
                foreach($subcategories as $subcategory) {

                    $where = array(
                        "id" => $subcategory->id
                    );

                    $this->model->deleteData("subcategory", $where);
                }
            }

            echo json_encode($result);
        }

        private function productsRest($type) {
            $request = json_decode(file_get_contents('php://input'));
            $products = $request->models;
            $result = null;

            if($type == "GET") {
//                $fullImagePath = PROJECT ."content/images/";
                $products = $this->model->selectData("product", null, null, null, "id desc")->fetchAll();

                $categories = $this->model->selectData("category")->fetchAll();
                foreach($products as &$product) {
                    $initedImage = "<img src='" .URL .PROJECT ."content/images/" .$product["image"] ."' width='150'/>";
                    //$initedImage .= "<span style='visibility: hidden;'>#" .$product["image"] ."#</span>";
                    $product["image"] = $initedImage;

                    $product["description"] = html_entity_decode($product["description"]);
                    //$product["shortDescription"] = html_entity_decode($product["shortDescription"]);

                    foreach($categories as $category)
                        if($product["idCategory"] == $category["id"])
                            $product["category"] = array("id" => $category["id"], "name" => $category["name"]);
                }

                $result = $products;
            }

            if($type == "PUT") {
                foreach($products as $product) {
                    // for getting image
                    if($product->image) {
                    	$doc = new DOMDocument();
	                    $doc->loadHTML($product->image);
	                    $imageTags = $doc->getElementsByTagName('img');
	                    $src = $imageTags[0]->getAttribute('src');
	                    $imageSrc = substr($src, strpos($src, 'images/') + 7);
	                    
                    }
                    $description = htmlentities(addslashes($product->description));
                    
                    //$shortDescription = htmlentities($product->shortDescription);

                    $updatedData = array(
                        'name' => $product->name,
                        'shortName' => $product->shortName,
                        'description' => $description,
                        'shortDescription' => $product->shortDescription,
                        'price' => $product->price,
                        'image' => $imageSrc, //ЗДЕСЬ УЯЗВИМОСТЬ! можно вставить любую картинку, даже с Селектом
                        'idCategory' => $product->category->id,
                        'popular' => $product->popular
                    );

                    $where = array(
                        "id" => $product->id
                    );

                    $this->model->updateData("product", $updatedData, $where);
                }
            }

            if($type == "POST") {
                $result = array();

                foreach($products as $product) {
                    // for getting image
                    $doc = new DOMDocument();
                    $doc->loadHTML($product->image);
                    $imageTags = $doc->getElementsByTagName('img');

                    $src = $imageTags[0]->getAttribute('src');
                    $imageSrc = substr($src, strpos($src, 'images/') + 7);

                    $insertedData = array(
                        'name' => $product->name,
                        'shortName' => $product->shortName,
                        'description' => $product->description,
                        'shortDescription' => $product->shortDescription,
                        'price' => $product->price,
                        'image' => $imageSrc,
                        'idCategory' => $product->category->id,
                        'popular' => $product->popular
                    );

                    $this->model->insertData("product", $insertedData);

                    $product->id = $this->model->getDB()->lastInsertId();

                    $result[] = $product;
                }
            }


            if($type == "DELETE") {
                foreach($products as $product) {

                    $where = array(
                        "id" => $product->id
                    );

                    $this->model->deleteData("product", $where);
                }
            }

            echo json_encode($result);
        }

        function imageBrowser() {
            $path = $_POST["path"];
            $serverPath = "prokatit/content/images/";
            $filter = "*.*";
            $data = null;
            $type = $_GET["type"];

            if($type == "read") {
                $data = array();
                foreach (glob($serverPath .$path ."*") as $filename) {
                    if (is_dir($filename)) {
                        $file = array("name" =>  basename($filename), "type" => "d", "size" => "0");
                    } else {
                        $file = array("name" =>  basename($filename), "type" => "f", "size" => filesize($filename));
                    }

                    $data[] = $file;
                }
            }

            if($type == "create") {
                $folderPath = $serverPath .$path .$_POST["name"];
                $fileManager = new FileManager();
                $fileManager->createFolder($folderPath);
            }

            if($type == "upload") {
                $uploadPath = $serverPath .$path .$_POST["name"];
                $uploadFile = $uploadPath .basename($_FILES['file']['name']);

                move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);
                $data = $_FILES['file'];
            }

            if($type == "destroy") {
                $fileType = $_POST["type"];
                $destroyPath = $serverPath .$path ;
                $destroyFile = $destroyPath .$_POST["name"];

                if($fileType == "d") {
                    $fileManager = new FileManager();
                    $fileManager->removeFolder($destroyFile);
                }

                if($fileType == "f")
                    unlink($destroyFile);
            }

            echo json_encode($data);
        }



        function catalogueRest($type) {
            $request = json_decode(file_get_contents('php://input'));
            $catalogue = $request->models;
            $result = null;

            if($type == "GET") {
                $catalogue = $this->model->selectCatalogue($_GET["productId"])->fetchAll();
                foreach($catalogue as &$item) {
                    $item["subcategory"] = array("id" => $item["subcategoryId"], "name" => $item["subcategoryName"]);
                }
                $result = $catalogue;
            }

            if($type == "PUT") {
                foreach($catalogue as $item) {
                    $updatedData = array(
                        "idProduct" => $item->idProduct,
                        "idSubcategory" => $item->subcategory->id
                    );

                    $where = array(
                        "id" => $item->id,
                    );

                    $this->model->updateData("catalogue", $updatedData, $where);
                }
            }

            if($type == "DELETE") {
                foreach($catalogue as $item) {

                    $where = array(
                        "id" => $item->id
                    );

                    $this->model->deleteData("catalogue
                    ", $where);
                }
            }

            if($type == "POST") {
                $result = array();

                foreach($catalogue as $item) {
                    $insertedData = array(
                        "idProduct" => $_GET["productId"],
                        "idSubcategory" => $item->subcategory->id
                    );

                    $this->model->insertData("catalogue", $insertedData);

                    $item->id = $this->model->getDB()->lastInsertId();

                    $result[] = $item;
                }
            }

            echo json_encode($result);

        }

	}