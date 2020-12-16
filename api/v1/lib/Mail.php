<?php

require_once(__DIR__.'/PHPMailer/class.phpmailer.php');
require_once(__DIR__.'/PHPMailer/class.smtp.php');
require_once(__DIR__.'/PHPMailer/class.pop3.php');

include_once(__DIR__ . '/../../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Mail
{
    public static function sendApiData($name, $email, $api_key, $directory)
    {
        $mail = new PHPMailer();

        $mail->IsSMTP();


        $body = file_get_contents(__DIR__.'/PHPMailer/template.html');
        $body = str_replace('%api_key%', $api_key, $body);
        $body = str_replace('%directory%', 'https://trasle-cloud.gq/cloud/'.$directory, $body);


        $mail->Port = '465';
        $mail->Host = 'smtp.gmail.com';
        $mail->IsHTML(true);
        $mail->Mailer = 'smtp';
        $mail->SMTPSecure = 'ssl';
        $mail->CharSet = 'UTF-8';

        //configuração do usuário do gmail
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_EMAIL']; // usuario gmail.   
        $mail->Password = $_ENV['MAIL_PASSWORD']; // senha do email.

        $mail->SingleTo = true;

        // configuração do email a ver enviado.
        $mail->From = $_ENV['MAIL_EMAIL'];
        $mail->FromName = $_ENV['MAIL_NAME'];

        $mail->addAddress($email); // email do destinatario.

        $mail->Subject = "About your registration on api Trasle-Cloud";
        $mail->MsgHTML($body);

        if (!$mail->Send()) {
            echo "Erro ao enviar Email:" . $mail->ErrorInfo;
        }
    }
}
