<?php
// api/comment.php
// RESTful API for comments and attachments
require_once '../app/models/Comment.php';
require_once '../app/models/Attachment.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // /api/comment.php?task_id=1
        if (isset($_GET['task_id'])) {
            $comments = Comment::forTask($_GET['task_id']);
            echo json_encode($comments);
        }
        break;
    case 'POST':
        // Add comment or upload attachment
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['comment'])) {
            $comment = new Comment();
            foreach ($data as $k => $v)
                $comment->$k = $v;
            $comment->save();
            echo json_encode(['success' => true]);
        } elseif (isset($data['file_name'])) {
            $attachment = new Attachment();
            foreach ($data as $k => $v)
                $attachment->$k = $v;
            $attachment->save();
            echo json_encode(['success' => true]);
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}
?>