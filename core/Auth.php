<?php
class Auth
{
    public static function check()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
        // Inactivity timeout
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
            session_unset();
            session_destroy();
            header('Location: /login?timeout=1');
            exit;
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    public static function login($user_id)
    {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    public static function logout()
    {
        session_unset();
        session_destroy();
    }
}
