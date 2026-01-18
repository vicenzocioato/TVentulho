<?php 

require "../lib/class.Banco.php";
require "../models/class.Usuario.php";

class UsuarioDAO {
    private $pdo;

    function __construct(){$this->pdo = Banco::getConexao();}

    function getById($id){
        $sql = 'select * from Usuarios where id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        $Usuario = $stmt->fetch();

        return $Usuario ?? [];
    }
    function getAll(){
        $sql = 'select * from Usuarios';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Usuario::class);
        $Usuarios = $stmt->fetchAll();

        return $Usuarios ?? [];
    }
    function insert(Usuario $Usuario){
        $sql = 'insert into Usuarios values (null, :nome, :senha)';
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'nome' => $Usuario->getNome(),
            'senha' => $Usuario->getSenha()
        ]);
        if($result){
            $id = $this->pdo->lastInsertId();
            return $this->getById($id) ?? [];
        }
    }

    function update($id, Usuario $Usuario){
        $sql = 'update Usuarios set nome = :nome, senha = :senha';
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            'id' => $id,
            'nome' => $Usuario->getNome(),
           'senha' => $Usuario->getSenha()
        ]);
        if($result){
            return $this->getById($id) ?? [];
        }
    }
}