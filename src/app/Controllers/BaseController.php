<?php
abstract class BaseController {
    protected $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
        require_once __DIR__ . '/../auth.php';
        requireLogin();
    }
    
    protected function render($view, $data = []) {
        extract($data);
        require_once __DIR__ . '/../layout.php';
        renderHead($data['title'] ?? 'StockManager');
        require_once __DIR__ . "/../Views/$view.php";
    }
    
    protected function redirect($url) {
        header("Location: $url");
        exit;
    }
}