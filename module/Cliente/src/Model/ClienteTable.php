<?php

namespace Cliente\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class ClienteTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getAll() {
        return $this->tableGateway->select();
    }

    public function getCliente($id) {
        $id = (int) $id;
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf('Não foi encontrado o id %d', $id));
        }
        return $row;
    }

    public function salvarCliente(Cliente $cliente) {
        $data = [
            'nome' => $cliente->getNome(),
            'telefone' => $cliente->getTelefone(),
            'cpf' => $cliente->getCpf(),
        ];

        $id = (int) $cliente->getId();
        if ($id === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data, ['id' => $id]);
    }

    public function deletarCliente($id) {
        $this->tableGateway->delete(['id' => (int) $id]);
    }
}	