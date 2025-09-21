<?php
// Task Delete View
// Confirmation for deleting a task
?>
<!DOCTYPE html>
<html>

<head>
    <title>Delete Task</title>
    <link rel="stylesheet" href="/public/main.css">
</head>

<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <h1>Delete Task</h1>
    <p>Are you sure you want to delete the task: <strong><?= htmlspecialchars($task->title) ?></strong>?</p>
    <form method="post" action="delete.php?id=<?= $task->id ?>">
        <button type="submit">Yes, Delete</button>
        <a href="list.php">Cancel</a>
    </form>
    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>