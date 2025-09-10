<?php
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/config.php';
require_once __DIR__ . '/../models/Menu.php';

// Only check auth if not on login page
$currentPath = $_SERVER['REQUEST_URI'] ?? '';
$loginPaths = ['/auth/login', ROOT . 'auth/login'];
$onLoginPage = false;
foreach ($loginPaths as $loginPath) {
  if (stripos($currentPath, $loginPath) !== false) {
    $onLoginPage = true;
    break;
  }
}
$user = null;
if (!$onLoginPage) {
  require_once __DIR__ . '/../core/csrf.php';
  Auth::check();
  $user = Auth::user();
}
$menuModel = new Menu();
$menus = ($user && isset($user['id'])) ? $menuModel->getMenuForUser($user['id']) : [];
// var_dump($user);
// var_dump($menus);
// Build menu tree
$menuTree = [];
foreach ($menus as $menu) {
  if ($menu['parent_id'] == 0) {
    $menuTree[$menu['id']] = $menu;
    $menuTree[$menu['id']]['children'] = [];
  }
}
foreach ($menus as $menu) {
  if ($menu['parent_id'] != 0 && isset($menuTree[$menu['parent_id']])) {
    $menuTree[$menu['parent_id']]['children'][] = $menu;
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Building Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= ROOT ?>public/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand text-primary" href="<?= ROOT ?>dashboard">BMS</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php foreach ($menuTree as $menu): ?>
          <?php if (!empty($menu['children'])): ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="menu<?= $menu['id'] ?>" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="<?= htmlspecialchars($menu['icon']) ?>"></i> <?= htmlspecialchars($menu['name']) ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="menu<?= $menu['id'] ?>">
                <?php foreach ($menu['children'] as $child): ?>
                  <li><a class="dropdown-item" href="<?= ROOT . ltrim($child['url'], '/') ?>"><i
                        class="<?= htmlspecialchars($child['icon']) ?>"></i> <?= htmlspecialchars($child['name']) ?></a></li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= ROOT . ltrim($menu['url'], '/') ?>"><i
                  class="<?= htmlspecialchars($menu['icon']) ?>"></i> <?= htmlspecialchars($menu['name']) ?></a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
      <div class="d-flex">
        <?php if ($user): ?>
          <span class="me-2">Welcome, <?= isset($user['user_name']) ? htmlspecialchars($user['user_name']) : '' ?></span>
          <?php if (isset($user['user_name']) && strtolower($user['user_name']) === 'admin'): ?>
            <a href="<?= ROOT ?>dbbackup/run" class="btn btn-warning me-2"><i class="fa fa-database"></i> Backup DB</a>
          <?php endif; ?>
          <a href="<?= ROOT ?>auth/logout" class="btn btn-outline-primary">Logout</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <div class="container mt-3">