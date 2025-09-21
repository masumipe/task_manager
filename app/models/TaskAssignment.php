<?php
// app/models/TaskAssignment.php
// Model for task_assignments table
class TaskAssignment
{
    public $id, $task_id, $user_id, $assigned_at;
    public static function find($id)
    {
        // ...fetch assignment by id...
    }
    public static function forTask($task_id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM task_assignments WHERE task_id = :task_id');
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public static function forUser($user_id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM task_assignments WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function save()
    {
        // ...insert or update assignment...
    }
    public function delete()
    {
        // ...delete assignment...
    }
}
