<?php 

namespace Locacoes;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Locacoes\Controller\LocacoesController;

class Module implements ConfigProviderInterface{

	public function getConfig() {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                Model\LocacoesTable::class => function($container) {
                    $tableGateway = $container->get(Model\LocacoesTableGateway::class);
                    return new Model\LocacoesTable($tableGateway);
                },
                Model\LocacoesTableGateway::class => function($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Locacoes());
                    return new TableGateway('locacoes', $dbAdapter, null, $resultSetPrototype);
                },
            ]
        ];
    }

    public function getControllerConfig() {
        return [
            'factories' => [
                LocacoesController::class => function($container) {
                    $tableGateway = $container->get(Model\LocacoesTable::class);
                    return new LocacoesController($tableGateway);
                },
            ]
        ];
    }

}