<?php
// app/models/Comment.php
// Model for comments table
class Comment
{
    public $id, $task_id, $user_id, $comment, $created_at;
    public static function find($id)
    {
        // ...fetch comment by id...
    }
    public static function forTask($task_id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM comments WHERE task_id = :task_id ORDER BY created_at ASC');
        $stmt->bindParam(':task_id', $task_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function save()
    {
        // ...insert or update comment...
    }
    public function delete()
    {
        // ...delete comment...
    }
}
