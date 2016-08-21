<?php

namespace data;

class NetUtil
{
    public static function notificationEmailer()
    {

        //$mail->SMTPDebug = 3; // Enable verbose debug output
        require_once ROOT_DIR . '/classes/vendor/PHPMailer/PHPMailerAutoload.php';

        $mail = new \PHPMailer();

        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = NOTIFICATION_SMTP_HOST; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = NOTIFICATION_SMTP_USER; // SMTP username
        $mail->Password = NOTIFICATION_SMTP_PASSWORD; // SMTP password
        if (NOTIFICATION_SMTP_SECURITY) {
            $mail->SMTPSecure = NOTIFICATION_SMTP_SECURITY; // Enable TLS encryption, `ssl` also accepted
        }
        $mail->Port = NOTIFICATION_SMTP_PORT; // TCP port to connect to
        return $mail;
    }
}
