<?php
namespace controllers;

use \data\NetUtil;

class Main extends Controller
{

    public function home(\Base $f3)
    {
        $f3->set('title', 'Cafeaua ta zilnică');
        $f3->set('description', 'Cafeaua ta va fi mereu caldă si gata pentru tine');
        $f3->push('styles', 'home.css');
        $f3->set('content', 'html/home.html');
    }

    public function contact(\Base $f3)
    {
        if ($f3->get('VERB') == 'GET' || $f3->get('VERB') == 'GET') {
            $f3->set('title', 'Contactați-ne cu drag!');
            $f3->set('description', 'Pagină de contact Coffee Dragon');
            $f3->push('styles', 'contact.css');
            $f3->push('scripts', 'ui/js/contact.js');
            $f3->set('content', 'html/contact.html');
            return;
        }

        $this->layout = 'json';
        $email = $f3->get('POST.email');
        $name = $f3->get('POST.name');
        $message = $f3->get('POST.message');

        $mail = NetUtil::notificationEmailer();

        $mail->setFrom(NOTIFICATION_SMTP_USER, 'Coffee Dragon');
        $mail->addAddress('nicos_robert@yahoo.com');
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'TEST';
        $mail->Body = \Template::instance()->render('html/contact-email.html', false);
        $mail->send();

        $this->result = ['success' => true];

    }
    public function aboutUs(\Base $f3)
    {
        $f3->set('title', 'Cunoasteti-ne cat mai bine!');
        $f3->set('description', 'Despre echipa Coffee Dragon');
        $f3->push('styles', 'about-us.css');
        $f3->set('content', 'html/about-us.html');
    }
}
