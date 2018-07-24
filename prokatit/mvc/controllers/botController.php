<?php
	use Telegram\Bot\Api; 
	
	class botController extends Controller{
		function __construct(){
            parent::__construct();
        }
		
        function index(){
        	$telegram = new Api('530924725:AAGAi7sDRTIoHTkvQnsABw1PgoxV4OULRDk');
    		$result = $telegram -> getWebhookUpdates();
    		
    		$text = $result["message"]["text"]; //Текст сообщения
		    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
		    $name = $result["message"]["from"]["username"]; //Юзернейм пользователя
		    $keyboard = [["Последние статьи"],["Картинка"],["Гифка"]]; //Клавиатура

    		if($text){
	    		$telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $chat_id]);
	    	}

        }
        
        function wall_post_new($object) {
   //     	$owner_id = substr_replace($object->owner_id, "", 0, 1);
			// $post_id  = $object->id;
			// $link = "https://vk.com/club" .$owner_id ."?w=wall-" .$owner_id ."_" .$post_id;
			// $date = date('d/m/Y H:i', $object->date);
			
			// $text = (strlen($object->text)? $object->text ."\n" : "");
			$wall_api_link = "https://api.vk.com/method/wall.getById?posts=$object->owner_id\_$object->id&v=5.73";
			$wall_response = json_decode(file_get_contents($wall_api_link));
			$wall = $wall_response->response[0];
			
			$message = (strlen($wall->text)? $wall->text ."\n" ."\n" : "");
			$reposts = $wall->copy_history;
			
			

			//H:i:s
			if(count($reposts)) {
				foreach($reposts as &$repost) {
					// $message .= "s";
					$club = "club" .substr_replace($repost->owner_id, "", 0, 1);
					$wall = "w=wall$repost->owner_id" ."_" .$repost->id;
					$message .= "<a href='https://vk.com/$club?$wall'>Репост \xE2\xAC\x87</a>";
					$message .= "\n";
					$message .= (strlen($repost->text)? $repost->text ."\n" ."\n" : "");
				}
			}
			
			// if(count($repost)) {
			// 	foreach($reposts as &$repost) {
					
			// 	}
			// 	$attachments = $object->copy_history[0]->attachments;
			// 	$text = $object->copy_history[0]->text;
			// 	$photo = $this->getPhoto($attachments[0]->photo);
			// } else {
			// 	$attachments = $object->attachments;
			// 	$text = $object->text;
			// 	$photo = $this->getPhoto($attachments[0]->photo);
			// }
			
			
			// $message =  $text;
			
			// if($photo) {
			// 	$message .= "<a href='" .$photo ."'>ᅠ</a>";
			// } else if(!count($attachments)){
			// 	$disable_web_page_preview = true;
			// }
				
			// $message .= "\n";
			// $message .= "\n\xE2\x9E\xB0<a href='" .$link ."'>Источник ВК</a>";
			
			// $this->telegram($message, $disable_web_page_preview);
			$this->telegram($message, false);
        }
        
        function vk() {
        	if (!isset($_REQUEST)) {
			    return;
			}
			
			// //Строка для подтверждения адреса сервера из настроек Callback API
			$confirmationToken = "63be0607";
			
			// //Ключ доступа сообщества
			$token = "c8d12b93bee116ee0d18c3bbea893851083b4d336f8a384e5491334d01aca85ffb56946ca01a91bdbf3e5";
			
			// // Secret key
			$secretKey = "maksik";
			
			// //Получаем и декодируем уведомление
			$data = json_decode(file_get_contents('php://input'));
			
			// // проверяем secretKey
			// if(strcmp($data->secret, $secretKey) !== 0 && strcmp($data->type, 'confirmation') !== 0)
			//     return;
			
			// //Проверяем, что находится в поле "type"
			switch ($data->type) {
				case 'confirmation':
			        echo $confirmationToken;
			        break;
				case 'wall_post_new':
					// $this->telegram($data->object->copy_history[0]->text);
					$this->wall_post_new($data->object);
					echo('ok');
					break;
				
			}
		}
		
		function getPhoto($photoObj) {
			if($photoObj->photo_1280) {
				return $photoObj->photo_1280;
			}
			
			if($photoObj->photo_807)
				return $photoObj->photo_807;
				
			if($photoObj->photo_604) {
				return $photoObj->photo_604;
			}
			
			return "";
		}
		
		function exec_curl_request($handle) {
		  $response = curl_exec($handle);
		
		  if ($response === false) {
		    $errno = curl_errno($handle);
		    $error = curl_error($handle);
		    error_log("Curl returned error $errno: $error\n");
		    curl_close($handle);
		    return false;
		  }
		
		  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
		  curl_close($handle);
		
		  if ($http_code >= 500) {
		    // do not wat to DDOS server if something goes wrong
		    sleep(10);
		    return false;
		  } else if ($http_code != 200) {
		    $response = json_decode($response, true);
		    error_log("Request has failed with error {$response['error_code']}: {$response['description']}\n");
		    if ($http_code == 401) {
		      throw new Exception('Invalid access token provided');
		    }
		    return false;
		  } else {
		    $response = json_decode($response, true);
		    if (isset($response['description'])) {
		      error_log("Request was successful: {$response['description']}\n");
		    }
		    $response = $response['result'];
		  }
		
		  return $response;
		}
		
		function apiRequestJson($method, $parameters) {
			$token = '530924725:AAGAi7sDRTIoHTkvQnsABw1PgoxV4OULRDk';
			$telegram_api = "https://api.telegram.org/bot" .$token;
			
			// if (!is_string($method)) {
			// 	error_log("Method name must be a string\n");
			// 	return false;
			// }
			
			// if (!$parameters) {
			// 	$parameters = array();
			// } else if (!is_array($parameters)) {
			// 	error_log("Parameters must be an array\n");
			// 	return false;
			// }
			
			$parameters["method"] = $method;
			
			$handle = curl_init($telegram_api);
			curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($handle, CURLOPT_TIMEOUT, 60);
			curl_setopt($handle, CURLOPT_POST, true);
			curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
			curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			
			return $this->exec_curl_request($handle);
		}
		
		function telegram($text, $disable_web_page_preview) {
			
			$token = '530924725:AAGAi7sDRTIoHTkvQnsABw1PgoxV4OULRDk';
			$telegram_api = "https://api.telegram.org/bot" .$token;
			
			$inline_button1 = array("text"=>"Google url","url"=>"http://google.com");
		    $inline_button2 = array("text"=>"work plz","callback_data"=>'/plz');
		    $inline_keyboard = [[$inline_button1,$inline_button2]];
		    $keyboard=array("inline_keyboard"=>$inline_keyboard);
		    $replyMarkup = json_encode($keyboard); 
			
			$sendMessage = [
				'chat_id' => '@rurkaru',
				'text' => $text, 
				'parse_mode' => 'HTML',
				'disable_web_page_preview' => $disable_web_page_preview,
				'reply_markup' => json_encode([
					"inline_keyboard" => [[
						["text" => "Googles url", "url" => "http://google.com"],
						["text" => "work plz", "callback_data" => '/plz']
					]]
				])
				// 'reply_markup' => json_encode([
				// 	"inline_keyboard" => [[["text" => 'Google'], ["text" => "Yandex"]]]
				// ])
			];
			
			
			
			// $this->apiRequestJson("sendMessage", $sendMessage);
			
			file_get_contents($telegram_api."/sendmessage?". http_build_query($sendMessage));  
		}
		
		

	}
