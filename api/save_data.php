<?php
header('Content-Type: application/json');

$type = $_GET['type'] ?? '';

$basePath = __DIR__ . '/../uploads/';
$filePath = '';

switch ($type) {
    case 'videos':
        $filePath = $basePath . 'Video-Tutorials/Storage-Video.json';
        break;
    case 'presents':
        $filePath = $basePath . 'PPT-Tutorials/Storage-PPT.json';
        break;
    case 'blogs':
        $filePath = $basePath . 'Blog-post/Blog-post.json';
        break;
    case 'articles':
        $filePath = $basePath . 'Artikel-post/Artikel-post.json';
        break;
    case 'settings':
        $filePath = $basePath . 'Pengaturan/settings.json';
        break;
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data type specified.']);
        exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON data provided.']);
        exit;
    }

    // Ensure the directory exists
    $dir = dirname($filePath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    if (file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT))) {
        echo json_encode(['success' => true, 'message' => 'Data saved successfully.']);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to save data.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Please use POST.']);
}
