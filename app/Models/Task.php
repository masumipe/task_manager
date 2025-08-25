<?php
class Task
{
    private $db;
    public function __construct()
    {
        require_once '../config/config.php';
        $this->db = new Database();
    }
    public function getUserTasks($user_id)
    {
        $stmt = $this->db->dbh->prepare('SELECT * FROM tasks WHERE assigned_to = ? ORDER BY due_date');
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $stmt = $this->db->dbh->prepare('INSERT INTO tasks (title, description, assigned_to, due_date, priority, status, remarks, created_by, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())');
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['assigned_to'],
            $data['due_date'],
            $data['priority'],
            $data['status'],
            $data['remarks'],
            $data['created_by']
        ]);
    }
    public function updateStatus($task_id, $status, $remarks)
    {
        $stmt = $this->db->dbh->prepare('UPDATE tasks SET status = ?, remarks = ?, updated_at = NOW() WHERE id = ?');
        return $stmt->execute([$status, $remarks, $task_id]);
    }
    // Add more CRUD as needed
}
