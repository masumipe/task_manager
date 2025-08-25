<?php
class Permission
{
    private $db;
    public function __construct()
    {
        require_once '../config/config.php';
        $this->db = new Database();
    }
    public function hasPermission($user_id, $menu_id, $action = 'can_view')
    {
        $stmt = $this->db->dbh->prepare('SELECT * FROM permissions WHERE user_id = ? AND menu_id = ? AND ' . $action . ' = 1');
        $stmt->execute([$user_id, $menu_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
    }
}
