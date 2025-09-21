<?php
// api/task.php
// RESTful API for mobile integration
require_once '../app/models/Task.php';
require_once '../app/models/TaskAssignment.php';
require_once '../app/models/Comment.php';
require_once '../app/models/Tag.php';
require_once '../app/models/Notification.php';
require_once '../app/models/Attachment.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // /api/task.php?user_id=1&filter=upcoming
        if (isset($_GET['user_id'])) {
            // Get tasks assigned to user
            $assignments = TaskAssignment::forUser($_GET['user_id']);
            $tasks = [];
            foreach ($assignments as $a) {
                $tasks[] = Task::find($a->task_id);
            }
            echo json_encode($tasks);
        } elseif (isset($_GET['id'])) {
            // Get single task
            $task = Task::find($_GET['id']);
            echo json_encode($task);
        } else {
            // Get all tasks (optionally filter)
            $tasks = Task::all($_GET);
            echo json_encode($tasks);
        }
        break;
    case 'POST':
        // Create new task
        $data = json_decode(file_get_contents('php://input'), true);
        $task = new Task();
        foreach ($data as $k => $v)
            $task->$k = $v;
        $task->save();
        echo json_encode(['success' => true]);
        break;
    case 'PUT':
        // Update task
        $data = json_decode(file_get_contents('php://input'), true);
        $task = Task::find($data['id']);
        foreach ($data as $k => $v)
            $task->$k = $v;
        $task->save();
        echo json_encode(['success' => true]);
        break;
    case 'DELETE':
        // Delete task
        parse_str(file_get_contents('php://input'), $data);
        $task = Task::find($data['id']);
        $task->delete();
        echo json_encode(['success' => true]);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}
?>