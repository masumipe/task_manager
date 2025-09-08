<?php
// users/create.php
require_once __DIR__ . '/../../core/csrf.php';
?>
<div class="container mt-4">
    <h2>Add User</h2>
    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="active" class="form-label">Status</label>
            <select class="form-select" id="active" name="active">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?= ROOT ?>users" class="btn btn-secondary">Cancel</a>
    </form>
</div>
