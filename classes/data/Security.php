<?php
namespace data;

/**
 * Design the security of the Website
 */
class Security
{
    public static function createAccount($email, $password)
    {
        $f3 = \Base::instance();
        $mongo = $f3->get('MONGO');
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $user = ['email' => $email, 'password' => $password_hash];
        $result = $mongo->users->users->insert($user, ['j' => 1]);
        return $result['ok'];
    }
}
