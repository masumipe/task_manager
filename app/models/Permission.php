<?php
class Permission {
    private $db;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function check($user_id, $action, $table) {
        $col = $action . '_permission';
        $stmt = $this->db->prepare("SELECT $col FROM db_permission WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row && $row[$col];
    }
}
