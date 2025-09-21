<?php
class Menu
{
    private $db;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    public function getMenuForUser($user_id)
    {
        $sql = "SELECT m.id, m.name, m.url, m.parent_id, m.icon FROM menus m
                JOIN menu_permission mp ON mp.menu_id = m.id
                WHERE mp.user_id = :user_id AND mp.can_view = 1
                ORDER BY m.parent_id, m.sort_order, m.id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
