<?php

namespace Locacoes\Model;

class Locacoes implements \Zend\Stdlib\ArraySerializableInterface {

    private $id_locacoes;
    private $datasaida;
    private $dataretorno;
    private $cliente_id;

    public function exchangeArray(array $data) {
        $this->id_locacoes = !empty($data['id_locacoes']) ? $data['id_locacoes'] : null;
        $this->datasaida = !empty($data['datasaida']) ? $data['datasaida'] : null;
        $this->dataretorno = !empty($data['dataretorno']) ? $data['dataretorno'] : null;
        $this->cliente_id = !empty($data['cliente_id']) ? $data['cliente_id'] : null;
    }

    public function getId_locacoes() {
        return $this->id_locacoes;
    }

    public function setId_locacoes($id_locacoes) {
        $this->id_locacoes = $id_locacoes;
    }

    public function getDatasaida() {
        return $this->datasaida;
    }

    public function setDatasaida($datasaida) {
        $this->datasaida = $datasaida;
    }

    public function getDataretorno() {
        return $this->dataretorno;
    }

    public function setDataretorno($dataretorno) {
        $this->dataretorno = $dataretorno;
    }

    public function getCliente_id() {
        return $this->cliente_id;
    }

    public function setCliente_id($cliente_id) {
        $this->cliente_id = $cliente_id;
    }

    public function getArrayCopy(): array {
        return [
            'id_locacoes' => $this->id_locacoes,
            'datasaida' => $this->datasaida,
            'dataretorno' => $this->dataretorno,
            'cliente_id' => $this->cliente_id,
        ];
    }

}
