<?php
class TaskController extends Controller
{
    public function index()
    {
        Auth::check();
        $taskModel = $this->model('Task');
        $tasks = $taskModel->getUserTasks($_SESSION['user_id']);
        $this->view('task/index', ['tasks' => $tasks]);
    }
    public function create()
    {
        Auth::check();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskModel = $this->model('Task');
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'assigned_to' => $_POST['assigned_to'],
                'due_date' => $_POST['due_date'],
                'priority' => $_POST['priority'],
                'status' => 'Pending',
                'remarks' => '',
                'created_by' => $_SESSION['user_id']
            ];
            $taskModel->create($data);
            header('Location: /task');
            exit;
        }
        $this->view('task/create');
    }
    public function updateStatus($id)
    {
        Auth::check();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskModel = $this->model('Task');
            $taskModel->updateStatus($id, $_POST['status'], $_POST['remarks']);
            header('Location: /task');
            exit;
        }
        // ...load task and show status update form if needed
    }
}
