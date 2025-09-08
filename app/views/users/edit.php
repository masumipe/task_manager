<?php
// users/edit.php
require_once __DIR__ . '/../../core/csrf.php';
?>
<div class="container mt-4">
    <h2>Edit User</h2>
    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="manager" <?= $user['role'] === 'manager' ? 'selected' : '' ?>>Manager</option>
                <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Staff</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="active" class="form-label">Status</label>
            <select class="form-select" id="active" name="active">
                <option value="1" <?= $user['active'] ? 'selected' : '' ?>>Active</option>
                <option value="0" <?= !$user['active'] ? 'selected' : '' ?>>Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (leave blank to keep current)</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= ROOT ?>users" class="btn btn-secondary">Cancel</a>
    </form>
</div>
