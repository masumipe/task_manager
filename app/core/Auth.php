<?php
require_once __DIR__ . '/config.php';
class Auth
{
    public static function check()
    {
        // Always start session if not already active
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $currentPath = $_SERVER['REQUEST_URI'] ?? '';
        // Normalize for both /auth/login and /testbuild/auth/login
        $loginPaths = ['/auth/login', ROOT . '/auth/login'];
        foreach ($loginPaths as $loginPath) {
            if (stripos($currentPath, $loginPath) !== false) {
                return; // Don't check auth on login page
            }
        }
        if (!isset($_SESSION['user_id'])) {
            // Redirect to the login route, not the view file
            header('Location: ' . ROOT . 'auth/login');
            exit;
        }
        // Session timeout (30 min)
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            session_unset();
            session_destroy();
            header('Location: ' . ROOT . 'auth/login?timeout=1');
            exit;
        }
        $_SESSION['LAST_ACTIVITY'] = time();
    }
    public static function user()
    {
        return [
            'id' => $_SESSION['user_id'] ?? null,
            'user_name' => $_SESSION['user_name'] ?? null,
            'full_name' => $_SESSION['full_name'] ?? null,
            'permission_level' => $_SESSION['permission_level'] ?? null
        ];
    }
    public static function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . ROOT . 'auth/login');
        exit;
    }
}
