<?php
class Database {
    private $conn;
    public function getConnection() {
        $config = require __DIR__ . '/config.php';
        $db = $config['db'];
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$db['host']};dbname={$db['name']}",
                $db['user'],
                $db['pass']
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            error_log($exception->getMessage(), 3, './../var/log/app_errors.log');
            die("Database connection error.");
        }
        return $this->conn;
    }
}
