<?php
class Item implements JsonSerializable{
    private $id;
    private $texto;
	private $userId;

	public function getUserid() {
		return $this->userid;
	}

	public function setUserid($value) {
		$this->userid = $value;
	}
	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getTexto() {
		return $this->texto;
	}

	public function setTexto($value) {
		$this->texto = $value;
	}

     function jsonSerialize(){
        return [
            'id' => $this->id,
            'texto' => $this->texto,
			'userId' => $this->userId
        ];
    }
}