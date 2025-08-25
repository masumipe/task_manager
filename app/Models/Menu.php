<?php
class Menu
{
    private $db;
    public function __construct()
    {
        require_once '../config/config.php';
        $this->db = new Database();
    }
    public function getUserMenus($user_id)
    {
        $sql = 'SELECT m.* FROM menus m
                JOIN permissions p ON m.id = p.menu_id
                WHERE p.user_id = ? AND p.can_view = 1
                ORDER BY m.parent_id, m.order';
        $stmt = $this->db->dbh->prepare($sql);
        $stmt->execute([$user_id]);
        $menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $this->buildMenuTree($menus);
    }
    private function buildMenuTree($menus, $parent_id = 0)
    {
        $branch = [];
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == $parent_id) {
                $children = $this->buildMenuTree($menus, $menu['id']);
                if ($children) {
                    $menu['children'] = $children;
                }
                $branch[] = $menu;
            }
        }
        return $branch;
    }
}
