<?php
// Task Edit View
// Form to edit an existing task
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="/public/main.css">
</head>

<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <h1>Edit Task</h1>
    <form method="post" action="edit.php?id=<?= $task->id ?>">
        <label>Title: <input type="text" name="title" value="<?= htmlspecialchars($task->title) ?>"
                required></label><br>
        <label>Description: <textarea
                name="description"><?= htmlspecialchars($task->description) ?></textarea></label><br>
        <label>Due Date: <input type="date" name="due_date"
                value="<?= htmlspecialchars($task->due_date) ?>"></label><br>
        <label>Priority: <select name="priority">
                <option value="Low" <?= $task->priority == 'Low' ? 'selected' : '' ?>>Low</option>
                <option value="Medium" <?= $task->priority == 'Medium' ? 'selected' : '' ?>>Medium</option>
                <option value="High" <?= $task->priority == 'High' ? 'selected' : '' ?>>High</option>
            </select></label><br>
        <label>Status: <select name="status">
                <option value="Pending" <?= $task->status == 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="In Progress" <?= $task->status == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $task->status == 'Completed' ? 'selected' : '' ?>>Completed</option>
            </select></label><br>
        <label>Remarks: <input type="text" name="remarks" value="<?= htmlspecialchars($task->remarks) ?>"></label><br>
        <button type="submit">Update</button>
    </form>
    <a href="list.php">Back to List</a>
    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>