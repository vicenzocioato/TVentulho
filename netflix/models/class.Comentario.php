<?php
class Comentario implements JsonSerializable{
    private $id;
    private $userid;
    private $texto;
    private $obraId;
    private $data;

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getUserid() {
		return $this->userid;
	}

	public function setUserid($value) {
		$this->userid = $value;
	}

	public function getTexto() {
		return $this->texto;
	}

	public function setTexto($value) {
		$this->texto = $value;
	}

	public function getobraId() {
		return $this->obraId;
	}

	public function setobraId($value) {
		$this->obraId = $value;
	}

	public function getData() {
		return $this->data;
	}

	public function setData($value) {
		$this->data = $value;
	}
	  function jsonSerialize(): mixed{
        return [
            'id' => $this->id,
            'userId' => $this->userid,
            'texto' => $this->texto,
            'obra' => $this-> obraId,
            'data' => $this->data
        ];
    }
}