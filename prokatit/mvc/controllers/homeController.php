<?php
	class homeController extends Controller{
		function __construct(){
            parent::__construct();
        }
		
        function index(){
            $this->formView();
        }

        function contacts(){
            $this->formView();
        }
        
        function competition() {
            if($this->isAjax()) {
                echo json_encode(array("competition" => $this->model->selectData("competition")->fetchAll()[0]));
            }
        }

        function popularProducts() {
            if($this->isAjax()) {
                echo json_encode(array("popularProducts" => $this->model->getPopularProducts()->fetchAll()));
            }
        }
        
        function getBetween($content, $start, $end){
		    $r = explode($start, $content);
		    if (isset($r[1])){
		        $r = explode($end, $r[1]);
		        return $r[0];
		    }
		    
		    return '';
		}
        
        function reviews() {
			$url = "https://api.vk.com/method/board.getComments";
            $group_id = "85009498";
			$topic_id = "32873935";
			$count = 100;
			$version = "5.74";
		
            $params = array(
            	'group_id' => $group_id,
				'topic_id' => $topic_id,
				'count' => $count,
				'v' => $version
			);

            // В $result вернется id отправленного сообщения
            $commentsResp = file_get_contents($url, false, stream_context_create(array(
                'http' => array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($params)
                )
            )));
            
            $comments = array();
            $users = array();
            
			$commentsResp = json_decode($commentsResp);
			$commentsResp = array_filter($commentsResp->response->items, function($val) {
				return $val->from_id != 50522342 && $val->from_id != -85009498 && $val->from_id != 330258267;
			});
			
			$commentsResp = array_intersect_key($commentsResp, array_flip(array_rand($commentsResp, 6)));
			
			foreach($commentsResp as $comment) {
				// $fakeNamePos = strpos($comment->text, "[id");
				
				if(strpos($comment->text, "[id") !== false) {
					$fakeName = substr($comment->text, strpos($comment->text, "[id"), strpos($comment->text, "]") - strpos($comment->text, "[id") + 1);
					$name = substr($fakeName, strpos($fakeName, "|") + 1, strpos($fakeName, "]") - strpos($fakeName, "|") - 1);
					$comment->text = str_replace($fakeName, $name, $comment->text);
					// $comment->text = $name;
				}
				
				array_push($comments, array("comment" => $comment, "text" => $comment->text, "user" => $this->getUserData($comment->from_id)));
			}
			
			
            echo json_encode($comments);
        }

		function getUserData($id) {
			$url = "https://api.vk.com/method/users.get";
            $user_ids = $id;
			$fields = "photo_400_orig";
			$token = "c89108439b8176a153137dd91b9ff5327bb87fa729f81571f19b7e5fd3b1c6e01e9cd4567719dc4f12a80";
			$version = "5.74";
		
            $params = array(
            	'user_ids' => $user_ids,
				'fields' => $fields,
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
            
            return json_decode($result)->response[0];
		}

        function sendEmail (){
            $url = "https://api.vk.com/method/messages.send";
            $user_ids = "22596081,50522342,330258267,68088205,52234266";
			// $token = "c89108439b8176a153137dd91b9ff5327bb87fa729f81571f19b7e5fd3b1c6e01e9cd4567719dc4f12a80";
			$token = "40b9feb4d676eac0d7e47b5983a4826499fd24c89d7bd7c6ee4265ce2d51cfda352a761806752c4d8835c";
			// $peer_id = "-85009498";
			$version = "5.73";
			
            $message = "< E-mail сообщение >" ."<br>"
                ."Имя: " .$_POST['name'] ."<br>"
                ."E-mail: " .$_POST['email'] ."<br>"
                ."Сообщение: " .$_POST['message'] ."<br>"
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

        function makeOrder() {
            $url = "https://api.vk.com/method/messages.send";
            $user_ids = "22596081,50522342,330258267,68088205,52234266";
			// $token = "c89108439b8176a153137dd91b9ff5327bb87fa729f81571f19b7e5fd3b1c6e01e9cd4567719dc4f12a80";
			$token = "40b9feb4d676eac0d7e47b5983a4826499fd24c89d7bd7c6ee4265ce2d51cfda352a761806752c4d8835c";
			// $peer_id = "-85009498";
			$version = "5.73";
			
            $message = "< Быстрый заказ >" ."<br>"
                ."Телефон: " .$_POST['phone'] ."<br>"
                ."Начиная с: " .$_POST['from'] ."<br>"
                ."Заканчивая: " .$_POST['to'] ."<br>"
                ."Дней: на " .$_POST['countDays'] ."<br>"
                ."Товар: " .$_POST['product'] ."<br>"
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
	}
