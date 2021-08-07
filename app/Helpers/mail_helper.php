<?php

use PHPMailer\PHPMailer\PHPMailer;

    if (!function_exists('mailer')) {
        function mailer()
        {
            $messaggio = new PHPMailer;

            $messaggio->IsSMTP();
            $messaggio->SMTPDebug = 0;
            $messaggio->Debugoutput = 'html';
            $messaggio->SMTPAuth = true;
            $messaggio->SMTPSecure = 'tls';

            $messaggio->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $messaggio->Host = gethostbyname($_ENV['app.customer_care_smtp']);
            $messaggio->Port = 25;
            $messaggio->Username = $_ENV['app.customer_care_mail'];
            $messaggio->Password = $_ENV['app.customer_care_pw'];

            $messaggio->IsHTML(true);
            $messaggio->CharSet = "UTF-8";
            $messaggio->Priority = 3; //priorità

            $messaggio->setFrom($_ENV['app.customer_care_mail'], $_ENV['app.customer_care_name']);
            $messaggio->AddCustomHeader("Reply-to:" . $_ENV['app.customer_care_mail']);

            return $messaggio;
        }
    }

