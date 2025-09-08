<?php
// DbbackupController.php
require_once __DIR__ . '/../core/Auth.php';
class DbbackupController extends Controller {
    public function run() {
        Auth::check();
        $user = Auth::user();
        if (!isset($user['role']) || strtolower($user['role']) !== 'admin') {
            http_response_code(403);
            echo 'Forbidden';
            exit;
        }
        $config = require __DIR__ . '/../core/config.php';
        $dbhost = $config['DB_HOST'];
        $dbuser = $config['DB_USER'];
        $dbpass = $config['DB_PASS'];
        $dbname = $config['DB_NAME'];
        $backupDir = __DIR__ . '/../../dbbackup/';
        if (!is_dir($backupDir)) mkdir($backupDir, 0777, true);
        $datetime = date('Ymd_His');
        $backupFile = $backupDir . $dbname . '_' . $datetime . '.sql';
        $command = sprintf('mysqldump -h%s -u%s -p%s %s > "%s"', escapeshellarg($dbhost), escapeshellarg($dbuser), escapeshellarg($dbpass), escapeshellarg($dbname), $backupFile);
        $output = null; $result = null;
        exec($command, $output, $result);
        if ($result === 0 && file_exists($backupFile)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($backupFile) . '"');
            readfile($backupFile);
            exit;
        } else {
            echo 'Backup failed.';
            exit;
        }
    }
}
