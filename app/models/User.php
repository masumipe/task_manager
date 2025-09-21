<?php
class User
{
    private $db;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function findByUserName($user_name)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE user_name = :user_name');
        $stmt->bindParam(':user_name', $user_name);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Static: find user by id
    public static function find($id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get supervisor (assume supervisor_id field exists)
    public static function getSupervisor($id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT supervisor_id FROM users WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row && $row->supervisor_id) {
            return self::find($row->supervisor_id);
        }
        return null;
    }
    // Alias for find
    public static function findById($id)
    {
        return self::find($id);
    }
    // Add more user-related methods as needed
}
