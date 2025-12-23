<?php
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

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

if (file_exists($filePath)) {
    readfile($filePath);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Data not found.']);
}