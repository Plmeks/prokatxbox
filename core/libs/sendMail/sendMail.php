<?php

class SendMail {
    function sendMail(){
        $name = $this->cleanData($_POST['name']);
        $email = $this->cleanData($_POST['email']);
        $message = $this->cleanData($_POST['message']);

        $text = "Посетитель сайта с именем: " .$name . " и почтой e-mail: " .$email ." оставил сообщение: «"
            .$message ."».";

        $this->send($text);
    }

    private function cleanData($val){
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        $val = mysql_real_escape_string($val);
        return $val;
    }

    private function send($content, $attach = false)
    {
        $__smtp = array(
            "host" => "smtp.yandex.ru",     //smtp сервер
            "debug" => 0,                   //отображение информации дебаггера (0 - нет вообще)
            "auth" => true,                 //сервер требует авторизации
            "port" => 25,                   //порт (по-умолчанию - 25)
            "username" => "info@yaa.by",    //имя пользователя на сервере
            "password" => "vseprokatit",    //пароль
            "addreply" => "info@yaa.by",    //ваш е-mail
        );

        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        try {
            $mail->Host       = $__smtp['host'];
            $mail->SMTPDebug  = $__smtp['debug'];
            $mail->SMTPAuth   = $__smtp['auth'];
            $mail->Host       = $__smtp['host'];
            $mail->CharSet    = 'utf-8';
            $mail->Port       = $__smtp['port'];
            $mail->Username   = $__smtp['username'];
            $mail->Password   = $__smtp['password'];
            $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
            /*$mail->AddAddress("analisaudit@gmail.com");
            $mail->AddAddress("bogdan_rodimich@mail.ru");*/
            $mail->SetFrom($__smtp['addreply'], $__smtp['username']);
            $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
            $mail->Subject = htmlspecialchars("");
            $mail->MsgHTML($content);

            if($attach)
                $mail->AddAttachment($attach);

            $mail->Send();
            echo "success";
        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
