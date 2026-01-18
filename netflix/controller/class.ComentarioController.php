<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../dao/class.ComentarioDAO.php";
session_start();

class ComentarioController{

    private $dao;
    function __construct(){
        $this->dao = new ComentarioDAO();
    }
    
function insert(){

    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE)
        throw new Exception("Json inválido");

    if (!isset($_SESSION['userId'])) {
        throw new Exception("Usuário não autenticado");
    }

    $a = new Comentario();
    $a->setUserId($_SESSION['userId']);
    $a->setTexto($data['texto']);
    $a->setObraId($data['ObraId']);

    return [
        'SessionId' => $_SESSION['userId'],
        'comentarios' => $this->dao->insert($a)
    ];
}

    function update($id){
        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE)
            throw new Exception("Json inválido");
        $a = new Comentario();
        $a->setUserId($data['UserId']);
        $a->setTexto($data['texto']);
        $a->setObraId($data['ObraId']);

        return $this->dao->update($id, $a);
    }
    function delete($id){
        return $this->dao->delete($id);
    }
    function getAll(){
         return [
        'SessionId' => $_SESSION['userId'] ?? null,
        'comentarios' => $this->dao->getAll()
    ];
    }
    function getById($id){
        return $this->dao->getById($id);
    }

}