<?php
// app/models/TaskTag.php
// Model for task_tags table
class TaskTag
{
    public $id, $task_id, $tag_id;
    public static function forTask($task_id)
    {
        // ...fetch all tags for a task...
    }
    public static function forTag($tag_id)
    {
        // ...fetch all tasks for a tag...
    }
    public function save()
    {
        // ...insert or update task-tag relation...
    }
    public function delete()
    {
        // ...delete task-tag relation...
    }
}
