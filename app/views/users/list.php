<?php
// users/list.php
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Users</h2>
        <a href="<?= ROOT ?>users/create" class="btn btn-primary">Add User</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['phone']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td><?= $user['active'] ? '<span class="text-success">Active</span>' : '<span class="text-danger">Inactive</span>' ?></td>
                        <td>
                            <a href="<?= ROOT ?>users/edit/<?= $user['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?= ROOT ?>users/delete/<?= $user['id'] ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
