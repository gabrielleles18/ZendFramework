<?php

namespace Locacoes\Model;

use Zend\Db\TableGateway\TableGatewayInterface;
use RuntimeException;

class LocacoesTable {

    private $tableGateway;

    public function __construct(TableGatewayInterface $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function getAll() {
        return $this->tableGateway->select();
    }

    public function getLocacoes($id_locacoes) {
        $id_locacoes = (int) $id_locacoes;
        $rowset = $this->tableGateway->select(['id_locacoes' => $id_locacoes]);
        $row = $rowset->current();
        if (!$row) {
            throw new RuntimeException(sprintf('Não foi encontrado o id %d', $id_locacoes));
        }
        return $row;
    }

    public function salvarLocacoes(Locacoes $locacoes) {
        $data = [
            'datasaida' => $locacoes->getDatasaida(),
            'dataretorno' => $locacoes->getDataretorno(),
            'cliente_id' => $locacoes->getCliente_id(),
        ];

        $id_locacoes = (int) $locacoes->getId_locacoes();
        if ($id_locacoes === 0) {
            $this->tableGateway->insert($data);
            return;
        }
        $this->tableGateway->update($data, ['id_locacoes' => $id_locacoes]);
    }

    public function deletarLocacoes($id_locacoes) {
        $this->tableGateway->delete(['id_locacoes' => (int) $id_locacoes]);
    }
}	