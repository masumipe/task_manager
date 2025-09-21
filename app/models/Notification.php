<?php
// app/models/Notification.php
// Model for notifications table
class Notification
{
    public $id, $user_id, $task_id, $type, $message, $sent_at;
    public static function find($id)
    {
        // ...fetch notification by id...
    }
    public static function forUser($user_id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM notifications WHERE user_id = :user_id ORDER BY sent_at DESC');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function save()
    {
        // ...insert or update notification...
    }

    // Static: create notification
    public static function create($data)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('INSERT INTO notifications (user_id, task_id, type, message, sent_at) VALUES (:user_id, :task_id, :type, :message, NOW())');
        $stmt->bindParam(':user_id', $data['user_id']);
        $stmt->bindParam(':task_id', $data['task_id']);
        $stmt->bindParam(':type', $data['type']);
        $stmt->bindParam(':message', $data['message']);
        $stmt->execute();
        return $db->lastInsertId();
    }
    public function delete()
    {
        // ...delete notification...
    }
}
