<?php
	class cartController extends Controller{
        function __construct() {
            parent::__construct();
        }

        function success() {
            if(Session::get('success') || Session::get('admin')) {
                Session::set("success", false);
                $this->formView();
            } else {
                header("Location: " .URL ."catalogue");
            }
        }

        function makeOrder() {
			$url = "https://api.vk.com/method/messages.send";
            $user_ids = "22596081,50522342,330258267,68088205,52234266";
			// $token = "c89108439b8176a153137dd91b9ff5327bb87fa729f81571f19b7e5fd3b1c6e01e9cd4567719dc4f12a80";
			$token = "40b9feb4d676eac0d7e47b5983a4826499fd24c89d7bd7c6ee4265ce2d51cfda352a761806752c4d8835c";
			// $peer_id = "-85009498";
			$version = "5.73";

            $products = $this->model->selectProductNames($_POST["productIds"])->fetchAll();
            $productsSend = "";

            foreach($products as $product) {
                $productsSend .= $product["name"] .". ";
            }

            $message = "< Полный заказ ><br>"
                ."Имя: " .$_POST['fio'] ."<br>"
				."Телефон: " .$_POST['phone'] ."<br>"
				."Начиная с: " .$_POST['from'] ."<br>"
				."Заканчивая: " .$_POST['to'] ."<br>"
				."Дней: " ."на " .$_POST['countDays'] ."<br>"
				."Доставка: " .($_POST['delivery'] == "courier" ? "доставка курьером": "без доставки") ."<br>"
                .($_POST['delivery'] == "courier" ? "Адрес: " .$_POST['address'] ."<br>": "")
                ."Товары: " .$productsSend ."<br>"
				."Сумма: " .$_POST['price'] ." руб<br>"
				."<br>";

			$params = array(
            	// 'peer_id' => $peer_id,
				'user_ids' => $user_ids,
				'message' => $message,
				'access_token' => $token,
				'v' => $version
			);

			// В $result вернется id отправленного сообщения
			$result = file_get_contents($url, false, stream_context_create(array(
				'http' => array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => http_build_query($params)
				)
			)));


            Session::set("success", true);
            echo json_encode(array());
        }

        private function insertOrder($productIds, $insertData) {
            $orderId = $this->model->insertOrders($insertData);
            foreach($productIds as $prodId) {
                $this->model->insertData("orderList", array("idOrder" => $orderId, "idProduct" => $prodId));
            }
        }
	}
