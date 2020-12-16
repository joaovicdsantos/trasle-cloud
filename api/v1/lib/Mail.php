<?php

include_once(__DIR__ . '/../../../vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Mail
{
    public static function sendApiData($name, $email, $api_key, $directory)
    {
        $mail = new PHPMailer();

        $mail->isSMTP();

        $body = file_get_contents(__DIR__.'/PHPMailer/template.html');
        $body = str_replace('%username%', ucfirst($name), $body);
        $body = str_replace('%api_key%', $api_key, $body);
        $body = str_replace('%directory%', 'trasle-cloud.gq/cloud/'.$directory, $body);

        $mail->Port = '465';
        $mail->Host = 'smtp.gmail.com';
        $mail->IsHTML(true);
        $mail->Mailer = 'smtp';
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = 'UTF-8';

        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_EMAIL']; 
        $mail->Password = $_ENV['MAIL_PASSWORD'];

        $mail->setFrom($_ENV['MAIL_EMAIL'], $_ENV['MAIL_NAME']);
        $mail->addAddress($email);
        $mail->Subject = 'About your registration on api Trasle-Cloud';
        $mail->MsgHTML($body);

        if (!$mail->Send()) {
            echo 'Error sending the e-mail. Please contact the developer';
        }
    }
}
