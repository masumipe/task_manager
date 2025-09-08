<?php
if (!isset($_SESSION))
    session_start();
require_once '../app/Models/Menu.php';
$menuModel = new Menu();
$menus = $menuModel->getUserMenus($_SESSION['user_id']);
function renderMenu($menus)
{
    echo '<ul class="nav nav-pills mb-3">';
    foreach ($menus as $menu) {
        echo '<li class="nav-item">';
        echo '<a class="nav-link" href="' . htmlspecialchars($menu['url']) . '">' . htmlspecialchars($menu['name']) . '</a>';
        if (!empty($menu['children'])) {
            renderMenu($menu['children']);
        }
        echo '</li>';
    }
    echo '</ul>';
}
renderMenu($menus);
?>