<?php
session_start();

$id = isset($_SESSION['imdb_id']) ? $_SESSION['imdb_id'] : 'nenhum';
$status = http_response_code();

$data = [
    "id" => $id,
    "stt" => $status
];

header('Content-Type: application/json');
echo json_encode($data);
exit;