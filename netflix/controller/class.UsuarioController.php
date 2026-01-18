<?php

require "../dao/class.UsuarioDAO.php";


class UsuarioController
{
    private $dao;

    function __construct(){
        $this->dao = new UsuarioDAO();
    }

    function getById($id){
        return $this->dao->getById($id);
    }
    function getAll(){
        return $this->dao->getAll();
    }
    function insert() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("JSON inválido");
    }

    $u = new Usuario();
    $u->setNome($data['nome']);
    $u->setSenha($data['senha']);

    $id = $this->dao->insert($u); // TEM que retornar lastInsertId()

    return [
        "userId" => $id
    ];
}

    function update($id){
        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE)
            throw new Exception("Json inválido");
        $a = new Usuario();
        $a->setNome($data['nome']);
        $a->setSenha($data['senha']);

        return $this->dao->update($id, $a);
    }

}