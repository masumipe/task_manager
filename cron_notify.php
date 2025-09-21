<?php
// cron_notify.php
// Sample notification logic for reminders, overdue alerts, and escalations
// Run via cron: php cron_notify.php

require_once 'app/models/Task.php';
require_once 'app/models/TaskAssignment.php';
require_once 'app/models/Notification.php';

// Helper: send email
function sendEmail($to, $subject, $message)
{
    // Use mail() or PHPMailer for production
    mail($to, $subject, $message);
}

// Helper: send WhatsApp (placeholder)
function sendWhatsApp($phone, $message)
{
    // Integrate with WhatsApp API (e.g., Twilio, Meta)
    // file_get_contents('https://api.whatsapp.com/send?...');
}

// 1. Notify assigned users 1 working day before due_date
$tasks = Task::all(['due_date' => date('Y-m-d', strtotime('+1 weekday'))]);
foreach ($tasks as $task) {
    $assignments = TaskAssignment::forTask($task->id);
    foreach ($assignments as $assign) {
        $user = User::find($assign->user_id);
        $msg = "Reminder: Task '{$task->title}' is due tomorrow.";
        sendEmail($user->email, 'Task Reminder', $msg);
        sendWhatsApp($user->phone_number, $msg);
        Notification::create(['user_id' => $user->id, 'task_id' => $task->id, 'type' => 'reminder', 'message' => $msg]);
    }
}

// 2. Alert if task is overdue
$tasks = Task::all(['status' => 'To Do', 'due_date' => date('Y-m-d', strtotime('-1 day'))]);
foreach ($tasks as $task) {
    $assignments = TaskAssignment::forTask($task->id);
    foreach ($assignments as $assign) {
        $user = User::find($assign->user_id);
        $msg = "Alert: Task '{$task->title}' is overdue!";
        sendEmail($user->email, 'Task Overdue', $msg);
        sendWhatsApp($user->phone_number, $msg);
        Notification::create(['user_id' => $user->id, 'task_id' => $task->id, 'type' => 'overdue', 'message' => $msg]);
    }
}

// 3. Escalate to supervisor if no progress in 48 hours
$tasks = Task::all(['status' => 'To Do']);
foreach ($tasks as $task) {
    $assignments = TaskAssignment::forTask($task->id);
    foreach ($assignments as $assign) {
        // Check last log
        $logs = TaskLog::forTask($task->id);
        $lastLog = end($logs);
        if ($lastLog && strtotime($lastLog->logged_at) < strtotime('-48 hours')) {
            $supervisor = User::find($user->supervisor_id); // Assume supervisor_id exists
            $msg = "Escalation: No progress on '{$task->title}' for 48 hours.";
            sendEmail($supervisor->email, 'Task Escalation', $msg);
            sendWhatsApp($supervisor->phone_number, $msg);
            Notification::create(['user_id' => $supervisor->id, 'task_id' => $task->id, 'type' => 'escalation', 'message' => $msg]);
        }
    }
}

?>