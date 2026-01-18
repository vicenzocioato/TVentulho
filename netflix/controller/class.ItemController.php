<?php
require "../dao/class.ItemDAO.php";
session_start();
class ItemController{

    private $dao;
    function __construct(){
        $this->dao = new ItemDAO();
    }
    
function insert(){

    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE)
        throw new Exception("Json inválido");

    if (!isset($_SESSION['userId'])) {
        throw new Exception("Usuário não autenticado");
    }

    $a = new Item();
    $a->setUserId($_SESSION['userId']);
    $a->setTexto($data['texto']);

    return [
        'SessionId' => $_SESSION['userId'],
        'Item' => $this->dao->insert($a)
    ];
}

    function update($id){
        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE)
            throw new Exception("Json inválido");
        $a = new Item();
        $a->setUserId($data['UserId']);
        $a->setTexto($data['texto']);

        return $this->dao->update($id, $a);
    }
    function delete($id){
        return $this->dao->delete($id);
    }
    function getAll(){
         return [
        'sessionId' => $_SESSION['userId'] ?? null,
        'Items' => $this->dao->getAll()
    ];
    }
    function getById($id){
        return $this->dao->getById($id);
    }

}