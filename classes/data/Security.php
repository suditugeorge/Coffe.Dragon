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
        $result = $mongo->CoffeeDragon->users->insert($user, ['j' => 1]);
        return $result['ok'];
    }

    public static function login($email, $password)
    {
        $mongo = \Base::instance()->get('MONGO');
        $user = $mongo->CoffeeDragon->users->findOne(['email' => $email]);
        if (!$user) {
            return ['success' => false, 'message' => 'Nu există nici un cont asociat cu această adresă de email'];
        }
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Parola este incorectă'];
        }
        $_SESSION['user_id'] = $user['_id']->{'$id'};
        setcookie(SID, $_SESSION['user_id'], time() + 15552000); //set the cookie for 180 days
        self::startSession();
        return ['success' => true];
    }

    public static function startSession()
    {
        session_set_cookie_params(630720000);
        session_start();
        $_SESSION['last_access'] = time();
        return $_SESSION;
    }

    public static function isLogedIn()
    {
        if (is_array($_SESSION) && array_key_exists('user_id', $_SESSION)) {
            return $_SESSION['user_id'];
        }
        return false;
    }
}
