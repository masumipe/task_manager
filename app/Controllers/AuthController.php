<?php
class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->authenticate($_POST['username'], $_POST['password']);
            if ($user) {
                Auth::login($user['id']);
                header('Location: /');
                exit;
            } else {
                $error = 'Invalid credentials';
            }
        }
        $this->view('auth/login', isset($error) ? ['error' => $error] : []);
    }
    public function logout()
    {
        Auth::logout();
        header('Location: /login');
        exit;
    }
}
