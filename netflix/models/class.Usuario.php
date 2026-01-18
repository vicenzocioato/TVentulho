<?php
class Usuario{
    private $id;
    private $nome;
    private $senha;


	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getNome() {
		return $this->nome;
	}

	public function setNome($value) {
		$this->nome = $value;
	}

	public function getSenha() {
		return $this->senha;
	}

	public function setSenha($value) {
		$this->senha = $value;
	}

     function jsonSerialize(){
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'senha' => $this->senha
        ];
    }
}