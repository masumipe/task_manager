<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tasks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../app/Views/partials/menu.php'; ?>
    <div class="container mt-4">
        <h2>My Tasks</h2>
        <a href="/task/create" class="btn btn-success mb-3">Create Task</a>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['tasks'] as $task): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($task['priority']); ?></td>
                        <td><?php echo htmlspecialchars($task['status']); ?></td>
                        <td><?php echo htmlspecialchars($task['remarks']); ?></td>
                        <td>
                            <form method="POST" action="/task/updateStatus/<?php echo $task['id']; ?>">
                                <select name="status" class="form-select form-select-sm mb-1">
                                    <option value="Pending" <?php if ($task['status'] === 'Pending')
                                        echo 'selected'; ?>>
                                        Pending</option>
                                    <option value="In Progress" <?php if ($task['status'] === 'In Progress')
                                        echo 'selected'; ?>>In Progress</option>
                                    <option value="Completed" <?php if ($task['status'] === 'Completed')
                                        echo 'selected'; ?>>
                                        Completed</option>
                                </select>
                                <input type="text" name="remarks" class="form-control form-control-sm mb-1"
                                    placeholder="Remarks" value="<?php echo htmlspecialchars($task['remarks']); ?>">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>