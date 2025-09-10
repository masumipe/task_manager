<?php
class User {
    private $db;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function findByUserName($user_name) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE user_name = :user_name');
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Add more user-related methods as needed
}
