<?php
require "../controller/class.ItemController.php";
header('Content-Type: application/json');

$controller = new ItemController();

$method = $_SERVER['REQUEST_METHOD'];

header("Content-Type: application/json");

try {
    if ($method === "GET") {
        echo json_encode($controller->getAll());
        exit;
    }

    if ($method === "POST") {
        echo json_encode($controller->insert());
        exit;
    }
     if ($method === "DELETE") {
         $data = json_decode(file_get_contents('php://input'), true);
         $id = $data['itemId'];
         echo json_encode($controller->delete($id));
         exit;
     }
    

    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["erro" => $e->getMessage()]);
}
