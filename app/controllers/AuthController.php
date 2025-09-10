<?php
require_once __DIR__ . '/../core/csrf.php';
class AuthController extends Controller {
    public function login() {
        // Do NOT destroy the session on GET, only on logout
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        // If already logged in, redirect to dashboard
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            header('Location: ' . ROOT . 'dashboard');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            check_csrf();
            $userModel = $this->model('User');
            $user = $userModel->findByPhone($_POST['phone_number']);
            if ($user && password_verify($_POST['password'], $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['permission_level'] = $user['permission_level'] ?? 1;
                $_SESSION['LAST_ACTIVITY'] = time();
                $_SESSION['err_log'] = 'No errors';
                header('Location: ' . ROOT . 'dashboard');
                exit;
            } else {
                $error = 'Invalid phone number or password.';
            }
        }
        require_once __DIR__ . '/../views/auth/login.php';
    }
    public function logout() {
        Auth::logout();
    }
    public function index() {
        // Show the login form
        require_once __DIR__ . '/../views/auth/login.php';
        // header('Location: /testbuild/auth/login.php');
    //    var_dump(__DIR__ . '/../views/auth/login.php');
    }
}