<?php
header("Content-Type: application/json");

require "../models/class.Usuario.php"; 
require "../lib/class.Banco.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    $nome = $data['nome'] ?? ''; 
    $senha_digitada = $data['senha'] ?? '';

    if (empty($nome) || empty($senha_digitada)) {
        die(json_encode(["erro"=>1]));
    }
    autentica($nome, $senha_digitada);
    
}
  else {
      die("Acesso inválido. Use o formulário de login.");
}

function autentica($nome, $senha_digitada){
    try {
        $pdo = Banco::getConexao();
        $sql = "SELECT id, nome FROM Usuarios WHERE nome = :nome AND senha = :senha";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha_digitada);
        
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
            
        $_SESSION['userId'] = $usuario['id'];
        echo json_encode([
            "erro"=>0
        ]);
        exit;
        } else {
            echo json_encode(["erro"=>2]);
        }
        
    } catch (PDOException $e) {
        die(json_encode([
        "Erro no banco de dados: " => $e->getMessage(),
        "erro" => 3
        ]));
    }
}
?>