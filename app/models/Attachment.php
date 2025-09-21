<?php
// app/models/Attachment.php
// Model for attachments table
class Attachment
{
    public $id, $task_id, $user_id, $file_name, $file_path, $file_type, $uploaded_at;
    public static function find($id)
    {
        // ...fetch attachment by id...
    }
    public static function forTask($task_id)
    {
        // ...fetch all attachments for a task...
    }
    public function save()
    {
        // ...insert or update attachment...
    }
    public function delete()
    {
        // ...delete attachment...
    }
}
