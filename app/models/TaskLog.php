<?php
// app/models/TaskLog.php
// Model for task_logs table
class TaskLog
{
    public $id, $task_id, $user_id, $action, $details, $logged_at;
    public static function find($id)
    {
        // ...fetch log by id...
    }
    public static function forTask($task_id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM task_logs WHERE task_id = :task_id ORDER BY logged_at DESC');
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function save()
    {
        // ...insert or update log...
    }
    public function delete()
    {
        // ...delete log...
    }
}
