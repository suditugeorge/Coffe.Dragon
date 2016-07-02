<?php
namespace controllers;

use data\Security;

/**
 * Account class
 */
class Account extends Controller
{
    public function loginOrRegister(\Base $f3)
    {
        $f3->set('title', 'Login');
        $f3->set('description', 'Pentru a beneficia de ofertele și reducerile Coffee Dragon™ vă rugăm să vă creați un cont sau sa vă logați pe site. Vă mulțumim');
        $f3->push('styles', 'users/login.css');
        $f3->push('scripts', 'ui/js/users/login.js');
        $f3->set('content', 'html/users/login.html');
    }

    public function register(\Base $f3)
    {
        $this->layout = 'json';
        $result['success'] = true;
        $email = $f3->get('POST.email');
        $password = $f3->get('POST.password');
        $mongo = $f3->get('MONGO');
        $user = $mongo->CoffeeDragon->users->findOne(['email' => $email]);
        if ($user) {
            $result = ['success' => false, 'message' => 'Există deja un cont cu această adresă de email'];
            $this->result = $result;
            return;
        }
        $is_created = Security::createAccount($email, $password);
        if (!$is_created) {
            $this->result = ['success' => false, 'message' => 'A intervenit o eroare! Vă rugăm să încercați mai târziu sau să ne contactați fie prin e-mail fie telefonic.'];
            return;
        }
        $this->result = $result;
    }

    public function login(\Base $f3)
    {
        $this->layout = 'json';
        $email = $f3->get('POST.email');
        $password = $f3->get('POST.password');
        $result = Security::login($email, $password);
        $this->result = $result;
    }

    public function logOut(\Base $f3)
    {
        if (Security::isLogedIn()) {
            $_SESSION = [];
            session_destroy();
        }
        $f3->reroute('/', true);
    }
}
