<?php
// app/models/Task.php
// Model for tasks table
class Task
{
    public $id, $title, $description, $due_date, $priority, $status, $remarks, $created_by, $created_at, $updated_at;

    public static function find($id)
    {
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('SELECT * FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public static function all($filters = [])
    {
        $database = new Database();
        $db = $database->getConnection();
        $sql = 'SELECT * FROM tasks WHERE 1=1';
        $params = [];
        if (isset($filters['due_date'])) {
            $sql .= ' AND due_date = :due_date';
            $params[':due_date'] = $filters['due_date'];
        }
        if (isset($filters['status'])) {
            $sql .= ' AND status = :status';
            $params[':status'] = $filters['status'];
        }
        $stmt = $db->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function save()
    {
        $database = new Database();
        $db = $database->getConnection();
        if (isset($this->id) && $this->id) {
            // Update
            $stmt = $db->prepare('UPDATE tasks SET title = :title, description = :description, due_date = :due_date, priority = :priority, status = :status, remarks = :remarks, updated_at = NOW() WHERE id = :id');
            $stmt->bindParam(':id', $this->id);
        } else {
            // Insert
            $stmt = $db->prepare('INSERT INTO tasks (title, description, due_date, priority, status, remarks, created_by, created_at) VALUES (:title, :description, :due_date, :priority, :status, :remarks, :created_by, NOW())');
        }
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':due_date', $this->due_date);
        $stmt->bindParam(':priority', $this->priority);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':remarks', $this->remarks);
        if (!isset($this->id) || !$this->id) {
            $stmt->bindParam(':created_by', $this->created_by);
        }
        $stmt->execute();
        if (!isset($this->id) || !$this->id) {
            $this->id = $db->lastInsertId();
        }
        return $this->id;
    }
    public function delete()
    {
        if (!isset($this->id) || !$this->id)
            return false;
        $database = new Database();
        $db = $database->getConnection();
        $stmt = $db->prepare('DELETE FROM tasks WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
    public function assignedUsers()
    {
        // ...fetch users assigned to this task...
    }
    public function tags()
    {
        // ...fetch tags for this task...
    }
    public function comments()
    {
        // ...fetch comments for this task...
    }
    public function logs()
    {
        // ...fetch logs for this task...
    }
    public function attachments()
    {
        // ...fetch attachments for this task...
    }
}
