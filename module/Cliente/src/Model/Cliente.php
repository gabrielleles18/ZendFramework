<?php

namespace Cliente\Model;

class Cliente implements \Zend\Stdlib\ArraySerializableInterface {

    private $id;
    private $nome;
    private $telefone;
    private $cpf;

    public function exchangeArray(array $data) {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->nome = !empty($data['nome']) ? $data['nome'] : null;
        $this->telefone = !empty($data['telefone']) ? $data['telefone'] : null;
        $this->cpf = !empty($data['cpf']) ? $data['cpf'] : null;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function getArrayCopy(): array {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'cpf' => $this->cpf,
        ];
    }

}
