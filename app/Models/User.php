<?php
class User
{
    private $db;
    public function __construct()
    {
        require_once '../config/config.php';
        $this->db = new Database();
    }
    public function authenticate($username, $password)
    {
        $stmt = $this->db->dbh->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return false;
    }
}
