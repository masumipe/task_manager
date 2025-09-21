<?php
// api/notification.php
// RESTful API for notifications and push logic
require_once '../app/models/Notification.php';

header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // /api/notification.php?user_id=1
        if (isset($_GET['user_id'])) {
            $notifications = Notification::forUser($_GET['user_id']);
            echo json_encode($notifications);
        }
        break;
    case 'POST':
        // Placeholder for push notification logic
        $data = json_decode(file_get_contents('php://input'), true);
        // Integrate with push service (e.g., Firebase, OneSignal)
        echo json_encode(['success' => true, 'message' => 'Push notification sent (placeholder)']);
        break;
    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method Not Allowed']);
}
?>