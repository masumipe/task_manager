<?php
// Task Create View
// Form to create a new task
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create Task</title>
    <link rel="stylesheet" href="/public/main.css">
</head>

<body>
    <?php include __DIR__ . '/../../templates/header.php'; ?>
    <h1>Create Task</h1>
    <form method="post" action="create.php">
        <label>Title: <input type="text" name="title" required></label><br>
        <label>Description: <textarea name="description"></textarea></label><br>
        <label>Due Date: <input type="date" name="due_date"></label><br>
        <label>Priority: <select name="priority">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select></label><br>
        <label>Status: <select name="status">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select></label><br>
        <label>Remarks: <input type="text" name="remarks"></label><br>
        <button type="submit">Create</button>
    </form>
    <a href="list.php">Back to List</a>
    <?php include __DIR__ . '/../../templates/footer.php'; ?>
</body>

</html>