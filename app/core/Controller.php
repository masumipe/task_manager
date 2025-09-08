<?php
class Controller {
    public function model($model) {
        $modelFile = __DIR__ . '/../models/' . $model . '.php';
        // If file does not exist, try removing underscore (for Service_charge -> Servicecharge.php)
        if (!file_exists($modelFile)) {
            $altModelFile = __DIR__ . '/../models/' . str_replace('_', '', $model) . '.php';
            if (file_exists($altModelFile)) {
                require_once $altModelFile;
            } else {
                require_once $modelFile; // Will trigger error for missing file
            }
        } else {
            require_once $modelFile;
        }
        return new $model();
    }
    public function view($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
