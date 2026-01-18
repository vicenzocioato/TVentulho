<?php
session_start();

require "../controller/class.UsuarioController.php";

$controller = new UsuarioController();

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["erro" => "Método não permitido"]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

$nome  = $data['nome']  ?? '';
$senha = $data['senha'] ?? '';

if (empty($nome) || empty($senha)) {
    echo json_encode([
        "status" => 1,
        "erro" => "nome e senha são obrigatórios"
    ]);
    exit;
}

$pdo = Banco::getConexao();

$sql = "SELECT id FROM usuarios WHERE nome = :nome LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->execute();

if ($stmt->fetch()) {
    echo json_encode([
        "status" => 2,
        "msg" => "usuário em uso"
    ]);
    exit;
}

$a = $controller->insert();

$_SESSION['userId'] = $a['userId'];

echo json_encode([
    "status" => 3,
    "userId" => $_SESSION['userId']
]);

