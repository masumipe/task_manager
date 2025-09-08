<?php
// app/controllers/HomeController.php
require_once __DIR__ . '/../core/Auth.php';

class HomeController extends Controller {
    public function index() {
        Auth::check();
        require_once __DIR__ . '/../templates/header.php';
        echo '<div class="container mt-4"><h2>Welcome to the Building Management System</h2></div>';
        require_once __DIR__ . '/../templates/footer.php';
    }
}
