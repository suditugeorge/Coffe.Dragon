<?php
namespace controllers;

use \data\account\Security;
use \data\account\Users;

class Main extends Controller
{

    public function home(\Base $f3)
    {
        $f3->set('title', 'Cafeaua ta zilnică');
        $f3->set('description', 'Cafeaua ta va fi mereu caldă si gata pentru tine');
        $f3->set('content', 'home.html');
    }
}
