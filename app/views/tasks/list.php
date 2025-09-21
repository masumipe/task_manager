<?php
// Task List View
// Displays all tasks in a table
?>
<!DOCTYPE html>
<html>

<head>
    <title>Task List</title>
    <link rel="stylesheet" href="/public/main.css">
</head>

<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <h1>Tasks</h1>
    <a href="create.php">Create New Task</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task->id) ?></td>
                    <td><?= htmlspecialchars($task->title) ?></td>
                    <td><?= htmlspecialchars($task->description) ?></td>
                    <td><?= htmlspecialchars($task->due_date) ?></td>
                    <td><?= htmlspecialchars($task->priority) ?></td>
                    <td><?= htmlspecialchars($task->status) ?></td>
                    <td>
                        <a href="edit.php?id=<?= $task->id ?>">Edit</a> |
                        <a href="delete.php?id=<?= $task->id ?>" onclick="return confirm('Delete this task?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>