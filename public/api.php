<?php

declare(strict_types=1);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['success' => false, 'message' => 'Method Not Allowed']));
}

$host = $_SERVER['HTTP_HOST'] ?? '';
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if ($origin && !str_contains($origin, $host)) {
    http_response_code(403);
    exit(json_encode(['success' => false, 'message' => 'Access Denied']));
}

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\PasswordController;

$input = json_decode(file_get_contents('php://input'), true) ?? [];

$router = new Router();
$router->addRoute('generate', PasswordController::class, 'generate');

try {
    echo $router->dispatch($input);
} catch (\Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal Server Error'
    ]);
}