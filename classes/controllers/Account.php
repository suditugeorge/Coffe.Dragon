<?php
namespace controllers;

/**
 * Account class
 */
class Account extends Controller
{
    public function loginOrRegister(\Base $f3)
    {
        $f3->set('title', 'Login');
        $f3->set('description', 'Pentru a beneficia de ofertele și reducerile Coffee Dragon vă rugăm să vă creați un cont sau sa vă logați pe site.Vă mulțumim');
        $f3->push('styles', 'ui/css/users/login.css');
        $f3->set('content', 'html/users/login.html');
    }
}
