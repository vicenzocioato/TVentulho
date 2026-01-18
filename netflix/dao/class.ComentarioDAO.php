<?php

require "../lib/class.Banco.php";
require "../models/class.Comentario.php";

class ComentarioDAO {
    private $pdo;

    function __construct(){$this->pdo = Banco::getConexao();}

    function getById($id){
        $sql = 'select * from Comentarios where id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Comentario::class);
        $Comentario = $stmt->fetch();

        return $Comentario ?? [];
    }
    function getAll() {
   $sql = "
    SELECT 
        c.id,
        c.texto,
        c.obraId AS obra,
        c.data,
        c.userId,
        u.nome AS autor
    FROM comentarios c
    LEFT JOIN usuarios u ON u.id = c.userId
    ORDER BY c.data DESC
";


    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
}

    function insert(Comentario $Comentario){
        $sql = "INSERT INTO comentarios (userId, texto, obraId) VALUES (:userId, :texto, :obraId)";
        $stmt = $this->pdo->prepare($sql);
        try {
    $stmt->execute([
            'userId' => $Comentario->getUserId(),
            'texto' => $Comentario->getTexto(),
            'obraId'=> $Comentario->getobraId()
        ]);;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => $e->getMessage()]);
    exit;
}

        
        if($stmt){
            $id = $this->pdo->lastInsertId();
            return $this->getById($id) ?? [];
        }
    }

    function update($id, Comentario $Comentario){
        $sql = 'update Comentarios set userId = :UserId, texto = :texto, Obraid= :ObraId';
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'id' => $id,
           'UserId' => $Comentario->getUserId(),
           'Texto' => $Comentario->getTexto(),
           'ObraId'=> $Comentario->getObra_id()
        ]);
        if($result){
            return $this->getById($id) ?? [];
        }
    }
    function delete($id){
        $sql = 'delete from comentarios where id= :id';
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        return $result? true : false;
    }
}