<?php

require "../lib/class.Banco.php";
require "../models/class.Item.php";

class ItemDAO {
    private $pdo;

    function __construct(){$this->pdo = Banco::getConexao();}

    function getById($id){
        $sql = 'select * from Items where id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Item::class);
        $Item = $stmt->fetch();

        return $Item ?? [];
    }


    function getAll() {
   $sql = "
    SELECT 
    l.id,
    l.texto,
    l.userId,
    u.nome AS autor
FROM items l
LEFT JOIN usuarios u ON u.id = l.userId

";

    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?? [];
}


    function insert(Item $Item){
        $sql = "INSERT INTO Items (userId, texto) VALUES (:userId, :texto)";
        $stmt = $this->pdo->prepare($sql);
        try {
    $stmt->execute([
            'userId' => $Item->getUserId(),
            'texto' => $Item->getTexto(),
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


    function update($id, Item $Item){
        $sql = 'update Items set userId = :UserId, texto = :texto';
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'id' => $id,
           'UserId' => $Item->getUserId(),
           'Texto' => $Item->getTexto(),
        ]);
        if($result){
            return $this->getById($id) ?? [];
        }
    }


    function delete($id){
        $sql = 'delete from Items where id= :id';
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        return $result? true : false;
    }
}