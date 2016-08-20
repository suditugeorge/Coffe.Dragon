<?php
namespace controllers;

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
        $f3->set('title', 'Contactați-ne cu drag!');
        $f3->set('description', 'Pagină de contact Coffee Dragon');
        $f3->push('styles', 'contact.css');
        $f3->set('content', 'html/contact.html');
    }
}
